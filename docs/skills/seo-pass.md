---
name: seo-pass
description: >
  Full SEO production pass for static HTML/CSS sites and Laravel projects.
  Covers keyword cannibalization, thin content, orphan pages, internal link
  gaps, schema markup (TouristTrip, FAQPage, BreadcrumbList, WebSite,
  BlogPosting), GEO/AI-citation readiness, title/H1/meta cleanup, and
  pre-deploy audit. Based on the complete production pass applied to
  local-morocco-tours.com across 9 phases in 2026.
---

# SEO Production Pass Skill

The user provides a project root containing HTML files (static site) or a
Laravel `resources/views/` tree. They may give a URL, a folder path, or just
say "run the SEO pass". Execute the phases below in order, skipping any that
do not apply to the project type detected.

---

## Phase 0 — Detect project type + constraints

Before touching any file:

1. **Detect stack:**
   - Static HTML: look for `.html` files at root or in sub-folders.
   - Laravel: look for `artisan`, `resources/views/`, Blade `{{ }}` / `@extends`.
2. **Read CLAUDE.md** (if present) for project-specific constraints — honour
   every rule there BEFORE acting.
3. **Detect encoding rule:**
   - Static HTML on Windows: use
     `[System.IO.File]::ReadAllText / WriteAllText` with
     `[System.Text.UTF8Encoding]::new($false)` (UTF-8, no BOM). Never use
     `Get-Content / Set-Content` for bulk HTML edits — they corrupt encoding.
   - Python scripts: `open(path, encoding='utf-8', newline='\n')`.
   - Laravel: Blade files are UTF-8; standard file write is fine.
4. **Identify nav/footer sync mechanism:**
   - Static: if a sync script exists (e.g. `c:/tmp/sync_nav_footer.py`),
     do NOT edit nav/footer in individual page files. Edit the source
     (`index.html` or equivalent) and run the sync script.
   - Laravel: nav/footer is in a shared layout (`layouts/app.blade.php` or
     similar) — edit only that file.
5. **List all canonical HTML pages** (exclude error pages, verification
   stubs, redirect stubs, `noindex` utility pages like `wishlist.html`).
6. **Read `robots.txt`** and **`.htaccess`** (or `routes/web.php` for
   Laravel) to understand redirect chains before diagnosing indexing issues.

---

## Phase 1 — Keyword cannibalization audit + fix

### Detect
Scrape every page's `<title>`, `<h1>`, and `<meta name="description">`.

Flag pages that share the first 4+ meaningful words in their title. Group by
shared prefix. Any group with 3+ pages is a critical cannibalization cluster.

Common patterns to look for:
- Every hub page titled `[Brand Keyword] & [Page Topic]` — kills topical clarity.
- City-hub pages all titled `[Primary Keyword] from [City]` — acceptable at 2–3
  cities but damaging at 5+.
- Day-trip / activity / trekking pages inheriting the brand's desert/tour keyword.

### Fix
For each over-cannibalized page, rewrite:
- `<title>` → destination-intent first: `[City/Topic] [Page Type] | [Brand]`
- `<h1>` → match the page's actual topic, not the brand keyword
- `<meta name="description">` → 150–160 chars, primary keyword in first 60 chars

Rules:
- The ONE page that should rank for the primary keyword keeps it. All others
  get intent-matched titles.
- Activity pages → title/H1 leads with the activity, not the brand tour keyword.
- Day-trip hubs → title/H1 leads with city + "day trips", not "desert tours".
- Trekking hubs → title/H1 leads with mountain/route name.
- If two hub pages target nearly identical queries, differentiate them:
  one becomes the broad hub, the other becomes the specific sub-topic hub.

### Static site — title edit pattern (Python, UTF-8 safe)
```python
import os, re

def read(path):
    with open(path, 'r', encoding='utf-8') as f:
        return f.read()

def write(path, text):
    with open(path, 'w', encoding='utf-8', newline='\n') as f:
        f.write(text)

def fix_title(path, old_title, new_title):
    text = read(path)
    if old_title in text:
        write(path, text.replace(old_title, new_title))
        return True
    return False
```

### Laravel — Blade title pattern
Blade pages use `@section('title', '...')` or a `<title>` in the layout.
Edit the `@section('title')` in the individual view, NOT the layout.

---

## Phase 2 — Hub intro uniqueness pass

Every hub/collection page must have a **unique first paragraph** that:
- Matches the departure city's actual geography and travel context
- Does NOT copy-paste from other hub pages
- Links to 1–2 related hubs or blog posts in the body

Uniqueness test: if the intro paragraph could appear word-for-word on a
different hub page without modification, rewrite it.

Minimum intro length: 100 words of unique prose (after subtracting shared
boilerplate like nav/footer counts).

---

## Phase 3 — Departure-specific content on detail pages

Every tour/product detail page needs a **150–250 word section** unique to the
departure city/context. This section should:
- Reference the specific departure city's context (what makes it unique as a
  starting point, travel distance, route highlights, what the traveller sees
  first)
- Not be copy-pasteable to a different city's page

Insert as a `<section>` block before the CTA band (or before `</main>` in
Laravel).

### Insertion helper (Python)
```python
def insert_before_cta(html, section_html):
    marker = '\n    <section class="cta-band">'
    idx = html.find(marker)
    if idx == -1:
        # fallback: before </main>
        idx = html.rfind('</main>')
        if idx == -1:
            return None
    return html[:idx] + '\n' + section_html + html[idx:]
```

---

## Phase 4 — Orphan page rescue

An orphan page has 0–2 body-content links pointing to it from other pages
(nav/footer links don't count — Google discounts repeated navigation links).

### Detect
For each hub page URL, `grep` all other pages' `<main>` content for a link
to that URL. Pages with 0 body links are critical orphans.

### Fix
- Add a body link to each orphan from the most relevant existing page
  (the homepage body, a thematically related hub, or a blog post).
- The anchor text should be descriptive and keyword-natural.
- For static sites: 3+ editorial body links per hub is the target minimum.
- Do NOT add orphan rescue links to nav/footer — Google discounts them.

---

## Phase 5 — Blog ↔ hub cross-linking

Each blog post should link to 2–3 relevant tour/hub pages in its body.
Each tour hub should link to 1 relevant blog post.

Link placement: natural prose mention, not a standalone "Read more" line.
Use anchor text that matches the linked page's primary keyword.

---

## Phase 6 — Entity mentions + topical authority signals

For travel / hospitality / local business sites:
- Embed named landmark entities (mountain passes, gorges, archaeological
  sites, historic neighbourhoods) naturally into tour descriptions.
- These named entities help AI systems and knowledge graph enrichment.

For other verticals: embed category-defining named entities relevant to your
industry (product names, technique names, location names, standard bodies).

---

## Phase 7 — Schema markup

### Required on every page
```html
<!-- TravelAgency / Organization: site-wide in footer or layout -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TravelAgency",
  "name": "...",
  "url": "...",
  "logo": "...",
  "telephone": "...",
  "address": { "@type": "PostalAddress", "addressLocality": "...", "addressCountry": "..." },
  "foundingDate": "...",
  "sameAs": ["...social profiles..."]
}
</script>
```

### Required on tour/product detail pages
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TouristTrip",
  "name": "PAGE TITLE",
  "description": "META DESCRIPTION",
  "url": "CANONICAL URL",
  "image": "OG IMAGE URL",
  "touristType": "Private",
  "duration": "P3D",
  "itinerary": {
    "@type": "ItemList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1,
        "item": { "@type": "Place", "name": "Departure City, Country",
                  "address": { "@type": "PostalAddress", "addressCountry": "MA" } } }
    ]
  },
  "provider": {
    "@type": "TravelAgency",
    "name": "...",
    "url": "...",
    "telephone": "..."
  },
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock",
    "priceCurrency": "EUR",
    "url": "CANONICAL URL"
  }
}
</script>
```

Duration parser from URL slug:
```python
import re
def parse_duration(slug):
    m = re.search(r'(\d+)-days?', slug)
    return 'P' + m.group(1) + 'D' if m else 'P3D'
```

### Required on hub/listing pages
```html
<!-- FAQPage: 4 Q/A pairs, questions tailored to page intent -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    { "@type": "Question", "name": "...", "acceptedAnswer": { "@type": "Answer", "text": "..." } },
    { "@type": "Question", "name": "...", "acceptedAnswer": { "@type": "Answer", "text": "..." } }
  ]
}
</script>
```

**CRITICAL:** FAQ schema only generates rich results if the Q/A content is
also **visible in the page HTML** (not just in `<head>` JSON-LD).
Add a `<section class="faq">` with the same questions and answers in the
page body, or Google will suppress the rich result.

### Required on the homepage
```html
<!-- WebSite + SearchAction -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": "https://...",
  "name": "...",
  "potentialAction": {
    "@type": "SearchAction",
    "target": { "@type": "EntryPoint", "urlTemplate": "https://.../?s={search_term_string}" },
    "query-input": "required name=search_term_string"
  }
}
</script>
```

### Required on blog posts
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "...",
  "description": "...",
  "url": "...",
  "image": "...",
  "datePublished": "...",
  "dateModified": "...",
  "author": { "@type": "Person", "name": "..." },
  "publisher": { "@type": "Organization", "name": "...", "logo": { "@type": "ImageObject", "url": "..." } }
}
</script>
```

### BreadcrumbList — every page except homepage
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://..." },
    { "@type": "ListItem", "position": 2, "name": "Hub Name", "item": "https://.../hub/" },
    { "@type": "ListItem", "position": 3, "name": "Page Title" }
  ]
}
</script>
```

### Laravel schema injection
In Blade, inject JSON-LD in a `@push('head')` / `@section('schema')` block
in the individual view, not the shared layout.

---

## Phase 8 — GEO / AI citation readiness

GEO (Generative Engine Optimization) makes pages citable by ChatGPT,
Google AI Overviews, Perplexity, and Gemini.

### robots.txt — allow AI crawlers explicitly
```
User-agent: GPTBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: CCBot
Allow: /
```

### llms.txt — site map for AI crawlers
Create `/llms.txt` at the domain root. Format:
```
# [Site Name]
## What this site is
[1–2 sentence description]

## Key pages
- [Page Title]: [URL] — [one-line description]
- ...
```

List the 20–30 most important pages. AI crawlers read this to decide what
to cite.

### Direct-answer blocks
Add a 40–60 word "quick answer" paragraph at the top of any page that
targets an informational query. Place it before the first `<h2>`. AI
Overviews extract the first direct answer they find.

### Content extractability checklist
- [ ] Every page has a unique H1 that directly states the page topic
- [ ] First paragraph answers the page's primary question within 150 words
- [ ] FAQ content is visible in HTML body (not just JSON-LD `<head>` schema)
- [ ] Blog posts have visible author name + date
- [ ] Key stats/facts are in `<strong>` or table format (AI systems prefer
       structured data they can extract)
- [ ] No important content is behind a JS-only render (static HTML or SSR)

---

## Phase 9 — Pre-deploy audit

Run this checklist before every deployment. Report findings and fix the
"FAIL" items.

```python
import os, re
from pathlib import Path

def audit(root, base_url):
    pages = list(Path(root).rglob('*.html'))
    # exclude: error pages, verification stubs, redirect stubs

    titles = {}
    h1s = {}
    descs = {}
    canonicals = {}
    issues = []

    for p in pages:
        text = p.read_text(encoding='utf-8', errors='replace')

        # skip noindex pages
        if re.search(r'content=["\']noindex', text):
            continue

        rel = str(p.relative_to(root))

        # --- 1. Duplicate titles ---
        m = re.search(r'<title>\s*(.*?)\s*</title>', text, re.DOTALL)
        title = m.group(1).strip() if m else ''
        if title in titles:
            issues.append(f'DUPLICATE TITLE: {rel} == {titles[title]}')
        else:
            titles[title] = rel

        # --- 2. Missing / duplicate H1 ---
        h1_matches = re.findall(r'<h1[^>]*>(.*?)</h1>', text, re.DOTALL)
        if len(h1_matches) == 0:
            issues.append(f'MISSING H1: {rel}')
        elif len(h1_matches) > 1:
            issues.append(f'MULTIPLE H1: {rel} ({len(h1_matches)} found)')

        # --- 3. Duplicate meta description ---
        m = re.search(r'<meta\s+name="description"\s+content="([^"]+)"', text)
        desc = m.group(1).strip() if m else ''
        if desc in descs and desc:
            issues.append(f'DUPLICATE META DESC: {rel} == {descs[desc]}')
        else:
            descs[desc] = rel

        # --- 4. Missing alt on <img> ---
        for img in re.findall(r'<img\s[^>]+>', text, re.DOTALL):
            if 'aria-hidden="true"' in img:
                continue
            if not re.search(r'alt="[^"]*"', img):
                issues.append(f'MISSING ALT: {rel}')
                break

        # --- 5. Multiple canonical tags ---
        canonicals_found = re.findall(r'rel="canonical"', text)
        if len(canonicals_found) > 1:
            issues.append(f'DUPLICATE CANONICAL ({len(canonicals_found)}): {rel}')

        # --- 6. Canonical mismatch ---
        m = re.search(r'<link\s+rel="canonical"\s+href="([^"]+)"', text)
        if m:
            canon = m.group(1)
            # title mismatch check (crude): canonical should contain base_url
            if base_url not in canon:
                issues.append(f'CANONICAL DOMAIN MISMATCH: {rel} → {canon}')

        # --- 7. Keyword cannibalization (title prefix) ---
        # flag titles sharing first 4 normalised words
        words = re.sub(r'[^a-z0-9 ]', '', title.lower()).split()[:4]
        prefix = ' '.join(words)
        if prefix in canonicals and prefix:
            issues.append(f'CANNIBAL TITLE PREFIX "{prefix}": {rel}')
        else:
            canonicals[prefix] = rel

    return issues
```

### Checklist items
1. ✅ All pages have unique `<title>` tags
2. ✅ All pages have exactly one `<h1>`
3. ✅ All pages have unique meta descriptions
4. ✅ All `<img>` tags have non-empty `alt` (except `aria-hidden="true"`)
5. ✅ No page has more than one `<link rel="canonical">`
6. ✅ Canonical URLs use the correct domain (https + www or non-www, consistent)
7. ✅ No title cannibalization groups with 3+ pages sharing the same 4-word prefix
8. ✅ No orphan pages (0 body inbound links) except intentionally excluded pages
9. ✅ sitemap.xml `<lastmod>` values are current (within 7 days of last edit)
10. ✅ `robots.txt` disallows error/utility pages and allows AI crawlers
11. ✅ Pre-compressed `.br` / `.gz` siblings regenerated after HTML edits

### Compressed sibling regeneration (Windows PowerShell)
```powershell
Get-ChildItem -Recurse -Include *.html | ForEach-Object {
    $f = $_.FullName
    & brotli -q 11 -f "$f" -o "$f.br"
    & gzip -9 -f -k "$f"
}
```

---

## Critical rules — apply to ALL projects

### Encoding (static HTML + Windows)
Always use:
```powershell
$text = [System.IO.File]::ReadAllText($path, [System.Text.Encoding]::UTF8)
# ... modify $text ...
[System.IO.File]::WriteAllText($path, $text, [System.Text.UTF8Encoding]::new($false))
```
Never use `Get-Content` / `Set-Content` for site HTML — they introduce
UTF-16 or BOM corruption that shows up as `â€"` `â€™` `â‚¬` mojibake.

### Paths — static HTML
Always use **depth-aware relative paths** (`../../assets/css/modern.css`),
never root-relative paths (`/assets/css/modern.css`). Root-relative paths
break when opening HTML directly from disk (`file://`).

### Nav/footer — static HTML
Never edit nav/footer directly in 100+ individual page files.
Edit the canonical source file and run the sync script.

### URL slugs — never rename
Tour/product URL slugs carry SEO equity. Never rename a folder slug even
if it contains a typo. Fix the misspelling in the title, not the URL.

### Laravel-specific rules
- Titles/meta: use `@section('title')` in child views, never hardcode in
  the shared layout.
- Schema JSON-LD: use `@push('scripts')` or `@section('schema')` in child
  views.
- Canonical URLs: generate with `{{ url()->current() }}` or
  `{{ route('...') }}` — never hardcode.
- Internal links: always use named routes (`{{ route('tours.show', $tour) }}`)
  so slugs can be changed in one place.
- Blade `{{ }}` auto-escapes — use `{!! !!}` only for trusted HTML
  (e.g. pre-built JSON-LD strings).

---

## Quick-reference — what each phase fixes

| Phase | Fixes | Impact |
|---|---|---|
| 1 | Cannibalized titles/H1s | Google stops oscillating; one clear winner per keyword |
| 2 | Generic hub intros | Reduces content similarity score; improves topical clarity |
| 3 | Detail page thin content | Adds 150–250 unique words per tour; kills "crawled not indexed" |
| 4 | Orphan pages | Editorial body links → PageRank flows to isolated pages |
| 5 | Blog/hub cross-links | Improves crawl discovery; reinforces topical clusters |
| 6 | Entity mentions | Knowledge graph enrichment; AI citation signals |
| 7 | Schema (TouristTrip, FAQ, Breadcrumb) | Rich results (stars, FAQ accordion, breadcrumb trail) |
| 8 | GEO / llms.txt / AI crawlers | AI Overview + ChatGPT citations |
| 9 | Pre-deploy audit | Catch regressions before they go live |

---

## Indexing recovery — GSC actions (post-deploy)

After deploying all phases above:

1. Bump every `<lastmod>` in `sitemap.xml` to today's date.
2. Resubmit `sitemap.xml` in Google Search Console **and** Bing Webmaster Tools.
3. Use GSC URL Inspection → "Request Indexing" on the top 10 priority pages
   (max ~10/day per GSC property).
4. Monitor GSC "Pages" report weekly — "Discovered not indexed" count should
   fall within 2–4 weeks after pre-compressed files are deployed.

Timeline expectation:
- Week 1–2: ghost URL count drops, crawl budget freed
- Week 2–4: "Crawled not indexed" pages move to "Indexed"
- Week 4–8: ranking movement on primary keywords
- Week 8–12: compound effect of schema + links + clean index visible

---

## Common failure modes from real projects

| Symptom | Root cause | Fix |
|---|---|---|
| GSC "validate fix" failed after edits | Duplicate `<link rel="canonical">` tags (Pass 2 added a second one above the OG block) | `grep -c 'rel="canonical"'` across all pages; keep only one |
| SF marks page "non-indexable" despite `robots: index,follow` | Screaming Frog crawled from a redirect URL (e.g. `/page.htm` redirects to `/page.html`; SF flags the `.htm` as non-indexable, not the destination) | Not a real issue — check the destination URL independently |
| FAQ schema present but no rich result | FAQ answers exist only in `<head>` JSON-LD, not in visible HTML body | Add visible `<section class="faq">` with same Q/A text |
| Mobile pages "different from desktop" in GSC | `<meta viewport="width=1100">` from legacy build | Replace with `width=device-width, initial-scale=1` |
| Encoding mojibake after bulk edit | `Set-Content` or `Get-Content` with default PowerShell encoding | Use `[System.IO.File]::ReadAllText/WriteAllText` with explicit UTF-8 no-BOM |
| 33 "non-indexable" in a redirected folder | `.htaccess` 301 redirect on the folder; SF counts redirect + all assets | Correct SEO practice — 301 consolidates equity; ignore SF count |
