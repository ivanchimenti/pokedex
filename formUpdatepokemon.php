<?php


session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /pokedex/index.php");
    exit();
}

require_once("db.php");


if (isset($_GET['id'])) {
    // Obtener el valor de "id" y mostrarlo
    $id = $_GET['id'];

    $sqlQuery = "SELECT Id, Nombre, Imagen, Descripcion, NroPokedex FROM pokemon WHERE Id = '$id';";
    $result = mysqli_query($conn, $sqlQuery);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Id = $row["Id"];
            $Nombre = $row["Nombre"];
            $Imagen = $row["Imagen"];
            $Descripcion = $row["Descripcion"];
            $NroPokedex = $row["NroPokedex"];
        }
    }

    $sqlQueryTipos = "SELECT t.Id FROM pokemon p JOIN pokemon_tipo pt ON p.Id = pt.IdPokemon JOIN tipo t ON pt.IdTipo = t.Id WHERE p.Id = '$id';";
    $resultTipos = mysqli_query($conn, $sqlQueryTipos);

    if (mysqli_num_rows($resultTipos) > 0) {
        $tiposActuales = array();
        while ($row = mysqli_fetch_assoc($resultTipos)) {
            $tiposActuales[] = $row["Id"];
        }
    }

    $sqlQueryTiposCompleto = "SELECT * FROM tipo;";
    $resultTiposCompleto = mysqli_query($conn, $sqlQueryTiposCompleto);

    if (mysqli_num_rows($resultTiposCompleto) > 0) {
        $arrayTipos = array();
        while ($row = mysqli_fetch_assoc($resultTiposCompleto)) {
            $arrayTipos[$row["Id"]] = $row["Nombre"];
        }
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Modificar Pokemon</title>
</head>

<body>
    <?php
require_once("header.php");
?>

    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-10">
                <h1>Modificar Pokemon</h1>
                <form action="update.php" method='POST' enctype="multipart/form-data">
                    <!-- Campo oculto para enviar el ID del usuario -->
                    <input type="hidden" name="id_pokemon"
                        value="<?php echo $Id; ?>">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Nombre</span>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Pikachu"
                            aria-label="Nombre"
                            value="<?php echo $Nombre; ?>" required
                            aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Descripcion</span>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="soy un pokemon muy interesante" aria-label="Descripcion"
                            value="<?php echo $Descripcion; ?>"
                            required aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Nro. pokedex</span>
                        <input type="text" name="nroPokedex" id="nroPokedex" class="form-control" placeholder="45"
                            aria-label="Nro. pokedex"
                            value="<?php echo $NroPokedex; ?>"
                            required aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="tipo1">Tipo1</label>
                        <select class="form-select" name="tipo1" id="tipo1">
                            <?php
                          foreach ($arrayTipos as $clave => $valor) {
                              if($tiposActuales[0] == $clave) {
                                  echo "<option value='" . $clave. "' selected>". $valor ."</option>";
                              } else {
                                  echo "<option value='" . $clave. "'>". $valor ."</option>";
                              }
                          }
?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="tipo2">Tipo2</label>
                        <select class="form-select" name="tipo2" id="tipo2">
                            <?php
      if(count($tiposActuales) > 1) {
          foreach ($arrayTipos as $clave => $valor) {
              if($tiposActuales[1] == $clave) {
                  echo "<option value='" . $clave. "' selected>". $valor ."</option>";
              } else {
                  echo "<option value='" . $clave. "'>". $valor ."</option>";
              }
          }
      } else {
          echo "<option value='' selected>Elige una opcion</option>";
          foreach ($arrayTipos as $clave => $valor) {
              echo "<option value='" . $clave. "'>". $valor ."</option>";
          }
      }
?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control" id="file" hidden>
                        <input type="hidden" name="nombreArchivo" id="nombreArchivo"
                            value="<?php echo $Imagen;?>">
                        <input type="text" class="form-control" name="nombreImagen" id="nombreImagen"
                            aria-label="nombreImagen"
                            value="<?php echo $Imagen;?>" disabled
                            required>
                        <label class="input-group-text" for="file">Subir imagen</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary " type="submit">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('file').addEventListener('change', function() {
        var nombreImagen = this.files[0].name; // Obtener el nombre de la imagen seleccionada
        document.getElementById('nombreImagen').value = nombreImagen; // Actualizar el valor del input de texto
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    < /html>