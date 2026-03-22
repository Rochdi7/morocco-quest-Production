<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'quote',
        'quote_author',
        'written_by',         
        'featured_image',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
