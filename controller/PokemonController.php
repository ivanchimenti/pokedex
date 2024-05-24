<?php

class PokemonController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function get()
    {
        $pokemons = $this->model->getPokemons();
        include_once("view/pokemonsView.php");
    }

    public function Detalle(){

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $pokemon = $this->model->getPokemonById($id);
        $tipos = $this->model->getPokemonTiposByPokemonId($id);

        if($pokemon != null && $tipos != null)
            include_once("view/detallePokemonView.php");
        else
            include_once("view/pokemonsView.php");
    }
}