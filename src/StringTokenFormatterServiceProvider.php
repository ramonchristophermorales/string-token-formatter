<?php namespace RamonChristopherMorales\StringTokenFormatter;

use Illuminate\Support\ServiceProvider;

class StringTokenFormatterServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/config.php' => config_path('stringTokenFormatter.php'),
		], 'config');

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('stringTokenFormatter', function()
		{
//			return new Ramon;
		});
	}

}
