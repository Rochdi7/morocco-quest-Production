# Skills Index — Local Morocco Tours

All Claude skill files live in `docs/skills/`. This file tells Claude what
each skill does and when to load it.

---

## 1. caveman.md
**Path:** `docs/skills/caveman.md`

**What it is:** A behaviour-override persona. When loaded it switches Claude
into "caveman engineer" mode — ultra-short responses, action first, zero
theory, minimal output format (NOW / DONE / BLOCKED / NEXT).

**When to use:** Tell Claude `load caveman mode` or `use caveman.md` when you
want fast, no-explanation execution — bulk edits, repetitive fixes, quick
debugging. Do NOT use when you need thoughtful architectural discussion.

**Key rules it enforces:**
- Speak short. No long explanation.
- Action first. Think → do → move.
- Output always: NOW / DONE / BLOCKED / NEXT
- No cloud, no deploy, no enterprise complexity.
- Localhost only.

**IMPORTANT for Claude:** This file OVERRIDES your default verbose style.
If the user says "caveman mode", read this file and apply every rule in it
for the rest of the session.

---

## 2. SKILL.md (frontend-design)
**Path:** `docs/skills/SKILL.md`
**Skill name:** `frontend-design`

**What it is:** A Claude Code skill plugin. It guides creation of
production-grade, visually distinctive frontend interfaces — HTML/CSS/JS,
React, Vue, landing pages, components.

**When to use:** Automatically triggered by the Claude Code skill system
when the user asks to build or style any web UI. Can also be invoked
manually: `/frontend-design`.

**Key design principles it enforces:**
- Bold, committed aesthetic direction (not generic "AI slop")
- Distinctive typography — never Inter/Roboto/Arial
- CSS variables, motion, spatial composition
- Never purple-gradient-on-white clichés
- Match code complexity to the aesthetic vision

**IMPORTANT for Claude:** This file has a YAML frontmatter header
(`name: frontend-design`). The Claude Code skill system reads that header
to register and trigger the skill automatically.

---

## 3. SEO skill (installed globally)
**Skill name:** `seo`
**Installed at:** `~/.claude/commands/seo.md` (global Claude Code install —
not in this repo)

**What it is:** A comprehensive SEO audit skill covering technical SEO,
schema markup, content quality (E-E-A-T), Core Web Vitals, GEO for AI
Overviews / ChatGPT / Perplexity, sitemap analysis, and more. Industry-aware
(detects travel/local/e-commerce sites automatically).

**When to use:** `/seo` — full site audit. Also triggered by keywords:
`SEO`, `audit`, `schema`, `Core Web Vitals`, `sitemap`, `E-E-A-T`,
`AI Overviews`, `GEO`, `technical SEO`, `content quality`, `page speed`,
`structured data`.

**Sub-skills it delegates to:**
- `seo-technical` — crawlability, indexability, URL structure, JS rendering
- `seo-schema` — JSON-LD structured data validation and generation
- `seo-content` — E-E-A-T, readability, thin content
- `seo-geo` — AI search visibility (ChatGPT, Perplexity, Gemini, Copilot)
- `seo-sitemap` — XML sitemap validation and generation
- `seo-local` — GBP signals, NAP consistency, citations
- `seo-performance` — Core Web Vitals, INP, LCP, CLS
- `seo-image-gen` — OG/social image audit
- `seo-page` — single-page deep analysis

**Project context:** Reports from SEO audit runs are saved in
`docs/reports/`. Start there before re-running a full audit.

---

## 4. seo-pass.md (seo-pass)
**Path:** `docs/skills/seo-pass.md`
**Skill name:** `seo-pass`

**What it is:** A full SEO production pass skill distilled from the complete
9-phase programme applied to local-morocco-tours.com. Works on both
**static HTML/CSS sites** and **Laravel/Blade projects**.

**When to use:** Say `run seo-pass`, `/seo-pass`, or `do the seo pass on this
project`. Load it at the start of any new project that needs end-to-end SEO
work, or when picking up an existing project mid-pass.

**What it covers:**
- Phase 0: project type detection (static vs Laravel), constraint reading,
  encoding rules, nav/footer sync mechanism
- Phase 1: keyword cannibalization audit + title/H1/meta fix
- Phase 2: hub intro uniqueness pass
- Phase 3: departure/product-specific content on detail pages (150–250 words)
- Phase 4: orphan page rescue (editorial body links)
- Phase 5: blog ↔ hub cross-linking
- Phase 6: entity mentions + topical authority
- Phase 7: schema (TouristTrip, FAQPage, BreadcrumbList, WebSite, BlogPosting)
- Phase 8: GEO/AI citation readiness (llms.txt, robots.txt, direct-answer blocks)
- Phase 9: pre-deploy audit (Python + PowerShell checks)

**Also includes:**
- UTF-8 no-BOM encoding rule (Windows PowerShell)
- Compressed sibling regeneration (`.br` / `.gz`)
- GSC indexing recovery action plan
- Common failure modes table (duplicate canonical, hidden FAQ, SF artifacts, etc.)
- Laravel-specific Blade patterns for all schema types

**IMPORTANT for Claude:** Read this skill before starting any SEO work on a
new project. It contains copy-paste code patterns for every phase.

---

## How to add a new skill

1. Drop the `.md` file in `docs/skills/`
2. Add an entry here in `SKILLS.md`
3. If it's a Claude Code plugin skill (has YAML frontmatter with `name:`),
   it may also need to be registered in `~/.claude/commands/` — check the
   Claude Code skill docs.
