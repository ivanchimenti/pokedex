<?php
include_once ("db.php");
//MODELOS
include_once ("PokemonModel.php");
//VISTAS
include_once ("PokemonController.php");

include_once ("Router.php");

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

    private static function getPokemonModel()
    {
        return new PokemonModel(self::getDatabase());
    }

    public static function getRouter()
    {
        return new Router("getPokemonController", "listPokemons");
    }

}
?>