<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Backfills `leads` from the inquiry emails sitting in the cPanel maildir.
 *
 * The leads table was created on 2026-08-26; every form submission before that
 * date exists only as an email in ~/mail/<domain>/sales. This command reads
 * those messages and recreates the rows so the admin counters reflect the real
 * history rather than starting from zero.
 *
 * Safe to re-run: a lead is skipped when a row with the same type and creation
 * timestamp already exists.
 *
 *   php artisan leads:import-maildir ~/mail/morocco-quest.com/sales --dry-run
 *   php artisan leads:import-maildir ~/mail/morocco-quest.com/sales
 */
class ImportLeadsFromMaildir extends Command
{
    protected $signature = 'leads:import-maildir
                            {path : Maildir path, e.g. ~/mail/morocco-quest.com/sales}
                            {--dry-run : Parse and report without writing any rows}';

    protected $description = 'Recreate historic leads from inquiry emails in a maildir';

    /** Subject patterns that identify a site-generated inquiry. */
    private const SUBJECT_TYPES = [
        '/^Tour Inquiry:/i'          => Lead::TYPE_TOUR_INQUIRY,
        '/^Activity Inquiry:/i'      => Lead::TYPE_ACTIVITY_INQUIRY,
        '/Contact Form Submission/i' => Lead::TYPE_CONTACT_INQUIRY,
    ];

    public function handle(): int
    {
        $path = rtrim($this->argument('path'), '/');

        if (Str::startsWith($path, '~')) {
            $path = ($_SERVER['HOME'] ?? getenv('HOME')) . substr($path, 1);
        }

        $files = [];

        foreach (['cur', 'new'] as $box) {
            if (is_dir("{$path}/{$box}")) {
                $files = array_merge($files, glob("{$path}/{$box}/*") ?: []);
            }
        }

        if (! $files) {
            $this->error("No messages found under {$path}/cur or {$path}/new");

            return self::FAILURE;
        }

        $this->info(count($files) . ' messages to scan.');

        $imported = 0;
        $skipped  = 0;
        $matched  = 0;

        foreach ($files as $file) {
            $raw = @file_get_contents($file);

            if ($raw === false) {
                continue;
            }

            $subject = $this->decodeHeader($this->header($raw, 'Subject'));
            $type    = $this->typeFor($subject);

            if (! $type) {
                continue;
            }

            $matched++;

            $date = $this->header($raw, 'Date');
            $sent = $date ? Carbon::parse($date) : null;

            if (! $sent) {
                $this->warn("  no parsable Date, skipping: {$subject}");

                continue;
            }

            if (Lead::where('type', $type)->where('created_at', $sent)->exists()) {
                $skipped++;

                continue;
            }

            $body = $this->textBody($raw);

            $attributes = [
                'type'        => $type,
                'status'      => 'new',
                'source'      => 'imported-email',
                'name'        => $this->field($body, ['Name']) ?: $this->nameFromSubject($subject),
                'email'       => $this->firstEmail($body),
                'phone'       => $this->field($body, ['Phone']),
                'nationality' => $this->field($body, ['Nationality']),
                'item_title'  => $this->itemFromSubject($subject),
                'message'     => $this->field($body, ['Inquiry Message', 'Message']),
                'created_at'  => $sent,
                'updated_at'  => $sent,
            ];

            $this->line(sprintf(
                '  %s  %-18s %s',
                $sent->format('Y-m-d'),
                Lead::TYPE_LABELS[$type] ?? $type,
                Str::limit($attributes['name'] ?: $subject, 45)
            ));

            if (! $this->option('dry-run')) {
                (new Lead())->forceFill($attributes)->save();
            }

            $imported++;
        }

        $this->newLine();
        $this->info("Matched {$matched} inquiry emails.");
        $this->info($this->option('dry-run')
            ? "Would import {$imported} (skipped {$skipped} already present). Re-run without --dry-run to write."
            : "Imported {$imported}, skipped {$skipped} already present.");

        return self::SUCCESS;
    }

    private function typeFor(string $subject): ?string
    {
        foreach (self::SUBJECT_TYPES as $pattern => $type) {
            if (preg_match($pattern, $subject)) {
                return $type;
            }
        }

        return null;
    }

    private function header(string $raw, string $name): string
    {
        $headers = Str::before($raw, "\r\n\r\n");
        $headers = Str::before($headers, "\n\n");

        // Unfold continuation lines before matching.
        $headers = preg_replace('/\r?\n[ \t]+/', ' ', $headers);

        if (preg_match('/^' . preg_quote($name, '/') . ':\s*(.+)$/mi', $headers, $m)) {
            return trim($m[1]);
        }

        return '';
    }

    /** Decodes RFC 2047 encoded-words (=?utf-8?Q?...?=) when present. */
    private function decodeHeader(string $value): string
    {
        if ($value === '') {
            return '';
        }

        $decoded = @iconv_mime_decode($value, ICONV_MIME_DECODE_CONTINUE_ON_ERROR, 'UTF-8');

        return $decoded === false ? $value : $decoded;
    }

    /**
     * Returns the message body as plain text: strips MIME boundaries, decodes
     * quoted-printable/base64 and flattens HTML to lines.
     */
    private function textBody(string $raw): string
    {
        $body = Str::after($raw, "\r\n\r\n");

        if ($body === $raw) {
            $body = Str::after($raw, "\n\n");
        }

        if (stripos($raw, 'quoted-printable') !== false) {
            $body = quoted_printable_decode($body);
        } elseif (stripos($raw, 'Content-Transfer-Encoding: base64') !== false) {
            $candidate = base64_decode(preg_replace('/\s+/', '', $body), true);

            if ($candidate !== false && $candidate !== '') {
                $body = $candidate;
            }
        }

        // Turn block-level tags into newlines so label/value pairs stay apart.
        $body = preg_replace('#</(td|tr|p|div|h[1-6]|li)>#i', "\n", $body);
        $body = preg_replace('#<br\s*/?>#i', "\n", $body);
        $body = strip_tags($body);
        $body = html_entity_decode($body, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $body = preg_replace('/[ \t]+/', ' ', $body);

        return trim(preg_replace('/\n\s*\n+/', "\n", $body));
    }

    /**
     * Finds "Label" followed by its value, either on the same line after a
     * colon or on the next non-empty line (the mail templates use table cells).
     */
    private function field(string $body, array $labels): ?string
    {
        $lines = preg_split('/\n/', $body);

        foreach ($labels as $label) {
            foreach ($lines as $i => $line) {
                $line = trim($line);

                if (preg_match('/^' . preg_quote($label, '/') . '\s*:\s*(.+)$/i', $line, $m)) {
                    return trim($m[1]) ?: null;
                }

                if (strcasecmp($line, $label) === 0 || strcasecmp($line, $label . ':') === 0) {
                    for ($j = $i + 1; $j < min($i + 4, count($lines)); $j++) {
                        $next = trim($lines[$j]);

                        if ($next !== '') {
                            return $next;
                        }
                    }
                }
            }
        }

        return null;
    }

    private function firstEmail(string $body): ?string
    {
        if (preg_match('/[\w.+-]+@[\w-]+\.[\w.-]+/', $body, $m)) {
            $email = rtrim($m[0], '.');

            // Ignore the site's own addresses appearing in the footer.
            return Str::contains($email, ['morocco-quest.com']) ? null : $email;
        }

        return null;
    }

    private function itemFromSubject(string $subject): ?string
    {
        if (preg_match('/^(?:Tour|Activity) Inquiry:\s*(.+)$/i', $subject, $m)) {
            return trim($m[1]) ?: null;
        }

        return null;
    }

    private function nameFromSubject(string $subject): ?string
    {
        if (preg_match('/Contact Form Submission\s*-\s*(.+)$/i', $subject, $m)) {
            return trim($m[1]) ?: null;
        }

        return null;
    }
}
