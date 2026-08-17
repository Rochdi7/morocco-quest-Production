import { PurgeCSS } from 'purgecss';
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..');

const baseSafelist = {
    standard: [
        'show', 'showing', 'hiding', 'active', 'disabled', 'fade',
        'collapse', 'collapsing', 'modal-open', 'modal-backdrop',
        'offcanvas-backdrop', 'was-validated', 'is-valid', 'is-invalid',
        'sticky', 'visible', 'hidden',
    ],
    greedy: [
        /^ui-/, /^mfp-/, /^swiper/, /^odometer/, /^daterangepicker/,
        /^drp-/, /^calendar/, /^wow$/, /^animated/, /^animate__/,
        /^pin-spacer/, /^gsap/, /animate-elements/, /^slick/, /^hero-/,
        /^tooltip/, /^bs-tooltip/, /^popover/,
        /^bs-popover/, /^dropdown-menu/, /^carousel-item/, /^breadcrumb/,
        /^pagination/, /^page-(item|link)/, /^flatpickr/,
    ],
};

process.chdir(root);

const sitewideContent = [
    'resources/views/**/*.blade.php',
    'assets/js/*.js',
    'assets/js/vendor/*.js',
    'app/Http/Controllers/**/*.php',
];

// layouts.app is used by exactly these 3 views (home, index, category-details) —
// see resources/views/layouts/app.blade.php comment. Scoping the homepage purge
// job to just what those views + the shared header/footer/layout actually render
// (instead of reusing the full sitewide content array) is what makes purged-home/
// genuinely smaller than the sitewide purged/ output.
const homeContent = [
    'resources/views/layouts/app.blade.php',
    'resources/views/home.blade.php',
    'resources/views/index.blade.php',
    'resources/views/category-details.blade.php',
    'resources/views/partials/header.blade.php',
    'resources/views/partials/footer.blade.php',
    'assets/js/*.js',
    'assets/js/vendor/*.js',
    'app/Http/Controllers/HomepageController.php',
];

const jobs = [
    {
        content: sitewideContent,
        css: ['assets/plugins/bootstrap.min.css', 'assets/css/style.min.css'],
        output: 'assets/css/purged/',
    },
    {
        content: homeContent,
        css: ['assets/plugins/bootstrap.min.css', 'assets/css/style.min.css'],
        output: 'assets/css/purged-home/',
    },
];

for (const job of jobs) {
    const results = await new PurgeCSS().purge({
        content: job.content,
        css: job.css,
        safelist: baseSafelist,
    });
    fs.mkdirSync(job.output, { recursive: true });
    for (const result of results) {
        const filename = path.basename(result.file);
        fs.writeFileSync(path.join(job.output, filename), result.css);
        console.log(`Wrote ${path.join(job.output, filename)} (${result.css.length} bytes)`);
    }
}
