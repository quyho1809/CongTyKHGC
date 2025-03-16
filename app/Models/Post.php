<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,SoftDeletes;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'content', 'publish_date', 'status'];
    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    
    public function getThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('thumbnails') ?: asset('default-thumbnail.jpg');
    }
    protected $attributes = [
        'description' => null,
        'publish_date' => null,
        'status' => 0
    ];
    
}
