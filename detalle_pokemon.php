<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex-Detalle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/detalle.css">
</head>
<body>
<?php
include_once "header.php";

if (isset($_GET['id'])) {
    // Obtener el valor de "id" y mostrarlo
    $id = $_GET['id'];

    $config_path = $_SERVER['DOCUMENT_ROOT'] . '/pokedex/config.ini';
    $config = parse_ini_file($config_path);
    $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['database']);

    if(!$conn){
        die("error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $sqlQueryPokemon = "SELECT * FROM pokemon WHERE Id = $id";
    $result = mysqli_query($conn,$sqlQueryPokemon);
    if(mysqli_num_rows($result) > 0){
        $sqlQueryTipos = "SELECT * FROM pokemon_tipo WHERE IdPokemon = $id";
        $resultTipos = mysqli_query($conn,$sqlQueryTipos);
        if(mysqli_num_rows($resultTipos) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='container detalle'>";
                echo "<img src='assets/pkmnImages/" . $row["Id"] . ".gif" . "' alt='' style='width:200px; height:200px'>";
                echo "<div class='informacion'>";
                echo "<div class='d-flex'>";
                echo "<div class='d-flex flex-column'>";
                while($row2 = mysqli_fetch_assoc($resultTipos)){
                    echo "<img src='assets/images/tipos/" . $row2["IdTipo"] . ".png" . "' alt='' style='width:100px; height:20px'>";
                }
                echo "</div>";
                echo "<h2> |". $row["Nombre"] ."</h2>";
                echo "</div>";
                echo "<p>Descripcion:". $row["Descripcion"] ."</p><br>";
                echo "<p>Nro. Pokedex:". $row["NroPokedex"] ."</p><br>";
                echo "</div>";
                echo "</div>";
            }
        }
    }else{
        echo "no se encontraron resultados";
    }
    // Aquí puedes realizar la búsqueda en tu base de datos y mostrar los detalles
} else {
    // Si no se recibió el parámetro, mostrar un mensaje de error
    echo "<h1>Error: No se recibió ningún término de búsqueda</h1>";
}
?>
</body>
</html>