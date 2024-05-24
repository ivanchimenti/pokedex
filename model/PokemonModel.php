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
        $result = $this->database->query("SELECT * FROM pokemon WHERE Id = $id");

        if (!$result) {
            die("Error en la consulta de pokemon" . $this->database->error);
        }

        if(count($result) === 1)
            return $result[0];
        else
            return null;
    }

    public function getPokemonTiposByPokemonId($id)
    {
        $pokemon = $this->getPokemonById($id);

        if($pokemon != null){
            $result = $this->database->query("SELECT * FROM pokemon_tipo WHERE IdPokemon = $id");

            if (!$result) {
                die("Error en la consulta de detalle pokemon");
            }

            if (!empty($result)) {
                return $result;
            }
        }
        return null;
    }
}