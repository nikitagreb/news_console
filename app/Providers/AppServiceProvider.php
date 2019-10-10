<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\{Facades\Validator, ServiceProvider};
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            app('config')->set('app.aliases', [
                'Validator' => Validator::class,
                'Eloquent'=> Model::class,
            ]);
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
