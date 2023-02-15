<?php

namespace MikhailMouner\GenerateFilter;

use Illuminate\Support\ServiceProvider;
use MikhailMouner\GenerateFilter\Console\Commands\CreateFilterModel;
use MikhailMouner\GenerateFilter\Console\Commands\CreateFilterPipeline;

class FilterProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $appPath = __DIR__ . '/../stubs/';

        $this->publishes([
            $appPath => app_path('stubs/'),
        ], 'filter-stubs');

        $this->commands([
            CreateFilterPipeline::class,
            CreateFilterModel::class
        ]);
    }
}
