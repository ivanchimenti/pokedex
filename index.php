<?php
session_start();
require_once 'db.php';

$sql = "SELECT * FROM pokemon";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) <= 0) {
    echo "No se encontraron resultados";
}
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
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php
    include("header.php");


if(isset($_GET['error'])) {
    $error = $_GET['error'];

    echo "<div class='alert alert-danger' role='alert'>$error</div>";

}


if (isset($_SESSION['admin_id'])) {
    header("Location: admin/dashboard.php");
    exit();
}
?>

    <div class="container">
        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-10" style="display: contents;">
                <?php while ($row = $result -> fetch_assoc()): ?>
                <div class="card m-3 p-3 justify-content-center" style="width: 18rem;">
                    <img class="imagenPokemon"
                        src="<?php echo $row['Imagen']; ?>"
                        class="card-img-top" style="height: 100%"
                        alt="<?php echo $row['Nombre'];?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $row['Nombre'];?>
                        </h5>
                        <a href="detalle_pokemon.php?id=<?php echo $row['Id'];?>"
                            class="btn btn-primary">Detalle</a>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>