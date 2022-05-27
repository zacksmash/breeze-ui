<?php

namespace Zacksmash\BreezeUI;

use Illuminate\Support\ServiceProvider;
use Zacksmash\BreezeUI\Commands\BreezeUICommand;

class BreezeUIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../stubs/resources/css' => base_path('resources/css'),
                __DIR__ . '/../stubs/resources/js' => base_path('resources/js'),
                __DIR__ . '/../stubs/resources/views' => base_path('resources/views'),
                __DIR__ . '/../stubs/package.json' => base_path('package.json'),
                __DIR__ . '/../stubs/webpack.mix.js' => base_path('webpack.mix.js')
            ], 'breeze-ui-resources');

            $this->commands([
                BreezeUICommand::class,
            ]);
        }
    }
}
