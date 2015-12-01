<?php namespace RamonChristopherMorales\StringTokenFormatter\Providers;

use Illuminate\Support\ServiceProvider;

class STFServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config.php' => config_path('STF.php'),
		], 'config');

		$this->publishes([
			__DIR__.'/../../tests/STFTest.php' => base_path('tests/STFTest.php'),
		], 'tests');

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('STF', function()
		{
			return new \RamonChristopherMorales\StringTokenFormatter\STF();
		});
	}

}
