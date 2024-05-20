<?php

class PokemonModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getPokemons()
    {
       return $this->database->query("SELECT * FROM pokemon");
    }

    public function getPokemonById($id)
    {
        return $this->database->query("SELECT * FROM pokemon WHERE Id = $id");
    }

    public function getPokemonTiposByPokemonId($id)
    {
        return $this->database->query("SELECT * FROM pokemon_tipo WHERE IdPokemon = $id");
    }
}