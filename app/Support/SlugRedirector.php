<?php

namespace App\Support;

use App\Models\SlugRedirect;

class SlugRedirector
{
    public static function redirectForPath(string $path)
    {
        $normalized = '/' . trim($path, '/');

        $redirect = SlugRedirect::query()
            ->where('old_path', $normalized)
            ->first();

        if (! $redirect) {
            return null;
        }

        return redirect($redirect->new_path, 301);
    }
}
