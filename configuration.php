<?php
include_once ("db.php");
class Configuration
{
    public static function getDatabase()
    {
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["password"], $config["database"]);
    }

    private static function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }
}
?>