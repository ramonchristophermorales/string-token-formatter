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
     * @todo: test the token or list of token if the format is working
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
     * tells the STF what format should the formatter follow and its format output
     * @format [identifier][string][separator][string]
     * @param $formatIn
     * @param null $formatOut
     * @return array|bool
     */
    public function format($formatIn, $formatOut) {

        if (!$formatIn || !$formatOut) {
            return false;
        }

        if (preg_match("/[s]*/", $formatIn)) {

            $eFormatIn = explode('[s]', $formatIn);
            $eFormatOut = explode('[s]', $formatOut);

            unset($eFormatIn[end($eFormatIn)]);
            unset($eFormatOut[end($eFormatOut)]);

            if (count($eFormatIn) != count($eFormatOut)) {
                return false;
            }

            $preg_match_in = "/[";
            $preg_match_out = "";

            foreach ($eFormatIn as $key => $e) {
                if ($e != end($eFormatIn)) {
                    $preg_match_in .= "$e\s";
                    $preg_match_out .= $eFormatOut[$key]."\s";
                }
            }

            $preg_match_in .= "]*/";
            $preg_match_out .= "";

            $this->formatIn = $preg_match_in;
            $this->formatOut = $preg_match_out;

            return [$preg_match_in, $preg_match_out];
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
