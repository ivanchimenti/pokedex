<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "pokedexpw2";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("error al conectar con la base de datos: " . mysqli_connect_error());
}

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar la actualización en la base de datos
    if(!empty($_POST["id_pokemon"]) && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["nombreArchivo"]) && !empty($_POST["nroPokedex"]) && !empty($_POST["tipo1"])){

        $id_pokemon = $_POST["id_pokemon"];
        $nombreNuevo = $_POST["nombre"];
        $descripcionNuevo = $_POST["descripcion"];
        $nroPokedexNuevo = $_POST["nroPokedex"];
        $tipo1Nuevo = $_POST["tipo1"];


        if($_FILES["file"]["name"]){
            $imagenNuevo = $_FILES["file"]["name"];
            if(!file_exists("/xampp/htdocs/Pokedex/assets/pkmnImages/" . $_FILES["file"]["name"]))
            {
                move_uploaded_file($_FILES["file"]["tmp_name"],"/xampp/htdocs/Pokedex/assets/pkmnImages/" . $_FILES["file"]["name"]);
                $ImagenNuevo = $_FILES["file"]["name"];
            }
            $sql_actualizarPokemon = "UPDATE pokemon SET Nombre = '$nombreNuevo', Imagen = '$imagenNuevo', Descripcion = '$descripcionNuevo', NroPokedex = '$nroPokedexNuevo' WHERE id = $id_pokemon";
            $resultUpdate = mysqli_query($conn, $sql_actualizarPokemon);
        }else{
            $sql_actualizarPokemon = "UPDATE pokemon SET Nombre = '$nombreNuevo', Descripcion = '$descripcionNuevo', NroPokedex = '$nroPokedexNuevo' WHERE id = $id_pokemon";
            $resultUpdate = mysqli_query($conn, $sql_actualizarPokemon);
        }

        $sql_borrarTiposAntiguos = "DELETE FROM pokemon_tipo WHERE IdPokemon = $id_pokemon";
        $resultDelete = mysqli_query($conn, $sql_borrarTiposAntiguos);

        if ($resultDelete === TRUE) {
            if($_POST["tipo2"]){
                $tipo2Nuevo = $_POST["tipo2"];
                $sql_actualizarTipos = "INSERT INTO pokemon_tipo (IdPokemon,IdTipo) VALUES ($id_pokemon,$tipo1Nuevo),($id_pokemon,$tipo2Nuevo)";
                $resultInsert = mysqli_query($conn, $sql_actualizarTipos);
                if ($resultInsert === TRUE) {
                    echo "Registro actualizado correctamente";
                } else {
                    echo "Error al actualizar el registro: " . $conn->error;
                }

            }else{
                $sql_actualizarTipos = "INSERT INTO pokemon_tipo (IdPokemon,IdTipo) VALUES ($id_pokemon,$tipo1Nuevo)";
                $resultInsert = mysqli_query($conn, $sql_actualizarTipos);
                if ($resultInsert === TRUE) {
                    echo "Registro actualizado correctamente";
                } else {
                    echo "Error al actualizar el registro: " . $conn->error;
                }
            }
        }
    }
    else{
        echo "hay campos que no fueron completados";
    }
}else{
    echo "ocurrio error inesperado con el post";
}
