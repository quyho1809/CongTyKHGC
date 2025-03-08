<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
       'first_name',
        'last_name', 
        'email', 
        'password', 
        'address', 
        'status', 
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getnameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
   
}