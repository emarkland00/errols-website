<?php
class Config
{
    private static $DETAILS=null;
    private static $ENV='SITE';

    private static function loadConfig() {
        if (Config::$DETAILS != null) return true;
        $filepath = getenv(Config::$ENV);
        $raw_contents = file_get_contents($filepath);
        Config::$DETAILS = json_decode($raw_contents, true);
        return !(Config::$DETAILS == false);
    }

    private static function loadDetails($section) {
        Config::loadConfig();
        if (!Config::$DETAILS) return null;
        return Config::$DETAILS[$section];
    }

    public static function getMySQL() {
        return Config::loadDetails('mysql');
    }

    public static function getPocket() {
        return Config::loadDetails('pocket');
    }
}
?>
