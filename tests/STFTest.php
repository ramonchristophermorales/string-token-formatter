<?php use RamonChristopherMorales\StringTokenFormatter\STF;

class STFTest extends PHPUnit_Framework_TestCase
{

    protected $stf;

    public function __construct() {
        parent::__construct();

        $this->stf = new STF();
    }

    public function testConfig()
    {
        $this->assertTrue($this->stf->getConfig()?true:false);
    }

    public function test
}