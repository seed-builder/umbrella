<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        Route::pattern('id', '[0-9]+');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapMobileRoutes();

        $this->mapWechatRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
//        Route::middleware('web')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/web.php'));
	    Route::group([
		    'middleware' => 'web',
		    'namespace' => $this->namespace . '\Web',
	    ], function ($router) {
		    //require base_path('routes/web/web.php');
		    load_routes(base_path('routes/web/'));
	    });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
//        Route::prefix('api')
//             ->middleware('api')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/api.php'));
	    Route::group([
		    'middleware' => 'api',
		    'namespace' => $this->namespace . '\Api',
		    'prefix' => 'api',
	    ], function ($router) {
		    //require base_path('routes/api/api.php');
		    load_routes(base_path('routes/api/'));
	    });
    }

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapAdminRoutes()
	{
//		Route::prefix('admin')
//			->middleware('admin')
//			->namespace($this->namespace . '\admin')
//			->group(base_path('routes/api.php'));

		Route::group([
			'middleware' => 'admin',
			'namespace' => $this->namespace . '\Admin',
			'prefix' => 'admin',
//            'domain' => env('ADMIN_DOMAIN','127.0.0.1')
		], function ($router) {
			//require base_path('routes/admin/admin.php');
			load_routes(base_path('routes/admin/'));
		});
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapMobileRoutes()
	{
//		Route::prefix('admin')
//			->middleware('admin')
//			->namespace($this->namespace . '\admin')
//			->group(base_path('routes/api.php'));

		Route::group([
			'middleware' => 'mobile',
			'namespace' => $this->namespace . '\Mobile',
			'prefix' => 'mobile',
//            'domain' => env('MOBILE_DOMAIN','localhost')
		], function ($router) {
			//require base_path('routes/admin/admin.php');
			load_routes(base_path('routes/mobile/'));
		});
	}

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapWechatRoutes()
    {
        Route::group([
//            'middleware' => 'mobile',
            'namespace' => $this->namespace . '\Wechat',
            'prefix' => 'wechat',
//            'domain' => env('MOBILE_DOMAIN','localhost')
        ], function ($router) {
            //require base_path('routes/admin/admin.php');
            load_routes(base_path('routes/wechat/'));
        });
    }


}
