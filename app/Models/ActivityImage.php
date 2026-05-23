<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\MediaUrl;

class ActivityImage extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id', 'image', 'caption', 'alt', 'description'];

    public function activity()
    {
        return $this->belongsTo(\App\Models\Activity::class);
    }

    public function getImageUrlAttribute(): string
    {
        return MediaUrl::resolve($this->image);
    }
}
