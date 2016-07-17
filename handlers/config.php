<?php
class Config {
  private static $configDetails=null;
  private static $ENV='SITE';

  private static function loadConfig() {
    if ($configDetails != null) return true;
    $filepath = getenv($ENV);
    $configDetails = parse_ini_file($filepath);
    return !($configDetails == false);
  }

  private static function getMySQL() {
    if ($configDetails == null) {
      if (!loadConfig()) return null;
    }

    return $configDetails('mysql');
  }
}
?>
