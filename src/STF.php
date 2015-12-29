<?php namespace RamonChristopherMorales\StringTokenFormatter;

/**
 * converts tokens inside a string into displayable php variable
 * working on php objects
 *
 * Class STF
 * @package RamonChristopherMorales\StringTokenFormatter
 */
class STF {

    /**
     * regex coming in holder
     * @var
     */
    protected $formatIn;
    /**
     * regex coming out holder
     * @var
     */
    protected $formatOut;

    /**
     * replaced string/php modifiers going in holder
     * @var
     */
    protected $strReplaceIn;

    /**
     * replaced string/php modifiers going out holder
     * @var
     */
    protected $strReplaceOut;

    /**
     * token list holder
     * @var
     */
    protected $tokenList;

    /**
     * config path holder
     * @var
     */
    protected $configPath;

    public function __construct() {

        $config = $this->getConfig();

        if ($config) {
            list($this->formatIn, $this->formatOut) = $this->format($config['formatIn'], $config['formatOut']);
        }
    }

    /**
     * set the list of token
     *
     * @param $tokens
     * @return array|bool
     */
    public function tokensList($tokens) {

        if(!$tokens) {
            return null;
        }

        if (is_string($tokens)) {
            $tokens = [$tokens];
        }

        $filteredTokenList = null;

        if (is_array($tokens) && count($tokens) > 0) {
            foreach ($tokens as $token) {
                if (preg_match($this->formatIn, $token)) {
                    $this->tokenList[] = $token;
                }
            }
        }

        return true;
    }

    /**
     * tells the STF what format should the formatter follow and its format output
     *
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

            $preg_match_in = "/^[";
            $preg_match_out = "";

            foreach ($eFormatIn as $key => $e) {
                if ($e != end($eFormatIn)) {
                    $preg_match_in .= "$e"."A-z";
                    $this->strReplaceIn[] = $e;

                    $preg_match_out .= "".$eFormatOut[$key]."[A-z]";
                    $this->strReplaceOut[] = $eFormatOut[$key];
                }
            }

            $preg_match_in .= "]+$/i";
            $preg_match_out .= "";

            $this->formatIn = $preg_match_in;
            $this->formatOut = $preg_match_out;

            return [$preg_match_in, $preg_match_out];
        }

        return false;
    }

    /**
     * process the string and converts any tokens that matches into php variable output
     *
     * @param null $string
     * @return mixed|null
     */
    public function STF($string=null) {

        if (!$this->formatIn || !$this->formatOut) {
            return $string;
        }

        if (count($this->tokenList) < 1) {
            return $string;
        }

        preg_match_all("/[@][A-Za-z-_]*/", $string, $tokens);
        preg_match_all("/[@][A-Za-z-_]*/", $string, $tokens);

        if (count($tokens[0]) < 1) {
            return $string;
        }

        $formattedTokenList = [];
        $convertedTokenList = [];
        $newTokenList = [];

        foreach ($tokens[0] as $token) {

            if (!in_array($token, $this->tokenList)) {
                continue;
            }

            $newTokenList[] = $token;

            $convertedTokenList[] = str_replace($this->strReplaceIn, $this->strReplaceOut, $token);
        }

        foreach ($convertedTokenList as $token) {
            $formattedTokenList[] = "<?php echo $token; ?>";
        }

        $return = str_replace($newTokenList, $formattedTokenList, $string);

        return $return;
    }


    /************************************************************************************
     *
     * GETTERS
     *
     */

    /**
     * returns all the valid tokens
     *
     * @return mixed
     */
    public function getTokens() {
        return $this->tokenList;
    }

    /**
     * return the regex used against tokens coming in
     *
     * @return string
     */
    public function getFormatIn() {
        return $this->formatIn;
    }

    /**
     * return the regex used against tokens coming in
     *
     * @return string
     */
    public function getFormatOut() {
        return $this->formatOut;
    }

    /**
     * returns the replaced string/php modifiers before the string
     * from tokens coming in
     *
     * @return array
     */
    public function getStrReplaceIn() {
        return $this->strReplaceIn;
    }

    /**
     * returns the replaced string/php modifiers before the string
     * from tokens coming in
     *
     * @return array
     */
    public function getStrReplaceOut() {
        return $this->strReplaceOut;
    }

    /**
     * returns configuration array from the config file
     *
     * @param null $configPath
     * @return mixed|null
     * @throws \Exception
     */
    public function getConfig() {

        $config = null;
        $exceptionMessage = "Missing STF configuration file";

        if ($this->configPath) {
            if (file_exists(__DIR__.'/config.php')) {
                $config = require __DIR__.'/config.php';
            } else {
                throw new \Exception($exceptionMessage);
            }

            return $config;
        }

        /**
         * for laravel only
         */
        if (function_exists('config')) {
            $config =  config('STF');
        }

        if (!$config) {
            if (file_exists(__DIR__.'/config.php')) {
                $config = require __DIR__.'/config.php';
            }
        }

        if (!$config) {
            throw new \Exception($exceptionMessage);
        }

        return $config;
    }


    /************************************************************************************
     *
     * SETTERS
     *
     */

    /**
     * set the config path
     *
     * @param $configPath
     * @return mixed
     */
    public function setConfigPath($configPath) {
        return $this->configPath = $configPath;
    }
}
