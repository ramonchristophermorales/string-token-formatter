<?php

use RamonChristopherMorales\StringTokenFormatter\STF;

class CommonTest extends PHPUnit_Framework_TestCase {

    public $stf;

    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);

        $this->setUpBeforeClass();
        $this->stf = new STF();
    }



    public function assertSTF($actual)
    {
        $this->assertInstanceOf('RamonChristopherMorales\StringTokenFormatter\STF', $actual);
    }

    public function testSTF() {
        $this->assertNotEmpty($this->stf);
    }

    public function testAttributeFormatIn() {
        $this->assertClassHasAttribute('formatIn', 'RamonChristopherMorales\StringTokenFormatter\STF');
    }

    public function testAttributeFormatOut() {
        $this->assertClassHasAttribute('formatOut', 'RamonChristopherMorales\StringTokenFormatter\STF');
    }

    public function testAttributeStrReplaceIn() {
        $this->assertClassHasAttribute('strReplaceIn', 'RamonChristopherMorales\StringTokenFormatter\STF');
    }

    public function testAttributeStrReplaceOut() {
        $this->assertClassHasAttribute('strReplaceOut', 'RamonChristopherMorales\StringTokenFormatter\STF');
    }

    public function testAttributeTokenList() {
        $this->assertClassHasAttribute('tokenList', 'RamonChristopherMorales\StringTokenFormatter\STF');
    }


    /************************************************************************************
     *
     * DATA PROVIDERS
     *
     */

    public function setConfigProvider() {

        return [
            'any random string' => ['any', 'any'],
            'null' => ['','']
        ];
    }

    public function formatProvider() {

        return [
            'default format' => ['@[s]_[s]', '$[s]->[s]'],
        ];
    }

    public function tokensListProvider() {

        return [
            'string1' => ['sometoken'],
//            'string with spaces' => [' @stringwith_spaces ','',''],
//            'array' => ['@first_token', '@second_token', '@third_token']
        ];
    }
}