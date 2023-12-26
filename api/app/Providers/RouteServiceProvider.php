<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The prefix namespace for api controllers.
     *
     * @var string
     */
    protected $apiNamespace ='App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            $api_latest_version = config('app.api_latest_version');

            // Latest API Version
            Route::prefix('api/latest')
                ->middleware(['api', "api.version:v{$api_latest_version}"])
                ->namespace("{$this->apiNamespace}\V{$api_latest_version}")
                ->group(base_path("routes/api_v{$api_latest_version}.php"));

            // API Version 1
            Route::prefix('api/v1')
                ->middleware(['api', 'api.version:v1'])
                ->namespace("{$this->apiNamespace}\V1")
                ->group(base_path('routes/api_v1.php'));

            /*
             * Default API routes without api version prefix
             *  which it will work base on latest api version.
             */
            Route::prefix('api')
                ->middleware(['api', "api.version:v{$api_latest_version}"])
                ->group(base_path("routes/api_v{$api_latest_version}.php"));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
