<?php
$conn = mysqli_connect("localhost", "root", "", "pokedexpw2");

if (!$conn){ die("Error al conectar con la base de datos: " . mysqli_connected_error()); }

$sql = "SELECT * FROM pokemon";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) <= 0){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php
    include("header.php");

    session_start();

    if (isset($_SESSION['admin_id'])) {
        header("Location: admin/dashboard.php");
        exit();
    }
?>

<div class="container row justify-content-center align-items-center">
    <?php while ($row = $result -> fetch_assoc()): ?>
    <div class="card" style="width: 18rem;">
        <img src="<?php echo "assets/pkmnImages/" . $row['Id'] . ".gif"?>" class="card-img-top" alt="<?php echo $row['Nombre'];?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['Nombre'];?></h5>
            <a href="detalle_pokemon.php?busqueda=<?php echo $row['Id'];?>" class="btn btn-primary">Detalle</a>
        </div>
    </div>

    <?php endwhile; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>