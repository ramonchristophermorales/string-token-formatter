<?php namespace RamonChristopherMorales\StringTokenFormatter;

class STF {

    protected $formatIn;
    protected $formatOut;
    protected $tokenList;
    protected $input;
    protected $output;

    public function __construct() {

        $config = $this->config();

        if ($config) {
            list($this->formatIn, $this->formatOut) = $this->format($config['formatIn'], $config['formatOut']);
        }
    }

    /**
     *
     * @param $tokens
     * @return array|bool
     */
    public function tokens($tokens) {

        if  (is_string($tokens)) {
            $tokens = [$tokens];
        }

        $filteredTokenList = false;

        if (is_array($tokens) && count($tokens) > 0) {

            foreach ($tokens as $token) {
                var_dump($this->formatIn);
                var_dump($token);
                dd(preg_match($this->formatIn, $token));
                if (preg_match($this->formatIn, $token)) {
                    $filteredTokenList[] = $token;
                }
            }
        }

        return $filteredTokenList;
    }

    /**
     * @todo: compare the formatIn if it matches both strings, input identifier and input separator in formatOut output identifier and output separator
     */
    /**
     * tells the STF what format should the formatter follow and its format output
     * @format [identifier][string][separator][string]
     * @param $formatIn
     * @param null $formatOut
     * @return array|bool
     */
    public function format($formatIn, $formatOut=null) {

        if (!$formatIn) {
            return false;
        }

        if (preg_match("/[s]*/", $formatIn)) {

            $preg_match = "/[";

            $eFormat = explode('[s]', $formatIn);

            unset($eFormat[end($eFormat)]);

            foreach ($eFormat as $e) {
                if ($e != end($eFormat)) {
                    $preg_match .= "$e\s";
                }
            }

            $preg_match .= "]*/";

            $this->formatIn = $preg_match;
            $this->formatOut = $formatOut?$formatOut:$this->formatOut;

            return [$preg_match, $formatOut];
        }

        return false;
    }

    public function output() {

        ob_start();
        eval("?>".$this->output);
        return  ob_get_clean();
    }

    ################################################################################
    # private functions

    /**
     * get the config
     * @return bool|mixed
     */
    private function config() {

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
