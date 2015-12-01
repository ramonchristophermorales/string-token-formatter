<?php

use Monolog\TestCase;
use RamonChristopherMorales\StringTokenFormatter\Facades\STF;

class STFTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testConfig()
    {
        STF::shouldReceive('config')->once()->with('safsdfaf', 'sdafsdfs');

        $this->call('GET', '/');
    }
}