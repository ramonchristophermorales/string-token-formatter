<?php namespace RamonChristopherMorales\StringTokenFormatter;

class STF {

	public static function test() {
		dd(STF::config());
	}

    private static function config() {

        $config = false;

        if (function_exists('config')) {
            $config =  config('STF');
        }

        if (!$config) {
            if (file_exists(__DIR__.'/config.php')) {
                $config = require_once __DIR__.'/config.php';

            }
        }

        return $config;
    }

}
