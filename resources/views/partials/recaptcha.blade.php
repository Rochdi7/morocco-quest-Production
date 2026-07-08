{{--
    Reusable Google reCAPTCHA v2 (Checkbox) widget.

    Include this just above a form's submit button:

        @include('partials.recaptcha')

    Renders nothing when reCAPTCHA is not configured/enabled, so pages behave
    exactly as before if keys are absent (no layout or spacing impact). The
    Google API script itself is loaded once, globally, from partials.footer.
--}}
@if (config('recaptcha.enabled') && config('recaptcha.site_key'))
    <div class="col-12 form-group">
        <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
        @error('g-recaptcha-response')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
@endif
