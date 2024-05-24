<?php
include_once("helper/db.php");
//MODELOS
include_once ("model/PokemonModel.php");
//VISTAS
include_once ("controller/PokemonController.php");
include_once ("model/AdminModel.php");
//VISTAS
include_once ("controller/AdminController.php");

include_once ("helper/Router.php");

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

    public static function getPokemonController()
    {
        return new PokemonController(self::getPokemonModel());
    }

    public static function getAdminController()
    {
        return new AdminController(self::getAdminModel());
    }

    private static function getPokemonModel()
    {
        return new PokemonModel(self::getDatabase());
    }

    private static function getAdminModel()
    {
        return new AdminModel(self::getDatabase());
    }

    public static function getRouter()
    {
        return new Router("getPokemonController", "get");
    }

}
?>