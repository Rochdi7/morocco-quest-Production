{{--
    Reusable Google reCAPTCHA v2 (Invisible) placeholder.

    Include this just above a form's submit button:

        @include('partials.recaptcha')

    It renders an (invisible) widget mount point that the global init script
    (see partials.footer) binds to the enclosing <form>. On submit the script
    calls grecaptcha.execute(), receives a token, injects it as the hidden
    "g-recaptcha-response" field, then submits the form. No visible checkbox,
    no layout impact — only the floating reCAPTCHA badge appears (bottom-right).

    Renders nothing when reCAPTCHA is not configured/enabled, so pages behave
    exactly as before if keys are absent. The Google API script itself is
    loaded once, globally, from partials.footer.
--}}
@if (config('recaptcha.enabled') && config('recaptcha.site_key'))
    <div class="col-12 form-group mq-recaptcha-group">
        {{-- Init script renders the invisible widget into this element. --}}
        <div class="g-recaptcha-invisible" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
        @error('g-recaptcha-response')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
@endif
