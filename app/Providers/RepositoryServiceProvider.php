<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'Article', 'Category', 'Tag', 'Admin'
        ];

        /**
         * Bind interface to implements class
         */
        foreach ($models as $model) {
            $this->app->bind(
                "App\\Contracts\\Repositories\\{$model}Repository",
                "App\\Repositories\\Eloquent\\{$model}Repository"
            );
        }
    }
}
