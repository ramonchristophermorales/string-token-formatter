<?php namespace RamonChristopherMorales\StringTokenFormatter;

use Illuminate\Support\Facades\Facade;

class StringTokenFormatterFacades extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'stringTokenFormatter'; }

}
