#!/usr/bin/env bash
# Checks that repository internals are NOT web-accessible and that public
# assets still are. Read-only (GET/HEAD only), safe to run against production.
#
#   bash scripts/security/check-exposure.sh https://morocco-quest.com
#   bash scripts/security/check-exposure.sh http://127.0.0.1:8799   # local Apache test vhost
#
# Set DELAY=0 for local runs; the shared host throttles fast bursts (status 000).
# Exit code 0 = all checks passed, 1 = at least one failure.
set -u
BASE="${1:-https://morocco-quest.com}"
BASE="${BASE%/}"
fail=0

code() { sleep "${DELAY:-0.5}"; curl -s -o /dev/null -w '%{http_code}' --max-time 20 "$BASE$1"; }

# Must be blocked: 403 or 404 (never 200).
BLOCKED=(
  /.git/HEAD /.git/index /.git/config /.git/logs/HEAD /.git/refs/heads/main
  /.env /.env.example /.env.production.bak /.user.ini /.gitignore /.htaccess
  /.claude/settings.json
  /composer.json /composer.lock /package.json /package-lock.json
  /vite.config.js /purgecss.config.js /phpunit.xml /artisan
  /clear_opcache.php /readme.html /license.txt /error_log
  /LEADS_AUDIT_REPORT.md /README.md /SEO_FIX_REPORT.md /problemes.md
  /docs/reports/SEO_AUDIT_2026-09-28.md /docs/seo-fix/IMPLEMENTATION_PLAN.md
  /seo_audit.py /find_alt.py /Mounir /Mounir.pub
  /vendor/autoload.php /vendor/composer/installed.json
  /config/database.php /routes/web.php /app/Models/Tour.php
  /resources/views/home.blade.php /database/migrations/ /tests/TestCase.php
  /scripts/run-purgecss.mjs /skills/SKILLS.md /content/dmc-marrakech-copy.md
  /storage/logs/laravel.log
)
# Must stay reachable: 200 (prod) or 301 (local vhost that force-redirects to https).
PUBLIC=(
  / /tours /blog /dmc-marrakech /robots.txt /llms.txt /sitemap.xml /favicon.ico
  /assets/css/style.min.css /assets/js/main.min.js /assets/img/morocco-quest-og.webp
  /build/manifest.json
)

echo "Base: $BASE"
for p in "${BLOCKED[@]}"; do
  c=$(code "$p")
  if [[ "$c" == "403" || "$c" == "404" ]]; then echo "  ok   blocked  $c $p"; else echo "  FAIL exposed  $c $p"; fail=1; fi
done
for p in "${PUBLIC[@]}"; do
  c=$(code "$p")
  if [[ "$c" == "200" || "$c" == "301" || "$c" == "304" ]]; then echo "  ok   public   $c $p"; else echo "  FAIL public   $c $p"; fail=1; fi
done
[[ $fail -eq 0 ]] && echo "PASS" || echo "FAILED"
exit $fail
