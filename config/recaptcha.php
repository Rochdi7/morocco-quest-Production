<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google reCAPTCHA v2 (Checkbox) Configuration
    |--------------------------------------------------------------------------
    |
    | Keys are pulled from the environment so they are never hard-coded.
    | Obtain them from https://www.google.com/recaptcha/admin
    | (choose "reCAPTCHA v2" -> "Invisible reCAPTCHA badge").
    |
    */

    'site_key'   => env('RECAPTCHA_SITE_KEY'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),

    /*
    | Google's server-side verification endpoint.
    */
    'verify_url' => env('RECAPTCHA_VERIFY_URL', 'https://www.google.com/recaptcha/api/siteverify'),

    /*
    | HTTP timeout (seconds) when contacting Google. Kept short so a slow
    | Google response never hangs a user's form submission indefinitely.
    */
    'timeout' => (int) env('RECAPTCHA_TIMEOUT', 5),

    /*
    | Master switch. When false, the RecaptchaService treats every request as
    | valid (verification is skipped). This lets local/testing environments
    | run without real keys and provides a safety valve for production.
    | Verification is also skipped automatically whenever the keys are empty.
    */
    'enabled' => filter_var(env('RECAPTCHA_ENABLED', true), FILTER_VALIDATE_BOOLEAN),

    /*
    | Optionally enforce that Google's reported hostname matches the request
    | host (mitigates token replay from another domain). Disable only if you
    | serve the same keys across multiple hostnames or sit behind a proxy that
    | rewrites the Host header. reCAPTCHA "Domain verification" must be ON in
    | the admin console for the returned hostname to be trustworthy.
    */
    'verify_hostname' => filter_var(env('RECAPTCHA_VERIFY_HOSTNAME', false), FILTER_VALIDATE_BOOLEAN),

    /*
    | Validation error message shown to the user when verification fails.
    */
    'error_message' => env('RECAPTCHA_ERROR_MESSAGE', 'Please confirm you are not a robot.'),

];
