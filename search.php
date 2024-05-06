<?php
require_once('includes/db.php');
require_once('includes/functions.php');

session_start();

    $conn = mysqli_connect("localhost", "root", "", "pokedexpw2");
    if (!$conn) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
        $search = validate_input($_GET["search"]);
    
        // Check if session ID is set
        if (isset($_SESSION['admin_id'])) {
            // Query for admin user
            $sql = "SELECT * FROM pokemon WHERE name LIKE '%$search%'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $errorMessage = "";
            } else {
                header("Location: dashboard.php?error=1");
                exit();
            }
        } else {
            // Query for non-admin user
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
        header("Location: dashboard.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de búsqueda</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <?php include('header.php'); ?>

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
                    <td><?php echo $row['dexNumber']; ?>
                    </td>
                    <td>
                        <a class="pkmn_name"
                            href="/pokedex/pokemon.php?id=<?php echo $row['id']; ?>">
                            <?php echo $row['name']; ?>
                        </a>
                    </td>
                    <td>
                        <a class="pkmn_name"
                            href="/pokedex/pokemon.php?id=<?php echo $row['id']; ?>">
                            <img class="pkmn_img"
                                src="<?php echo $row['image']; ?>"
                                alt="<?php echo $row['name']; ?>">
                        </a>
                    </td>
                    <td>
                    <?php
                                $pokemonId = $row['id'];
                    $sqlTypes = "SELECT t.name FROM type t JOIN pokemon_type pt ON t.id = pt.type_id WHERE pt.pokemon_id = $pokemonId";
                    $resultTypes = $conn->query($sqlTypes);
                    echo '<div class="types">';
                    while ($rowType = $resultTypes->fetch_assoc()) {
                        echo '<div class="icon ' . $rowType['name'] . '"><img src="/pokedex/assets/types/' . $rowType['name'] . '.svg" alt="' . $rowType['name'] . '"></div>';
                    }
                    echo '</div>';
                    ?>
                    </td>
                    <td><a
                            href="editPokemon.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
                    </td>
                    <td><a
                            href="deletePokemon.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a>
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
                            src=<?php echo "assets/pkmnImages/".$pokemon['Imagen'];?>
                        style="width:200px;height:200px;"
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
    <?php include('../footer.php'); ?>

</html>