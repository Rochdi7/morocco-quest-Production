<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Force HTTPS (only active when APP_ENV=production)
        $middleware->append(\App\Http\Middleware\ForceHttps::class);

        // Existing HTML minifier
        // $middleware->append(\App\Http\Middleware\HtmlMinifier::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();

