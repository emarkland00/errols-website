<?php
class Config
{
  private static $configDetails=null;
  private static $ENV='SITE';

  private static function loadConfig() {
    if (Config::$configDetails != null) return true;
    $filepath = getenv(Config::$ENV);
    Config::$configDetails = parse_ini_file($filepath, true);
    return !(Config::$configDetails == false);
  }

  public static function getMySQL() {
    if (Config::$configDetails == null) {
      if (!Config::loadConfig()) return null;
    }

    return Config::$configDetails['mysql'];
  }
}
?>
