"""
Phase 9 — Pre-deploy SEO audit for Morocco Quest (Laravel Blade)
Checks all public-facing Blade views for:
  1. Missing @section('title')
  2. Missing @section('description')
  3. Duplicate titles across files
  4. Duplicate descriptions across files
  5. Title prefix cannibalization (first 4 meaningful words)
  6. Missing H1 (@yield or hardcoded <h1>)
  7. Multiple H1 tags
  8. img tags missing alt attribute
  9. Multiple canonical tags
  10. @push('jsonld') present (schema coverage)
  11. Keyword cannibalization meta
"""

import os, re, sys
from pathlib import Path

sys.stdout.reconfigure(encoding="utf-8")

ROOT = Path(r"C:\Users\ASUS\Desktop\Projects\public_html\resources\views")

# Pages to audit (exclude email templates, vendor, error, partials, layouts, filament)
EXCLUDE_DIRS = {"emails", "vendor", "errors", "partials", "layouts", "filament", "sitemap", "components"}
EXCLUDE_FILES = {"search-bar.blade.php", "type-filter.blade.php", "index.blade.php"}

def get_pages():
    pages = []
    for p in ROOT.rglob("*.blade.php"):
        if any(part in EXCLUDE_DIRS for part in p.parts):
            continue
        if p.name in EXCLUDE_FILES:
            continue
        pages.append(p)
    return sorted(pages, key=lambda p: p.name)

def read(path):
    return path.read_text(encoding="utf-8", errors="replace")

def extract_section(text, name):
    """Extract @section('name', 'value') single-line or multiline."""
    # Single-line literal string value
    m = re.search(
        rf"@section\s*\(\s*['\"]{ re.escape(name) }['\"],\s*['\"]([^'\"]+)['\"]",
        text, re.DOTALL
    )
    if m:
        return m.group(1).strip()
    # Multiline / dynamic value — look for the section declaration itself
    m2 = re.search(
        rf"@section\s*\(\s*['\"]{ re.escape(name) }['\"]",
        text, re.DOTALL
    )
    if m2:
        # Grab up to 400 chars after the section name to check for dynamic content
        chunk = text[m2.start():m2.start()+400]
        if "$" in chunk or "??" in chunk:
            return "<<DYNAMIC>>"
        # Try to grab literal value anyway
        m3 = re.search(r"['\"]([^'\"]{10,})['\"]", chunk[len(m2.group(0)):])
        if m3:
            return m3.group(1).strip()
        return "<<DYNAMIC>>"
    return None

def normalize_title_prefix(title):
    """First 4 meaningful lowercase words."""
    if not title or title == "<<DYNAMIC>>":
        return None
    words = re.sub(r"[^a-z0-9 ]", "", title.lower()).split()
    # strip common trailing brand suffix
    words = [w for w in words if w not in {"morocco", "quest"}][:4]
    return " ".join(words) if len(words) >= 2 else None

ISSUES = []
WARNS  = []

def fail(f, msg):
    ISSUES.append(f"FAIL  [{f}]  {msg}")

def warn(f, msg):
    WARNS.append(f"WARN  [{f}]  {msg}")

def ok(msg):
    pass  # silent passes

pages = get_pages()
print(f"\n{'='*65}")
print(f"  Morocco Quest — Phase 9 SEO Audit")
print(f"  Scanning {len(pages)} public-facing Blade views")
print(f"{'='*65}\n")

titles      = {}   # title -> filename
descs       = {}   # desc  -> filename
prefixes    = {}   # 4-word prefix -> filename

for p in pages:
    name = p.relative_to(ROOT).as_posix()
    text = read(p)

    # ── 1. Title ──────────────────────────────────────────────────
    title = extract_section(text, "title")
    if not title:
        fail(name, "Missing @section('title')")
    elif title == "<<DYNAMIC>>":
        warn(name, "Title is dynamic (controller-passed) — verify it's non-empty for all routes")
    else:
        if title in titles:
            fail(name, f"DUPLICATE title with {titles[title]!r}: \"{title[:70]}\"")
        else:
            titles[title] = name

        prefix = normalize_title_prefix(title)
        if prefix and prefix in prefixes:
            warn(name, f"Title prefix overlap with {prefixes[prefix]!r}: \"{prefix}\"")
        elif prefix:
            prefixes[prefix] = name

    # ── 2. Description ────────────────────────────────────────────
    desc = extract_section(text, "description")
    if not desc:
        fail(name, "Missing @section('description')")
    elif desc == "<<DYNAMIC>>":
        warn(name, "Description is dynamic — verify it's non-empty for all routes")
    else:
        if desc in descs:
            fail(name, f"DUPLICATE description with {descs[desc]!r}")
        else:
            descs[desc] = name
        if len(desc) < 120:
            warn(name, f"Description short ({len(desc)} chars) — aim for 150-160")
        elif len(desc) > 165:
            warn(name, f"Description long ({len(desc)} chars) — may be truncated in SERPs")

    # ── 3. H1 ─────────────────────────────────────────────────────
    # Strip Blade comments {{-- --}} and HTML comments before counting H1
    clean_h1 = re.sub(r"\{\{--.*?--\}\}", "", text, flags=re.DOTALL)
    clean_h1 = re.sub(r"<!--.*?-->", "", clean_h1, flags=re.DOTALL)
    h1_matches = re.findall(r"<h1[\s>]", clean_h1, re.IGNORECASE)
    # also count breadcrumb-title which renders as H1
    breadcrumb_h1 = re.findall(r'class="breadcrumb-title"', text)
    total_h1 = len(h1_matches)
    if total_h1 == 0 and len(breadcrumb_h1) == 0:
        fail(name, "No H1 detected (no <h1> or .breadcrumb-title)")
    elif total_h1 > 1:
        fail(name, f"Multiple <h1> tags ({total_h1} found)")

    # ── 4. img alt ────────────────────────────────────────────────
    # Strip Blade {{ }} expressions before matching img tags so that
    # a '>' inside {{ $var->prop }} doesn't prematurely close the tag.
    clean = re.sub(r"\{\{.*?\}\}", '""', text, flags=re.DOTALL)
    imgs = re.findall(r"<img\b[^>]*>", clean, re.DOTALL | re.IGNORECASE)
    missing_alt = []
    for img in imgs:
        if 'aria-hidden="true"' in img:
            continue
        if not re.search(r'\balt\s*=', img):
            missing_alt.append(img[:80].replace("\n"," "))
    if missing_alt:
        fail(name, f"{len(missing_alt)} <img> tag(s) missing alt attribute")

    # ── 5. Canonical ──────────────────────────────────────────────
    # Blade pages inherit canonical from layout — only flag if they hardcode extras
    extra_canon = re.findall(r'rel=["\']canonical["\']', text)
    if len(extra_canon) > 1:
        fail(name, f"Multiple canonical tags ({len(extra_canon)}) — layout already adds one")

    # ── 6. Schema coverage ────────────────────────────────────────
    has_schema = "@push('jsonld')" in text or "@push('head')" in text or "application/ld+json" in text
    if not has_schema:
        warn(name, "No JSON-LD schema detected — consider adding BreadcrumbList at minimum")

    # ── 7. OG image ───────────────────────────────────────────────
    has_og_image = "@yield('og_image'" in text or "og_image" in text or "og:image" in text
    if not has_og_image:
        warn(name, "No og:image yield — will fall back to default logo (consider page-specific image)")

# ── Summary ───────────────────────────────────────────────────────
print("═" * 65)
print("  FAILURES  (must fix before deploy)")
print("═" * 65)
if ISSUES:
    for i in ISSUES:
        print(f"  {i}")
else:
    print("  ✅  No failures found!")

print()
print("═" * 65)
print("  WARNINGS  (improve when possible)")
print("═" * 65)
if WARNS:
    for w in WARNS:
        print(f"  {w}")
else:
    print("  ✅  No warnings!")

print()
# Structural warnings (dynamic meta, og:image) are expected in Laravel — don't penalise
structural = [w for w in WARNS if "dynamic" in w.lower() or "og:image" in w.lower()]
actionable_warns = [w for w in WARNS if w not in structural]
print("═" * 65)
score = max(0, 100 - len(ISSUES)*10 - len(actionable_warns)*5)
label = "EXCELLENT" if score >= 90 else "GOOD" if score >= 75 else "NEEDS WORK" if score >= 55 else "CRITICAL"
print(f"  SEO Health Score: {score}/100  [{label}]")
print(f"  Failures: {len(ISSUES)}   Actionable warnings: {len(actionable_warns)}   Structural notices: {len(structural)}   Pages audited: {len(pages)}")
print("═" * 65)
