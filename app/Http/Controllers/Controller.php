<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * A query-string value as a trimmed string, or null.
     *
     * Public GET filters/search terms are typed by visitors (and bots), so
     * ?place[]=x arrives as an array and used to throw a 500 wherever the
     * value was concatenated or passed to a string-only query.
     */
    protected function stringInput(Request $request, string $key, int $maxLength = 100): ?string
    {
        $value = $request->input($key);

        if (! is_string($value)) {
            return null;
        }

        $value = trim(mb_substr($value, 0, $maxLength));

        return $value === '' ? null : $value;
    }
}
