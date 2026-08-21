{{-- ═══════════════════════════════════════════════════════
     DMC PAGE RHYTHM (shared)

     The theme's .space gives every section 120px top AND 120px bottom
     (80px on mobile). Because the DMC pages stack .space sections back
     to back, adjacent sections were producing 240px of dead space
     between blocks — the gap that made these pages feel broken.

     Fix: scope a tighter rhythm to DMC pages only. The global .space
     is left untouched so the rest of the site is unaffected.
═══════════════════════════════════════════════════════ --}}
<style>
    .dmc-page{
        /* One section gap = 72px desktop / 48px mobile, not 120/80 per side. */
        --dmc-space: 72px;
    }
    @media (max-width: 991px){
        .dmc-page{ --dmc-space: 48px; }
    }

    .dmc-page section.space{
        padding-top: var(--dmc-space);
        padding-bottom: var(--dmc-space);
    }
    .dmc-page section.space.pt-0{ padding-top: 0 !important; }
    .dmc-page section.space.pb-0{ padding-bottom: 0 !important; }

    /* Where two padded sections meet, halve the seam so the gap between
       blocks reads as one deliberate space instead of two stacked ones. */
    .dmc-page section.space + section.space{ padding-top: calc(var(--dmc-space) / 2); }

    /* A section that follows a pb-0 section supplies the whole gap itself. */
    .dmc-page section.space.pb-0 + section.space{ padding-top: var(--dmc-space); }

    /* Tighten the heading block above each section's content.
       The theme's .sec-title has a tight 122% line-height; on two-line
       titles the descenders were colliding with the .sec-subtitle above,
       so give the subtitle clearance and the title a little more leading. */
    .dmc-page .title-area{ margin-bottom: 24px; }
    .dmc-page .sec-subtitle{ margin-bottom: 10px; }
    .dmc-page .sec-title{ margin-bottom: 12px; line-height: 1.28; }
    .dmc-page .sec-title:last-child{ margin-bottom: 0; }

    /* Breathing room between the section heading block and its content. */
    .dmc-page .tb-tags{ margin-top: 34px; }

    /* mb-5 under a section heading is 48px on top of section padding. */
    .dmc-page .row > [class*="col-"] > .text-center.mb-5,
    .dmc-page .col-lg-8.text-center.mb-5{ margin-bottom: 28px !important; }

    /* ═══════════════════════════════════════════════════
       MOBILE PASS (≤767px)
       The theme has almost no small-screen rules for these DMC
       components, so cards ran very tall, titles wrapped to 3 lines
       and section rhythm felt loose. Everything below is scoped to
       .dmc-page so the rest of the site is untouched.
       ═══════════════════════════════════════════════════ */
    @media (max-width: 767px){

        /* ── Type scale ── */
        .dmc-page .breadcrumb-title{ font-size: 1.65rem !important; line-height: 1.22; }
        .dmc-page .vs-breadcrumb .breadcrumb-content p{ font-size: .9rem !important; line-height: 1.5; }
        .dmc-page .sec-title{ font-size: 1.42rem !important; line-height: 1.3; }
        .dmc-page .sec-title[style*="1.6rem"]{ font-size: 1.22rem !important; }
        .dmc-page .sec-subtitle{ font-size: .78rem; letter-spacing: .04em; margin-bottom: 8px; }
        .dmc-page section p{ font-size: .9rem; line-height: 1.6; }

        /* ── Section rhythm ── */
        .dmc-page .title-area{ margin-bottom: 18px; }
        .dmc-page .tb-tags{ margin-top: 22px; }
        .dmc-page .row > [class*="col-"] > .text-center.mb-5,
        .dmc-page .col-lg-8.text-center.mb-5{ margin-bottom: 20px !important; }

        /* ── Related-services cards: the tallest offender ──
           At col-6 each card was ~150px wide, so titles like "Destination
           Management Company" wrapped to 3 lines and the cards ran very
           tall. Give each card the full row width and use a 2-column grid
           inside it — icon in the first column, text in the second — so
           the text has room and the card height roughly halves. */
        .dmc-page .dmc-related .row > [class*="col-"]{
            flex: 0 0 100%;
            max-width: 100%;
        }
        .dmc-page .dmc-related__card{
            display: grid;
            grid-template-columns: 38px 1fr;
            grid-column-gap: 12px;
            align-items: start;
            padding: 14px;
            border-radius: 10px;
        }
        .dmc-page .dmc-related__icon{
            width: 38px; height: 38px; border-radius: 9px;
            font-size: .95rem; margin-bottom: 0;
            grid-column: 1; grid-row: 1 / span 3;
        }
        .dmc-page .dmc-related__title{
            grid-column: 2;
            font-size: .9rem; line-height: 1.3; margin-bottom: 3px;
        }
        .dmc-page .dmc-related__desc{
            grid-column: 2;
            font-size: .78rem; line-height: 1.45;
        }
        .dmc-page .dmc-related__go{
            grid-column: 2;
            margin-top: 8px; font-size: .76rem;
        }

        /* ── Product / tour cards ── */
        .dmc-page .tour-package-content{ padding: 14px 14px 16px; }
        .dmc-page .tour-package-content .title{ font-size: .92rem; line-height: 1.3; }
        .dmc-page .tour-package-content .location,
        .dmc-page .tour-package-footer{ font-size: .78rem; }

        /* ── Stat cards under Why-Marrakech images ── */
        .dmc-page .row.g-3 > .col-6 > div[style*="border-radius:10px"]{ padding: 13px 10px !important; }

        /* ── Forms: 16px inputs stop iOS zooming on focus ── */
        .dmc-page .form-style1 .form-control{ font-size: 16px; height: 50px; }
        .dmc-page .form-style1 textarea.form-control{ height: auto; }
        .dmc-page .form-style1 label{ font-size: .84rem; }

        /* ── Buttons ── */
        .dmc-page .vs-btn{ font-size: 12.5px; padding: 12px 20px; }

        /* ── Accordion / FAQ ── */
        .dmc-page .accordion-button{ font-size: .86rem !important; padding-right: 44px !important; }
    }

    /* ── Very small screens ── */
    @media (max-width: 479px){
        .dmc-page .breadcrumb-title{ font-size: 1.42rem !important; }
        .dmc-page .sec-title{ font-size: 1.28rem !important; }
        .dmc-page .dmc-related__card{ padding: 12px 12px; }
        .dmc-page .dmc-related__title{ font-size: .86rem; }
        .dmc-page .dmc-related__desc{ font-size: .75rem; }
    }
</style>
