<?php

namespace Zacksmash\BreezeUI\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BreezeUICommand extends Command
{
    public $signature = 'breeze:ui';

    public $description = 'Install UI preset, with views';

    public function handle()
    {
        Artisan::call('breeze:install');

        $this->publishAssets();
        $this->updateWebpackUrl();

        $this->info('UI scaffolding installed successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    protected function publishAssets()
    {
        File::delete(base_path('tailwind.config.js'));
        File::deleteDirectory(resource_path('css'));
        File::deleteDirectory(resource_path('js'));
        File::deleteDirectory(resource_path('views/auth'));
        File::deleteDirectory(resource_path('views/components'));
        File::deleteDirectory(resource_path('views/layouts'));

        $this->callSilent('vendor:publish', ['--tag' => 'breeze-ui-resources', '--force' => true]);
    }

    protected function updateWebpackUrl()
    {
        File::put(
            base_path('webpack.mix.js'),
            str_replace(
                'http://CHANGE_ME.test',
                env('APP_URL'),
                File::get(base_path('webpack.mix.js'))
            )
        );
    }
}
