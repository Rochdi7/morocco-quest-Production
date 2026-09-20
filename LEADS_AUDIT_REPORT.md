# Leads Audit Report — Morocco Quest

**Date:** 2026-08-31
**Scope:** Verify how many leads are stored in the database and whether the form/click tracking funnel works.
**Server:** `coloredmorocco.com` → `~/public_html/website_ad320cd7` (site: morocco-quest.com)

---

## Verdict

**Nothing is broken.** The `leads` table is empty of real leads only because it went live on **2026-08-26**, and no form has been submitted in the days since. All historic leads exist as email only.

---

## Numbers

| Metric | Count |
|---|---|
| Rows in `leads` table | **2** (both test clicks) |
| Real site form leads, last 3 months | **7** (email only — predate the table) |
| Direct B2B/agency inquiries by email | ~10 |

### The 2 database rows

| id | type | source | page_url | created_at |
|---|---|---|---|---|
| 1 | `whatsapp_click` | home | https://morocco-quest.com/ | 2026-08-26 21:59:14 |
| 2 | `phone_click` | home | https://morocco-quest.com/ | 2026-08-26 21:59:55 |

Both are own-testing clicks, 41 seconds apart on the homepage. Zero form submissions
(`tour_inquiry`, `activity_inquiry`, `contact_inquiry`) have ever been recorded.

### The 7 real site form leads (email only)

All predate the `leads` table. Latest is **Aug 21**, five days before the table existed.

| Date | Type | Detail |
|---|---|---|
| 2026-06-05 | Activity Inquiry | Château Roslane Day Trip |
| 2026-06-07 | Contact Form | Anthony Conrad |
| 2026-06-14 | Contact Form | Mounir Akajia |
| 2026-07-07 | Tour Inquiry | 5-Day Marrakech Luxury City Break |
| 2026-07-08 | Tour Inquiry | 5-Day Marrakech Luxury City Break |
| 2026-07-18 | Activity Inquiry | Château Roslane Day Trip |
| 2026-08-21 | Contact Form | mona elassaad yvorra |

### Direct B2B inquiries (inbox, not via site forms)

Croatia groups 2026/2027 · MOROCCO tour from TURKEY · Been Baharin Group ·
2027 eclipse · Group quotation 8–14 October · Solicitud de cotización B2B (grupo privado) ·
Business Opportunity B2B · Demande de collaboration · Collaboration B2B ·
Trusted Local Partner (congresses/events/VIP logistics)

---

## Mail volume trend

Messages received at `sales@morocco-quest.com`:

| Month | Messages |
|---|---|
| May 2026 | 1 |
| Jun 2026 | 7 |
| Jul 2026 | 20 |
| Aug 2026 | 39 |

Growing steadily — traffic is **not** the problem. Real conversion runs at roughly
**2–3 form submissions per month**, so the gap since Aug 21 is normal, not a signal.

---

## Checks performed

| Check | Result |
|---|---|
| Lead write path | ✅ Working — 2 test clicks landed |
| `Lead save failed` in logs | ✅ 0 occurrences |
| Inquiry mail send failures | ✅ 0 occurrences |
| Laravel mail/inquiry events, 3 mo | None (mail sends aren't logged) |
| reCAPTCHA keys in `.env` | ✅ Set, valid v2 keys (duplicated block — see below) |
| Deployed commit | ✅ `adec200` — 2 commits past the leads commit `31c8475` |
| `LeadRecorder` in ContactController | ✅ Present (2 references) |
| Exim delivery log | ⛔ Permission denied (`mailnull:mail`, 0640) — used maildir instead |

### Code review

`app/Support/LeadRecorder.php` saves the lead **before** sending mail and swallows/logs
any DB failure, so a mail outage can't lose an inquiry. Controllers
(`TourInquiryController`, `ActivityInquiryController`, `ContactController`) all call it
correctly. No silent-failure path found.

---

## Useful commands

Count leads by type on the server:

```bash
cd ~/public_html/website_ad320cd7
php artisan tinker --execute="
\$c = App\Models\Lead::selectRaw('type, count(*) n')->groupBy('type')->pluck('n','type');
echo 'TOTAL: '.App\Models\Lead::count().PHP_EOL;
foreach(\$c as \$t=>\$n) echo \$t.': '.\$n.PHP_EOL;
"
```

List site form submissions from the mailbox (Exim log is unreadable on shared hosting):

```bash
cd ~/mail/morocco-quest.com/sales
grep -lE "^Subject:.*(Contact Form Submission|Activity Inquiry|Tour Inquiry)" cur/* new/* 2>/dev/null | while read f; do
  echo "$(grep -m1 '^Date:' "$f") | $(grep -m1 '^Subject:' "$f")"
done | sort
```

---

## Follow-ups

1. **Backfill the 7 historic leads** into the admin panel — they exist only as email.
   The mail bodies contain all the field data needed.
2. **Clean up the duplicated reCAPTCHA block** in `.env` (harmless — Laravel takes the
   last value — but confusing).
3. **Watch for the next real submission** to confirm end-to-end DB capture in production.
   Alternatively, submit one test inquiry to verify immediately.

### Unrelated issue spotted

`storage/logs/laravel.log` shows **525 `Class "App\Support\MediaUrl" not found`** errors
dated May 2026, thrown from views. Error volume dropped sharply afterwards
(560 → 10 → 26 → 30 for May → Jun → Jul → Aug), suggesting it was fixed. Worth confirming
it's no longer firing, since pages that 500 cannot convert.
