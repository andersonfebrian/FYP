<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
	protected $adminNamespace = 'App\\Http\\Controllers\\Admin';
	protected $browserNamespace = 'App\\Http\\Controllers\\Browser';
	/**
	 * The path to the "home" route for your application.
	 *
	 * This is used by Laravel authentication to redirect users after login.
	 *
	 * @var string
	 */
	public const HOME = '/';

	/**
	 * The controller namespace for the application.
	 *
	 * When present, controller route declarations will automatically be prefixed with this namespace.
	 *
	 * @var string|null
	 */
	// protected $namespace = 'App\\Http\\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();
		$this->configureRateLimiting();
		$this->mapAdminRoute();
		$this->mapBrowserRoute();
	}

	protected function mapBrowserRoute()
	{
		Route::domain(env('APP_URL'))
			->name('browser.')
			->namespace($this->browserNamespace)
			->middleware('web')
			->group(base_path('routes/browser/web.php'));
		
		Route::domain(env('APP_URL'))->prefix('api')->name('browser.api.')->namespace($this->browserNamespace)->middleware('api')->group(base_path('routes/browser/api.php'));
	}

	protected function mapAdminRoute()
	{
		Route::domain('admin.' . env('APP_URL'))
			->name('admin.')
			->namespace($this->adminNamespace)
			->middleware('web')
			->group(base_path('routes/admin/web.php'));
	}

	/**
	 * Configure the rate limiters for the application.
	 *
	 * @return void
	 */
	protected function configureRateLimiting()
	{
		RateLimiter::for('api', function (Request $request) {
			return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
		});
	}
}
