<?php
class Config
{
    private static $DETAILS=null;
    private static $ENV='SITE';

    private static function loadConfig() {
        if (Config::$DETAILS != null) return true;
        $filepath = getenv(Config::$ENV);
        Config::$DETAILS = parse_ini_file($filepath, true);
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
