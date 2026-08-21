{{-- ═══════════════════════════════════════════════════════
     CLIENT TESTIMONIALS — auto-rotating carousel (shared across DMC pages)
═══════════════════════════════════════════════════════ --}}
@php
    $dmcTestimonials = [
        [
            'quote' => "Morocco Quest handled our 120-person incentive group flawlessly — from the Marrakech airport pickup to the private Sahara camp dinner. Their local knowledge and responsiveness are unmatched. We've made them our exclusive Morocco DMC partner.",
            'name'  => 'Sophie M.',
            'role'  => 'Incentive Travel Director — Paris, France',
            'initials' => 'SM',
        ],
        [
            'quote' => "The net rates are very competitive and the turnaround time on quotes is impressive. Highly recommend Morocco Quest as a reliable DMC partner in Marrakech.",
            'name'  => 'James T.',
            'role'  => 'Tour Operator — London, UK',
            'initials' => 'JT',
        ],
        [
            'quote' => "We ran a four-day congress with parallel sessions and an exhibition hall, and their on-site team solved every issue before we even noticed it. Flawless delivery from a partner who genuinely knows the ground.",
            'name'  => 'Dr. Elena R.',
            'role'  => 'Scientific Committee Chair — Madrid, Spain',
            'initials' => 'ER',
        ],
        [
            'quote' => "From venue sourcing to the gala dinner production, everything was handled under one contract and one point of contact. It made selling Morocco to our client effortless.",
            'name'  => 'Michael B.',
            'role'  => 'Event Agency Director — Toronto, Canada',
            'initials' => 'MB',
        ],
    ];
@endphp

<section class="space bg-theme-07 dmc-tst">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <span class="sec-subtitle">What Our Partners Say</span>
                <h2 class="sec-title">Trusted by Travel Agents &amp; Event Planners</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="dmc-tst__stage">
                    <button type="button" class="dmc-tst__nav dmc-tst__nav--prev" aria-label="Previous testimonial">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="dmc-tst__viewport">
                        <div class="dmc-tst__track">
                            @foreach($dmcTestimonials as $i => $t)
                            <figure class="dmc-tst__slide {{ $i === 0 ? 'is-active' : '' }}" data-index="{{ $i }}">
                                <div class="dmc-tst__card">
                                    <span class="dmc-tst__mark" aria-hidden="true">&ldquo;</span>
                                    <div class="dmc-tst__stars">★★★★★</div>
                                    <blockquote class="dmc-tst__quote">{{ $t['quote'] }}</blockquote>
                                    <figcaption class="dmc-tst__author">
                                        <div class="dmc-tst__avatar">{{ $t['initials'] }}</div>
                                        <div class="dmc-tst__meta">
                                            <div class="dmc-tst__name">{{ $t['name'] }}</div>
                                            <div class="dmc-tst__role">{{ $t['role'] }}</div>
                                        </div>
                                    </figcaption>
                                </div>
                            </figure>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="dmc-tst__nav dmc-tst__nav--next" aria-label="Next testimonial">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

                {{-- Dots --}}
                <div class="dmc-tst__dots" role="tablist" aria-label="Testimonials">
                    @foreach($dmcTestimonials as $i => $t)
                    <button type="button" class="dmc-tst__dot {{ $i === 0 ? 'is-active' : '' }}"
                            data-goto="{{ $i }}" aria-label="Show testimonial {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .dmc-tst__stage{ position:relative; display:flex; align-items:center; gap:14px; }
    .dmc-tst__viewport{ position:relative; overflow:hidden; flex:1 1 auto; padding:14px 4px; }
    /* Track height comes from the active slide only. Inactive slides are taken
       out of flow so they never stack extra height under the card. */
    .dmc-tst__track{ position:relative; }
    .dmc-tst__slide{
        position:absolute; top:0; left:0; right:0; margin:0;
        opacity:0; visibility:hidden; pointer-events:none;
        transform:translateY(22px) scale(.97);
        transition:opacity .55s ease, transform .55s ease, visibility .55s;
    }
    .dmc-tst__slide.is-active{
        position:relative;
        opacity:1; visibility:visible; pointer-events:auto; transform:none;
    }

    /* Card */
    .dmc-tst__card{
        position:relative; overflow:hidden;
        background:#fff; border-radius:18px;
        padding:48px 46px 38px;
        box-shadow:0 18px 50px rgba(24,22,19,.10);
        text-align:center; height:100%;
    }
    .dmc-tst__card::before{
        content:""; position:absolute; top:0; left:0; right:0; height:5px;
        background:linear-gradient(90deg, var(--theme-color), #e9a86b);
    }
    .dmc-tst__mark{
        position:absolute; top:6px; right:26px;
        font-family:Georgia,"Times New Roman",serif;
        font-size:9rem; line-height:1; color:var(--theme-color);
        opacity:.09; pointer-events:none; user-select:none;
    }
    .dmc-tst__stars{
        color:var(--theme-color); letter-spacing:3px; font-size:1.05rem;
        margin-bottom:20px; position:relative;
    }
    .dmc-tst__quote{
        font-size:1.24rem; font-style:italic; color:#2c2a27; line-height:1.68;
        margin:0 auto 30px; border:0; padding:0; max-width:680px; position:relative;
    }
    .dmc-tst__author{
        display:inline-flex; align-items:center; gap:14px; text-align:left;
        padding-top:22px; border-top:1px solid #efeae4;
    }
    .dmc-tst__avatar{
        width:56px; height:56px; border-radius:50%; flex-shrink:0;
        background:linear-gradient(135deg, var(--theme-color), #c9773a);
        color:#fff; font-weight:700; font-size:1.05rem; letter-spacing:.5px;
        display:flex; align-items:center; justify-content:center;
        box-shadow:0 6px 16px rgba(201,119,58,.35);
    }
    .dmc-tst__name{ font-weight:700; font-size:1rem; color:var(--title-color); line-height:1.2; }
    .dmc-tst__role{ font-size:.85rem; color:#8a8378; margin-top:2px; }

    /* Side arrows */
    .dmc-tst__nav{
        flex:0 0 auto; width:46px; height:46px; border-radius:50%;
        border:1px solid #e4ddd4; background:#fff; color:var(--theme-color);
        cursor:pointer; display:flex; align-items:center; justify-content:center;
        font-size:.95rem; box-shadow:0 4px 14px rgba(0,0,0,.06);
        transition:background .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
        z-index:2;
    }
    .dmc-tst__nav:hover{ background:var(--theme-color); color:#fff; transform:scale(1.08); box-shadow:0 8px 20px rgba(201,119,58,.3); }

    /* Dots */
    .dmc-tst__dots{ display:flex; justify-content:center; gap:9px; margin-top:28px; }
    .dmc-tst__dot{
        width:9px; height:9px; border-radius:50%; border:0; padding:0; cursor:pointer;
        background:rgba(24,22,19,.16); transition:width .3s ease, background .3s ease;
    }
    .dmc-tst__dot.is-active{ width:26px; border-radius:5px; background:var(--theme-color); }

    @media (max-width:767px){
        .dmc-tst__nav{ display:none; }
        .dmc-tst__card{ padding:40px 26px 30px; }
        .dmc-tst__quote{ font-size:1.08rem; line-height:1.6; }
        .dmc-tst__mark{ font-size:6.5rem; top:2px; right:16px; }
    }
    @media (prefers-reduced-motion: reduce){
        .dmc-tst__slide{ transition:opacity .2s ease; transform:none; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.dmc-tst').forEach(function(section){
        const slides = Array.from(section.querySelectorAll('.dmc-tst__slide'));
        const dots   = Array.from(section.querySelectorAll('.dmc-tst__dot'));
        const prev   = section.querySelector('.dmc-tst__nav--prev');
        const next   = section.querySelector('.dmc-tst__nav--next');
        if(slides.length < 2) return;
        let idx = 0, timer = null;
        const DELAY = 5500;

        function show(n){
            idx = (n + slides.length) % slides.length;
            slides.forEach((s,i)=> s.classList.toggle('is-active', i === idx));
            dots.forEach((d,i)=> d.classList.toggle('is-active', i === idx));
        }
        function advance(){ show(idx + 1); }
        function start(){ stop(); timer = setInterval(advance, DELAY); }
        function stop(){ if(timer){ clearInterval(timer); timer = null; } }

        dots.forEach(function(dot){
            dot.addEventListener('click', function(){
                show(parseInt(dot.dataset.goto, 10));
                start();
            });
        });
        if(prev) prev.addEventListener('click', function(){ show(idx - 1); start(); });
        if(next) next.addEventListener('click', function(){ show(idx + 1); start(); });

        // Pause on hover, resume on leave
        section.addEventListener('mouseenter', stop);
        section.addEventListener('mouseleave', start);

        // Pause when tab not visible
        document.addEventListener('visibilitychange', function(){
            document.hidden ? stop() : start();
        });

        show(0);
        start();
    });
});
</script>
