<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Semrush API Configuration
    |--------------------------------------------------------------------------
    |
    | The token is pulled from the environment so it is never hard-coded or
    | committed. Create one at:
    |   Semrush -> My profile -> API Keys -> Create API key
    |
    | NOTE ON VERSIONS: tokens prefixed "semrtkn-pat-" are v4 Personal Access
    | Tokens and authenticate via an "Authorization: Bearer <token>" header.
    | The older v3 endpoints (api.semrush.com/?type=...&key=...) expect a
    | legacy 32-char hex key and will reject a v4 PAT with:
    |     ERROR 122 :: WRONG FORMAT OR EMPTY KEY
    |
    */

    'token' => env('SEMRUSH_API_TOKEN'),

    /*
    | Base host for the API gateway.
    */
    'base_url' => env('SEMRUSH_BASE_URL', 'https://api.semrush.com'),

    /*
    | Database (regional index) to query. Semrush uses two-letter codes such as
    | us, uk, fr, es, ma. Morocco Quest targets a mixed EN/FR audience, so this
    | is set per-call in practice; this is only the default.
    */
    'database' => env('SEMRUSH_DATABASE', 'us'),

    /*
    | HTTP timeout (seconds) for API calls. Keyword reports can be slow, so
    | this is more generous than a user-facing request would warrant. These
    | calls are expected to run from CLI/queue contexts, not web requests.
    */
    'timeout' => (int) env('SEMRUSH_TIMEOUT', 30),

    /*
    | Master switch. When false (or the token is empty) the service short
    | circuits instead of making network calls, so local environments without
    | a token behave predictably.
    */
    'enabled' => filter_var(env('SEMRUSH_ENABLED', true), FILTER_VALIDATE_BOOLEAN),

];
