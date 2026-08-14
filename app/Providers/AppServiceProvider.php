<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Hash::extend('md5', function () {
            return new class {
                public function make($value, array $options = []) {
                    return md5($value);
                }
                public function check($value, $hashedValue, array $options = []) {
                    return md5($value) === $hashedValue;
                }
                public function needsRehash($hashedValue, array $options = []) {
                    return false;
                }
            };
        });
    }
}
