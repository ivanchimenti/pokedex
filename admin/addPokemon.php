<?php
require_once '../db.php';
require_once '../functions.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';


if (isset($_POST['NroPokedex'], $_POST['nombre'], $_POST['tipo1'], $_POST['tipo2'], $_POST['descripcion'])) {
    $NroPokedex = validate_input($_POST['NroPokedex']);
    $nombre = validate_input($_POST['nombre']);
    $tipo1 = validate_input($_POST['tipo1']);
    $tipo2 = validate_input($_POST['tipo2']);
    $descripcion = validate_input($_POST['descripcion']);
}


$imagen = '';

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = upload_image($_FILES['imagen']);
    if (!$imagen) {
        $error = "Error al subir la imagen.";
    }
} else {
    $error = "Por favor, seleccione una imagen.";
}


if (empty($error)) {

    $sql = "INSERT INTO pokemon (NroPokedex, nombre, descripcion, imagen) VALUES ('$NroPokedex', '$nombre', '$descripcion', '$imagen')";
    if ($conn->query($sql) === true) {
        $IdPokemon = $conn->insert_id;


        $sqlTipo1 = "INSERT INTO pokemon_tipo (IdPokemon, IdTipo) VALUES ('$IdPokemon', '$tipo1')";
        $conn->query($sqlTipo1);

        if (!empty($tipo2)) {
            if ($tipo2!=$tipo1) {
                $sqlTipo2 = "INSERT INTO pokemon_tipo (IdPokemon, IdTipo) VALUES ('$IdPokemon', '$tipo2')";
            $conn->query($sqlTipo2);
            }else{
                $error = "No se permiten tipos duplicados.";
            }
            
        }

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error al agregar el Pokémon a la base de datos: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pokémon</title>
</head>

<body>
    <?php include('../header.php'); ?>
    <h1>agregar Pokémon</h1>
    <div>

        <form
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="NroPokedex">Nro. de Pokedex:</label>
            <input type="text" id="NroPokedex" name="NroPokedex" required><br>


            <label for="tipo1">Primer Tipo:</label>
            <select id="tipo1" name="tipo1" required>
            <?php


    $sqlQueryTiposCompleto = "SELECT * FROM tipo;";
    $resultTiposCompleto = mysqli_query($conn, $sqlQueryTiposCompleto);

    if (mysqli_num_rows($resultTiposCompleto) > 0) {
        $arrayTipos = array();
        while ($row = mysqli_fetch_assoc($resultTiposCompleto)) {
            $arrayTipos[$row["Id"]] = $row["Nombre"];
        }
    }


                          foreach ($arrayTipos as $clave => $valor) {
                              if($clave==1) {
                                  echo "<option value='" . $clave. "' selected>". $valor ."</option>";
                              } else {
                                  echo "<option value='" . $clave. "'>". $valor ."</option>";
                              }
                          }
            ?>
        
            </select><br>

            <label for="tipo2">Segundo Tipo:</label>
            <select id="tipo2" name="tipo2">
                <option value="">Ninguno</option>
            <?php

$sqlQueryTiposCompleto = "SELECT * FROM tipo;";
$resultTiposCompleto = mysqli_query($conn, $sqlQueryTiposCompleto);

if (mysqli_num_rows($resultTiposCompleto) > 0) {
    $arrayTipos = array();
    while ($row = mysqli_fetch_assoc($resultTiposCompleto)) {
        $arrayTipos[$row["Id"]] = $row["Nombre"];
    }
}
          foreach ($arrayTipos as $clave => $valor) {
             
                  echo "<option value='" . $clave. "'>". $valor ."</option>";           
          }
   
?>
            </select><br>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea><br>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required><br>

            <button type="submit">Confirmar</button>
        </form>

        <?php if (!empty($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>