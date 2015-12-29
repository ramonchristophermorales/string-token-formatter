<?php

class GetTest extends CommonTest {

    public function testGetTokens() {
        $this->assertNull($this->stf->getTokens());
    }

    public function testGetFormatIn() {
        $this->assertNotEmpty($this->stf->getFormatIn());
    }

    public function testGetFormatOut() {
        $this->assertNotEmpty($this->stf->getFormatOut());
    }

    public function testGetStrReplaceIn() {
        $this->assertNotEmpty($this->stf->getStrReplaceIn());
    }

    public function testGetStrReplaceOut() {
        $this->assertNotEmpty($this->stf->getStrReplaceOut());
    }

}