<?php
//require_once('includes/db.php');
//require_once('includes/functions.php');
//
session_start();
$conn = mysqli_connect("localhost", "root", "", "pokedexpw2");
if (!$conn){ die("Error al conectar con la base de datos: " . mysqli_connected_error()); }

$pokemon = null;


if(isset($_GET['search'])) {
    $searchTerm = strtolower($_GET['search']);


    $sql = "SELECT * FROM pokemon WHERE LOWER(Nombre) = '$searchTerm'";
    $result = $conn->query($sql);


    if($result->num_rows > 0) {

        $pokemon = $result->fetch_assoc();
    } else {

        header("Location: index.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de búsqueda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
<!--    <link rel="stylesheet" href="css/common.css">-->
<!--    <link rel="stylesheet" href="css/index.css">-->
</head>

<body>

    <?php include('header.php'); ?>

    <div class="pokemon_container">
        <?php if($pokemon): ?>
        <a
            href="detalle_pokemon.php?id=<?php echo $pokemon['Id']; ?>">
            <div class="card">
                <h3 class="pkmn_name">
                    <?php echo $pokemon['Nombre']; ?>
                </h3>
                <img src=<?php echo "assets/pkmnImages/".$pokemon['Imagen'];?> style="width:200px;height:200px;" alt="<?php echo $pokemon['Nombre']; ?>">
            </div>
        </a>
        <?php endif; ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>