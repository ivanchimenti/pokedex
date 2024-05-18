<?php

class PokemonController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function listPokemons()
    {
        $pokemons = $this->model->getPokemons();
        include_once("view/pokemonsView.php");
    }

    public function Detalle($id){
        $pokemon = $this->model->getPokemonById($id);
        $tipos = $this->model->getPokemonTiposByPokemonId($id);
        include_once("detalle_pokemon.php");
    }
}