# Deployment readiness

The branch is `fix/seo-audit-2026`. It has 26 commits, is tested locally, and is **not deployed**.

> A locally fixed issue is not a production-resolved issue. Production is unchanged until the steps below are run.

## 1. Status summary

| Status | Items |
|---|---|
| **Fixed and tested locally** | P0-1, P0-2, P0-3, P0-4, P0-6, P0-7. P1-1, P1-2, P1-5, P1-6, P1-7, P1-8, P1-9, P1-10, P1-12. P3-1, P3-2, P3-3 (minus alternateName), P3-5, P3-6 (templates). P2-2, P2-4, P2-7. `/dmc-marrakech` LCP discovery. Lazy tour map. |
| **Fixed but not fully verified** | P0-5 (code done; GA4 ID invalid). P1-4 (one-day URL pending). P1-13 (needs a PSI rerun on production). |
| **Awaiting an owner decision** | P0-5 GA4 ID. P1-3 `%20` URL migration. P1-11 `/activities` and day-trip consolidation. P2-1 prices/currency. P2-3 awards. P2-5 hub claims. P2-6 tour data (Filament). P2-8 DMC evidence. P2-9/10 new products and guides. P2-11 Atlas Gardens merge. Taxonomy term merges. alternateName. `twitter:site @MoroccoQuest`. P3-7 GBP, P3-8 TripAdvisor. P4. |
| **Requires production or infrastructure changes** | Run the comments migration. Clear caches. Optionally move the web root to `public/`. Brotli. Rotating `.env` secrets (optional, see §6). |
| **Not fixed** | P1-14 console JS errors. P3-4 ItemList/TouristDestination/Service. FontAwesome/bootstrap-icons subsetting. Preloader LCP masking. |

## 2. Database migration
- **Migration:** `2026_09_28_000001_add_is_approved_to_comments_table`, which adds `comments.is_approved` (boolean, default false) and an index.
- **Risk: low.** It's an additive column and doesn't touch data.
- **Effect:** all 60 existing comments become hidden, **including the about 8 genuine ones**, until you approve them in Filament (Comments → filter "Pending" → select → bulk "Approve").
- **The WordPress `qqv_*` tables are untouched.**

## 3. Web-server changes
- **Required:** none beyond the committed root `.htaccess`, which applies on pull.
- **Recommended later (hosting panel):** point the domain's document root at `public/`. This is the Laravel-standard setup and makes the deny list unnecessary. It is **not** a drop-in change:
  - `assets/`, `build/`, `css/`, `js/`, `favicon.ico`, `robots.txt`, `llms.txt` and `storage` must move or be symlinked into `public/`
  - root `index.php` paths must match `public/index.php`
  - test it on staging first
- **Optional:** enable Brotli in cPanel if available (HTML is currently gzip only).

## 4. Environment variables
None are new. The only config change is `config/seotools.php` (default image), which is committed.

## 5. Deployment steps (for the owner; do not run from this environment)
1. Record the current production commit: `git rev-parse HEAD > ~/pre-seo-fix-commit.txt`.
2. Merge `fix/seo-audit-2026` into `main` locally after review, then push.
3. On the server:
   ```bash
   git pull
   php artisan migrate --force   # adds comments.is_approved only
   php artisan cache:clear
   php artisan view:clear
   php artisan optimize
   ```
4. Visit the homepage once to warm the page cache.

## 6. Post-deployment checks
- [ ] `bash scripts/security/check-exposure.sh https://morocco-quest.com` → **PASS**. Run it from a machine with bash and curl; it waits 0.5 s between requests.
- [ ] `/search?query=%22%3E%3Cb%3Ex%3C%2Fb%3E`: view the source and check there is no raw `<b>x</b>`.
- [ ] `/blog/search?query=sahara` → 200. `/tours?page=2` → 404 (not 500).
- [ ] `/tours/type/nonexistent` → 404. `/tours/type/Garden%20Tours` → 200.
- [ ] A blog post shows **no** comments until you approve them. Approve the genuine ones.
- [ ] View the source of `/about`: exactly one `<meta name="robots">`, a `twitter:title` matching `<title>`, and no `og:twitter:`.
- [ ] `/cookie-policy`: the source starts with `<!DOCTYPE html>`.
- [ ] `/sitemap.xml`: loads, and static pages have no `<lastmod>`.
- [ ] `/robots.txt` and `/llms.txt`: new content.
- [ ] Rich Results Test on one tour, one activity and one blog post: no errors.
- [ ] PageSpeed (mobile) on `/dmc-marrakech`: median of 3 runs, compared with the audit (66, LCP 11.97 s).
- [ ] **GA4:** only after the correct measurement ID is set, check Realtime for `page_view`.
- [ ] Resubmit the sitemap in GSC and Bing.

## 7. Secrets
- The git history scan (135 commits) found **no committed credentials**, only placeholders.
- `.env` returned 403 on production even before this fix.
- Because `.git` was public, rotating production secrets (DB, mail, reCAPTCHA, `APP_KEY`) is optional but cheap insurance. It requires server access and was not done.
- A private SSH key file (`Mounir`) sits in the local project folder. It's gitignored, was never committed, and is 404 on production. Move it out of the web folder.
