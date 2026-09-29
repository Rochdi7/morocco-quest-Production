# Rollback plan

Every fix is one commit on `fix/seo-audit-2026` (see `CHANGELOG.md`). Nothing has been deployed.

## Before deploying
Record the production commit, so you can go back to it exactly:

```bash
git rev-parse HEAD > ~/pre-seo-fix-commit.txt
```

## Roll back everything
Option A, on the server:

```bash
git checkout "$(cat ~/pre-seo-fix-commit.txt)"
php artisan migrate:rollback --step=1     # only if the comments migration ran and you want the column gone
php artisan cache:clear && php artisan view:clear && php artisan optimize
```

Option B, in the repo, then deploy as usual:

```bash
git revert --no-edit 8137253..HEAD
```

## Roll back one change
Use `git revert <sha>` for the commit concerned. Items needing extra care:

| Change | Commit | How to undo | Notes |
|---|---|---|---|
| `.htaccess` deny rules | `530b923` | Revert, or delete the "Block repository internals" block | If any public URL returns 404 after deploy, remove the line that matches it. The rest of the site is unaffected. |
| Comment moderation | `6e9ee81` | Revert, **then** `php artisan migrate:rollback --step=1` | Rolling back drops `is_approved`, so all comments (spam included) become visible again. Prefer bulk-approving in Filament over rolling back. |
| GA4 page views | `f3e4bb8` | Revert (back to `send_page_view:false`) | Revert this if a GA4 tag is ever added in GTM, to avoid double counting. |
| Escaped SEO meta / Synced OpenGraph | `783cb41`, `119df8a` | Revert | Remove the `extend()` blocks in `AppServiceProvider`. |
| Tag noindex / empty-archive 404 | `038391d` | Revert | Pages re-enter the index only after recrawl. |
| Unknown type → 404 | `4f79681` | Revert | — |
| Sitemap lastmod | `d26e636` | Revert | Resubmit the sitemap in GSC. |
| robots.txt / llms.txt | `7bce67b` | Revert, or restore the files from `8137253` | — |
| Slug stability | `532ed3e` | Revert | Existing slugs are unchanged by this commit, so nothing to migrate back. |
| Schema changes | `d074838` | Revert | Re-running the Rich Results Test is recommended either way. |
| Nav / links / copy | `6f0ffc5`, `e16870d`, `66588dc`, `b543800`, `6041d9c` | Revert individually | — |
| DMC hero preload | `2ae25b5` | Revert | Removes the `@stack('preload')` hook too. Check no other view pushes to it (none does today). |
| Lazy map iframe | `05c2352` | Revert | — |

## After any rollback
```bash
php artisan cache:clear && php artisan view:clear && php artisan optimize
```
Then visit the homepage once to warm the 6-hour page cache.
