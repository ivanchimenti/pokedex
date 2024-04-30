<?php

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

    echo "conexion exitosa";

    $sqlQuery = "SELECT * FROM pokemon WHERE Nombre LIKE '$busqueda'";
    $result = mysqli_query($conn,$sqlQuery);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<p>Nombre:". $row["Nombre"] ."</p><br>";
            echo "<img src='assets/pkmnImages/" . $row["Imagen"] . "' alt='' style='width:200px; height:200px'><br>";
            echo "<p>Descripcion:". $row["Descripcion"] ."</p><br>";
            echo "<p>Nro. Pokedex:". $row["NroPokedex"] ."</p><br>";
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