<?php

class Config extends CommonTest {

    
    /**
     * test the config file if exists
     *
     * @param array $stack
     * @return mixed|null
     * @throws Exception
     */
    public function testConfig() {

        $config = $this->stf->getConfig();
        $this->assertNotEmpty($config);

        return $config;
    }

    /**
     * @depends testConfig
     * @param array $config
     * @return array
     */
    public function testConfigType(array $config) {

        $this->assertTrue(is_array($config));

        return $config;
    }

    /**
     * @depends testConfigType
     * @param array $config
     */
    public function testConfigFormatIn(array $config) {

        $this->assertArrayHasKey('formatIn', $config);

        if (isset($config['formatIn'])) {
            $this->assertNotEmpty($config['formatIn']);
        }
    }

    /**
     * @depends testConfigType
     * @param array $config
     */
    public function testConfigFormatOut(array $config) {

        $this->assertArrayHasKey('formatOut', $config);

        if (isset($config['formatOut'])) {
            $this->assertNotEmpty($config['formatOut']);
        }
    }


    /**
     * @dataProvider setConfigProvider
     */
    public function testSetConfig($a, $expected) {
        $this->assertEquals($expected, $this->stf->setConfig($a));
    }


}