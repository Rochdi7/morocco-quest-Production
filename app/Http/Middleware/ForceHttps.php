<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        if (! app()->environment('production')) {
            return $next($request);
        }

        $canonicalHost = parse_url(config('app.url', 'https://morocco-quest.com'), PHP_URL_HOST) ?: 'morocco-quest.com';
        $path = '/' . ltrim($request->path(), '/');
        $path = $path === '/.' ? '/' : $path;

        if ($path !== '/' && str_ends_with($path, '/')) {
            $path = rtrim($path, '/');
        }

        $target = 'https://' . $canonicalHost . $path;

        if ($request->getQueryString()) {
            $target .= '?' . $request->getQueryString();
        }

        $currentPath = '/' . ltrim($request->path(), '/');
        if ($currentPath !== '/' && str_ends_with($currentPath, '/')) {
            $currentPath = rtrim($currentPath, '/');
        }

        if (! $request->isSecure() || $request->getHost() !== $canonicalHost || $currentPath !== $path) {
            return redirect()->away($target, 301);
        }

        return $next($request);
    }
}
