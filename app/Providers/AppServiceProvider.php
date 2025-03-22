<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify; 
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use App\Actions\Fortify\ResetUserPassword;
use App\Jobs\SendResetPasswordEmail;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ResetsUserPasswords::class, ResetUserPassword::class);

    }

    public function boot(): void
    {
        app()->bind(SendResetPasswordEmail::class);
    }
    protected $policies = [
        Post::class => PostPolicy::class,
    ];
   
    
}
