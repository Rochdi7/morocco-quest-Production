# Morocco Quest Production

## Rules
- Always follow `caveman.md` style (short, action-first, low-token).
- Output format: NOW / DONE / BLOCKED / NEXT.
- Use Claude SEO skills for all SEO work (installed at `~/.claude/skills/seo*`).
- Prefer short summaries, action lists, exact file paths.
- Never expose secrets or `.env` values.
- Localhost only. No deploy.

## SEO Skills Available
`/seo`, `/seo-audit`, `/seo-page`, `/seo-schema`, `/seo-technical`,
`/seo-content`, `/seo-geo`, `/seo-local`, `/seo-images`, `/seo-sitemap`,
plus: backlinks, cluster, competitor-pages, dataforseo, drift, ecommerce,
firecrawl, google, hreflang, image-gen, maps, plan, programmatic, sxo.

## Stack
Laravel + Filament (PHP). See `composer.json`, `package.json`.
