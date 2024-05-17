<?php
session_start();
include_once ("configuration.php");

$database = Configuration::getDatabase();

include("view/header.php");
?>
<?php
$path = $_GET['path'];

switch($path){
    case "pokemons":
        $pokemons = $database->query("SELECT * FROM pokemon");
        include_once("view/pokemonsView.php");
        break;
    default:
        $pokemons = $database->query("SELECT * FROM pokemon");
        include_once("view/pokemonsView.php");
        break;
}
?>


</body>
</html>