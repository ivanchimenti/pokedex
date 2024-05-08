<?php
include("../db.php");

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: /pokedex/index.php");
    exit();
}


$sql = "SELECT * FROM pokemon";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) <= 0) {
    echo "No se encontraron resultados";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokedex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <?php
include("../header.php");


if(isset($_GET['error'])) {
    $error = $_GET['error'];

    echo "<div class='alert alert-danger' role='alert'>$error</div>";

}

?>

    <div class="container d-flex">
        <?php
    if(mysqli_num_rows($result) > 0) {
        echo "<table class='table table-striped table-bordered'>";
        echo "<thead>";
        echo "<tr><th scope='col'>Nro. Pokedex</th><th scope='col'>Nombre</th><th scope='col'>Descripción</th><th scope='col'>Acciones</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["NroPokedex"] . "</td>";
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" . $row["Descripcion"] . "</td>";
            echo "<td><a href='/Pokedex/admin/formUpdatePokemon.php?id=" . $row["Id"] . "'>Editar</a>&nbsp;<a href='/Pokedex/admin/deletePokemon.php?id=" . $row["Id"] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

    } else {
        echo "No se encontraron resultados";
    }
?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>