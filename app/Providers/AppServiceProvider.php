<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $setting = Setting::first() ?? new Setting([
                    'app_name' => 'NiceAdmin Laravel',
                    'copyright' => 'Tamus Tahir | 2026',
                    'login_title' => 'Halaman Login',
                    'keywords' => 'admin, dashboard, laravel',
                    'description' => 'NiceAdmin template',
                ]);
            } catch (\Exception $e) {
                $setting = new Setting([
                    'app_name' => 'NiceAdmin Laravel',
                    'copyright' => 'Tamus Tahir | 2026',
                    'login_title' => 'Halaman Login',
                    'keywords' => 'admin, dashboard, laravel',
                    'description' => 'NiceAdmin template',
                ]);
            }
            $view->with('setting', $setting);
        });
    }
}
