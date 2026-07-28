<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**

     * Bootstrap any application services.

     *

     * @return void

     */

    public function boot()
    {

    }



    /**

     * Register any application services.

     *

     * @return void

     */

    public function register()
    {
        // Hosting sin carpeta main/public: el document root es el padre de main/.
        if (!is_dir(base_path('public'))) {
            $this->app->bind('path.public', function () {
                return realpath(base_path('..')) ?: base_path();
            });
        }
    }



}
