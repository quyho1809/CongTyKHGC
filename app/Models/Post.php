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
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnails')->singleFile(); 
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::created(function ($post) {
            $post->slug = Str::slug($post->title) . '-' . $post->id;
            $post->save();  
        });
    }
    public function getRouteKeyName()
    {
        return 'slug'; 
    }
    
    public function getThumbnailAttribute()
    {
        
        return $this->attributes['thumbnail'] 
        ? asset('image/' . $this->attributes['thumbnail']) 
        : asset('image/hinh_1.jpg');
    }
    protected $attributes = [
        'description' => null,
        'publish_date' => null,
        'status' => 0
    ];
    
}
