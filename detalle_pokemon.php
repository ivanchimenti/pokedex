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
if (isset($_GET['busqueda'])) {
    // Obtener el valor de "busqueda" y mostrarlo
    $busqueda = $_GET['busqueda'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pokedexpw2";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        die("error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $sqlQuery = "SELECT p.*, t.Id AS IdTipo
FROM pokemon p
JOIN pokemon_tipo pt ON p.Id = pt.IdPokemon
JOIN tipo t ON pt.IdTipo = t.Id
WHERE p.Nombre LIKE '$busqueda';";
    $result = mysqli_query($conn,$sqlQuery);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='container detalle'>";
            echo "<img src='assets/pkmnImages/" . $row["Imagen"] . "' alt='' style='width:200px; height:200px'>";
            echo "<div class='informacion'>";
            echo "<div>";
            echo "<img src='assets/images/tipos/" . $row["IdTipo"] . ".png" . "' alt='' style='width:100px; height:20px'>";
            echo "<h2> |". $row["Nombre"] ."</h2>";
            echo "</div>";
            echo "<p>Descripcion:". $row["Descripcion"] ."</p><br>";
            echo "<p>Nro. Pokedex:". $row["NroPokedex"] ."</p><br>";
            echo "</div>";
            echo "</div>";
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