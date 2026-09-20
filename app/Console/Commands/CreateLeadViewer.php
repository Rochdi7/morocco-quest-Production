<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Creates (or promotes) the read-only lead-viewer account for the admin panel.
 *
 * Usage on the server:
 *   php artisan leads:create-viewer rochdi.karouali1234@gmail.com
 */
class CreateLeadViewer extends Command
{
    protected $signature = 'leads:create-viewer
                            {email : Email address of the account}
                            {--name= : Display name (defaults to the email handle)}
                            {--password= : Password (prompted when omitted)}';

    protected $description = 'Create or promote a user who can see the leads dashboard';

    public function handle(): int
    {
        $email = trim($this->argument('email'));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("Not a valid email address: {$email}");

            return self::FAILURE;
        }

        $password = $this->option('password') ?: $this->secret('Password (min 8 characters)');

        if (! in_array(strtolower($email), User::LEAD_VIEWERS, true)) {
            $this->error("{$email} is not in User::LEAD_VIEWERS.");
            $this->line('Add it to that allow-list first, or the account will');
            $this->line('be created without access to the leads dashboard.');

            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->role = 'lead_viewer';

            if ($password) {
                if (strlen($password) < 8) {
                    $this->error('Password must be at least 8 characters.');

                    return self::FAILURE;
                }

                $user->password = Hash::make($password);
            }

            $user->save();

            $this->info("Existing user promoted to lead_viewer: {$email}");

            return self::SUCCESS;
        }

        if (strlen((string) $password) < 8) {
            $this->error('Password must be at least 8 characters.');

            return self::FAILURE;
        }

        $user = User::create([
            'name'     => $this->option('name') ?: ucfirst(strstr($email, '@', true)),
            'email'    => $email,
            'password' => Hash::make($password),
            'role'     => 'lead_viewer',
        ]);

        $this->info("Created lead_viewer account: {$user->email} (id {$user->id})");
        $this->line('Sign in at https://morocco-quest.com/adminPanel');

        return self::SUCCESS;
    }
}
