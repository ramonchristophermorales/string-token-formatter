<?php

class STFTest extends ConfigTest {

    /**
     * @param $formatIn
     * @param $formatOut
     * @dataProvider formatProvider
     */
    public function testFormat($formatIn, $formatOut) {

        $this->assertEmpty($this->stf->format('', ''));
        $this->assertNotEmpty($this->stf->format($formatIn, $formatOut));
    }

    /**
     * @throws Exception
     */
    public function testFormatWithConfig() {

        $config = $this->stf->getConfig();
        $this->assertNotEmpty($this->stf->format($config['formatIn'], $config['formatOut']));
    }

    /**
     * @dataProvider tokensListProvider
     */
    public function testTokensList($token1) {
//
//        $this->assertNull($this->stf->tokensList(''));
//        $this->assertNull($this->stf->tokensList([]));
//        $this->assertNotEmpty($this->stf->tokensList([$token1, $token2, $token3]));
    }

    public function testSTFNullEntry() {

        $this->assertEmpty($this->stf->STF(''));
    }

    public function testSTFFail() {

        $this->stf->tokensList('@some_thing');
        $this->assertFalse(strpos($this->stf->STF('this is a sample @some_thing to be test'), '@some_thing'));
    }

}