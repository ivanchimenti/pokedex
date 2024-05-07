<?php
require_once 'db.php';
require_once 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search = validate_input($_GET["search"]);

    if (isset($_SESSION['admin_id'])) {

        $searchTerm = strtolower($search);


        $sql = "SELECT id, Nombre, NroPokedex, imagen FROM pokemon WHERE LOWER(Nombre) = '$searchTerm'";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $errorMessage = "";
        } else {
            header("Location: admin/dashboard.php?error=1");
            exit();
        }
    } else {
        $searchTerm = strtolower($search);

        $sql = "SELECT * FROM pokemon WHERE LOWER(Nombre) = '$searchTerm'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $pokemon = $result->fetch_assoc();
        } else {
            header("Location: index.php?error=1");
            exit();
        }
    }
} else {
    header("Location: admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex - Dashboard</title>
    <link rel="stylesheet" href="/pokedex/assets/css/dashboard.css">
</head>

<body>

    <?php include('./header.php'); ?>
    <div class="pokemon_container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dex Number</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['admin_id'])): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?>
                    </td>
                    <td><?php echo $row['NroPokedex']; ?>
                    </td>
                    <td>
                        <a class="pkmn_name"
                            href="/pokedex/pokemon.php?id=<?php echo $row['id']; ?>">
                            <?php echo $row['Nombre']; ?>
                        </a>
                    </td>
                    <td>
                        <a class="pkmn_name"
                            href="/pokedex/pokemon.php?id=<?php echo $row['id']; ?>">
                            <img class="pkmn_img"
                                src="<?php echo $row['imagen']; ?>"
                                alt="<?php echo $row['Nombre']; ?>">
                        </a>
                    </td>
                    <td>
                        <?php
                                $pokemonId = $row['id'];

                    $sqlTypes = "SELECT t.id, t.nombre FROM tipo AS t JOIN pokemon_tipo AS pt ON t.id = pt.idTipo WHERE pt.idPokemon = $pokemonId";
                    $resultTypes = $conn->query($sqlTypes);
                    echo '<div class="types">';
                    while ($rowType = $resultTypes->fetch_assoc()) {
                        echo '<div class="' . $rowType['nombre'] . '"><img src="/pokedex/assets/images/tipos/' . $rowType['id'] . '.png" alt="' . $rowType['nombre'] . '"></div>';
                    }
                    echo '</div>';



                    ?>
                    </td>
                    <td><a
                            href="admin/formUpdatepokemon.php?id=<?php echo $row['id']; ?>"><button>Editar</button></a>
                    </td>
                    <td><a
                            href="admin/deletePokemon.php?id=<?php echo $row['id']; ?>"><button>Borrar</button></a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <?php if ($pokemon): ?>
                <a
                    href="detalle_pokemon.php?id=<?php echo $pokemon['Id']; ?>">
                    <div class="card">
                        <h3 class="pkmn_name">
                            <?php echo $pokemon['Nombre']; ?>
                        </h3>
                        <img
                            src=<?php echo $pokemon['Imagen'];?>
                        style="width: 100px;"
                        alt="<?php echo $pokemon['Nombre']; ?>">
                    </div>
                </a>
                <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (isset($_SESSION['admin_id'])): ?>
        <a class="addPokemon" href="addPokemon.php"><button>Add Pokémon</button></a>
        <?php endif; ?>
    </div>
</body>

</html>