// PurgeCSS config — strips unused rules from the two render-blocking stylesheets.
// Re-run after adding new views or classes:  npx purgecss --config purgecss.config.js
// Output goes to assets/css/purged/ — the layouts reference those copies;
// the original files stay untouched as source of truth / rollback.
module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        // JS is scanned for class-name strings, so classes toggled at runtime
        // (bootstrap's "show"/"collapsing", theme classes in main.js, swiper,
        // magnific-popup, daterangepicker DOM) are kept automatically.
        './assets/js/*.js',
        './assets/js/vendor/*.js',
        './app/Http/Controllers/**/*.php',
    ],
    css: [
        './assets/plugins/bootstrap.min.css',
        './assets/css/style.min.css',
    ],
    output: './assets/css/purged/',
    safelist: {
        // Exact state classes toggled by bootstrap JS (also caught by the JS
        // content scan — listed here as belt-and-braces).
        standard: [
            'show', 'showing', 'hiding', 'active', 'disabled', 'fade',
            'collapse', 'collapsing', 'modal-open', 'modal-backdrop',
            'offcanvas-backdrop', 'was-validated', 'is-valid', 'is-invalid',
            'sticky', 'visible', 'hidden',
        ],
        // Plugin/vendor prefixes that might be composed at runtime.
        greedy: [
            /^ui-/, /^mfp-/, /^swiper/, /^odometer/, /^daterangepicker/,
            /^drp-/, /^calendar/, /^wow$/, /^animated/, /^animate__/,
            /^pin-spacer/, /^gsap/, /animate-elements/, /^slick/, /^hero-/,
            /^tooltip/, /^bs-tooltip/, /^popover/,
            /^bs-popover/, /^dropdown-menu/, /^carousel-item/, /^breadcrumb/,
            /^pagination/, /^page-(item|link)/, /^flatpickr/,
        ],
    },
};
