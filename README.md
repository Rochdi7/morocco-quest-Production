<div align="center">

<img src="public/assets/img/logo-bg.png" alt="Morocco Quest Logo" width="200"/>

# Morocco Quest

### *Authentic Private Tours & Luxury Travel Across Morocco*

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Filament](https://img.shields.io/badge/Filament-3.x-FDAE4B?style=for-the-badge&logo=php&logoColor=white)](https://filamentphp.com)
[![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-22C55E?style=for-the-badge)](LICENSE)

[**Visit Site**](https://morocco-quest.com) • [**Sitemap**](https://morocco-quest.com/sitemap.xml)

---

</div>

## About the Project

**Morocco Quest** is a production-grade Laravel application powering a luxury travel agency that curates private tours, Sahara desert adventures, cultural journeys, and bespoke experiences across Morocco. Built for international travelers seeking authentic, refined encounters — from the souks of Marrakech to the dunes of Merzouga.

The platform combines a high-converting public storefront with a powerful Filament admin panel, letting non-technical staff manage tours, activities, blogs, inquiries, and bookings without touching code.

---

## Features

### Public Storefront
- **Tour Catalog** — Multi-day private tours with rich itineraries, image galleries, and inquiry forms
- **Activities & Day Trips** — Single-day curated experiences across Marrakech, Fez, Rabat, Tangier, Casablanca, Essaouira, and Chefchaouen
- **Destinations Hub** — Location-based browsing by city and region
- **Travel Blog** — SEO-optimized articles with categories, tags, comments, and replies
- **Smart Search & Filters** — Multi-criteria search across tours, activities, places, and types
- **Inquiry System** — Dedicated inquiry forms per tour/activity with automatic email notifications
- **Newsletter Subscriptions** — Capture leads and stay in touch with prospects
- **Contact Forms** — Direct contact channels with SMTP delivery
- **Multi-Language Ready** — Locale-aware structure for future translations

### Admin Panel (Filament 3)
- **Tours Management** — CRUD with media library, types, places, statuses, featured flagging
- **Activities Management** — Categorized day-trips with images and pricing
- **Blog Management** — Rich text editor, categories, tags, comments moderation
- **Places & Categories** — Hierarchical taxonomy for destinations and activity types
- **Inquiries Dashboard** — Track tour and activity leads in one place
- **Homepage Builder** — Control featured tours, hero content, and CTAs without touching code

### SEO & Marketing
- **Dynamic XML Sitemap** at `/sitemap.xml` — auto-generated from DB content with `lastmod` timestamps
- **Schema.org Structured Data** — TravelAgency, FAQ, BlogPosting, BreadcrumbList, WebSite
- **Open Graph + Twitter Cards** — Rich social media previews
- **Canonical Tags + Robots Meta** — Clean indexing signals
- **Performance Optimized** — Deferred JS, image lazy-loading, OPcache, cached config/routes/views
- **Google Tag Manager + GA4** — Conversion tracking ready
- **Ahrefs + Bing Webmaster + Google Search Console** — Verified for all major SEO tools

### Technical Excellence
- **Laravel 12** with PHP 8.3+ — modern, fast, secure
- **Filament 3** admin — beautiful TALL-stack panel out of the box
- **Spatie Sitemap** + custom dynamic XML generator
- **Artesaos SEO Tools** — per-page meta tag control
- **Livewire** — reactive components without JS frameworks
- **Database sessions** — scales across multiple servers
- **Force HTTPS middleware** — secure-by-default in production
- **Storage symlinking** — public media served from `storage/app/public`

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 12.x |
| **Language** | PHP 8.3 |
| **Admin Panel** | Filament 3.x |
| **Database** | MySQL 8 |
| **Frontend** | Blade + Livewire + Alpine.js + Tailwind/Bootstrap hybrid |
| **JS Libraries** | jQuery, GSAP, Swiper, Owl Carousel, Magnific Popup, WOW.js |
| **SEO** | artesaos/seotools, spatie/laravel-sitemap |
| **Build Tool** | Vite |
| **Mail** | SMTP |
| **Sessions/Cache** | Database driver |

---

## Project Structure

```
public_html/
├── app/
│   ├── Filament/Resources/        # Admin panel resources
│   ├── Http/Controllers/          # 18+ controllers (tours, activities, blog, sitemap, inquiries, search)
│   ├── Models/                    # Eloquent models (Tour, Activity, Post, Place, Category, ...)
│   └── Http/Middleware/           # ForceHttps, custom middleware
├── resources/views/
│   ├── layouts/                   # app.blade.php (main) + app2.blade.php (alt)
│   ├── partials/                  # header, footer, navigation
│   ├── tours/ activities/ blog/   # Public-facing pages
│   └── sitemap/index.blade.php    # XML sitemap template
├── routes/
│   ├── web.php                    # Public routes (87+ defined)
│   └── console.php                # Artisan commands
├── public/
│   ├── assets/                    # Compiled CSS/JS/fonts/images
│   └── storage/                   # Symlinked uploaded media
└── storage/app/public/            # User uploads (tours, activities, blogs)
```

---

## Getting Started

### Prerequisites

- PHP 8.3+
- Composer 2.x
- MySQL 8
- Node.js 18+ & npm
- Apache or Nginx

### Installation

```bash
# Clone the repository
git clone https://github.com/Rochdi7/morocco-quest.git
cd morocco-quest

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env, then migrate
php artisan migrate --seed

# Create symlink for public storage
php artisan storage:link

# Build frontend assets
npm run build

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Local Development

```bash
# Start the dev server (with hot-reload, queue listener, log streaming)
composer dev
```

This runs `php artisan serve`, `queue:listen`, `pail` (logs), and `vite` concurrently.

### Production Deployment

```bash
# On the server, after pulling new code:
git pull origin main
composer install --no-dev --optimize-autoloader --classmap-authoritative
php artisan config:cache route:cache view:cache event:cache
php artisan migrate --force
```

> ⚠️ **Important:** Composer's `post-autoload-dump` script runs `filament:upgrade`, which **clears the Laravel caches**. Always re-run `php artisan config:cache route:cache view:cache event:cache` after `composer install`.

---

## Environment Variables

Key `.env` settings:

Copy `.env.example` to `.env` and fill in the required values. Key variables to configure:

| Variable | Description |
|---|---|
| `APP_ENV` | Set to `production` on live server |
| `APP_DEBUG` | Must be `false` in production |
| `APP_URL` | Your full domain with HTTPS |
| `DB_*` | Database connection credentials |
| `SESSION_DRIVER` | Use `database` for multi-server setups |
| `CACHE_STORE` | Use `database` or `redis` |
| `MAIL_*` | SMTP credentials for outbound email |

> Never commit `.env` to version control. Refer to `.env.example` for the full list of required variables.

---

## Performance Optimizations Applied

| # | Optimization | Impact |
|---|---|---|
| 1 | `APP_DEBUG=false` in production | Security + perf |
| 2 | All Laravel caches built (config/routes/views/events) | Saves ~200ms per request |
| 3 | All 14 frontend JS files use `defer` | Non-blocking page paint |
| 4 | Duplicate jQuery removed | No JS race condition |
| 5 | OPcache enabled | Compiled PHP cached in memory |
| 6 | Optimized Composer autoloader (`--classmap-authoritative`) | Faster class resolution |
| 7 | Schema-safe sitemap controller | No crashes on missing DB columns |
| 8 | Force HTTPS middleware | Single redirect, no chains |

---

## SEO Strategy

The site is built around a **hub-and-spoke** content architecture:

```
                ┌──────────────┐
                │  Home (hub)  │
                └──────┬───────┘
        ┌──────────────┼──────────────┐
        ▼              ▼              ▼
   ┌────────┐    ┌─────────┐    ┌─────────┐
   │ Tours  │    │Activities│    │  Blog   │
   └────┬───┘    └─────┬───┘    └────┬────┘
        │              │              │
   8 tours +      23 activities + 12 blog posts
   tour pages    place + category    + tags
                     pages
```

### Target Keywords (preserved across all pages)
- morocco private tours
- marrakech desert tours
- sahara desert tour from marrakech
- luxury desert tours marrakech
- best morocco private tour company
- private tours in morocco
- morocco itinerary

### Sitemap
Auto-generated XML at `https://morocco-quest.com/sitemap.xml` covering:
- 8 static pages (home, about, FAQ, contact, tours, activities, trips, blog)
- 8 tour detail pages
- 23 activity detail pages
- 12 blog posts
- All with `lastmod`, `changefreq`, and `priority`

---

## Roadmap

- [ ] **Cloudflare integration** for global edge caching
- [ ] **VPS migration** for consistent TTFB <400ms
- [ ] **Multi-language** (French + Spanish) — French is highest-leverage Morocco audience
- [ ] **Online booking & payment** (Stripe Checkout for tour deposits)
- [ ] **AI-powered itinerary builder** ("Plan my 7-day Morocco trip")
- [ ] **Customer reviews** with photo uploads + schema markup
- [ ] **WhatsApp Business integration** for instant inquiries
- [ ] **Tour availability calendar** with real-time slot management

---

## Contributing

This is a private commercial project. Internal team contributions follow this flow:

1. Create a feature branch from `main`
2. Make changes with clear, single-purpose commits
3. Open a pull request with screenshots/test plan
4. Wait for code review
5. Merge after approval + cache rebuild on production

---

## License

This project is proprietary software developed for **Morocco Quest DMC**. Code is shared under the MIT License for transparency; brand assets, content, and tour itineraries are © Morocco Quest and not licensed for reuse.

---

<div align="center">

### Built with care for travelers who want more than a vacation.

**[morocco-quest.com](https://morocco-quest.com)** • [Facebook](https://www.facebook.com/codesommetagency/) • [Instagram](https://www.instagram.com/moroccoquestdmc/) • [Tripadvisor](https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html)

*Marrakech, Morocco* 🇲🇦

</div>
