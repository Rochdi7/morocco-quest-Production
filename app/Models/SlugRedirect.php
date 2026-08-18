<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SlugRedirect extends Model
{
    protected $fillable = [
        'old_path',
        'new_path',
        'redirectable_type',
        'redirectable_id',
    ];

    public function redirectable(): MorphTo
    {
        return $this->morphTo();
    }
}
