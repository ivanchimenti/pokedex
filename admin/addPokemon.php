<?php
//Chequear que creen db.php, y el nombre de $_SESSION['admin_id']
require_once '../db.php';
require_once '../functions.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

$NroPokedex = validate_input($_POST['NroPokedex']);
$nombre = validate_input($_POST['nombre']);
$tipo1 = validate_input($_POST['tipo1']);
$tipo2 = validate_input($_POST['tipo2']);
$descripcion = validate_input($_POST['descripcion']);

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
            $sqlTipo2 = "INSERT INTO pokemon_tipo (IdPokemon, IdTipo) VALUES ('$IdPokemon', '$tipo2')";
            $conn->query($sqlTipo2);
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
    <?php include('header.php'); ?>
    <h1>agregar Pokémon</h1>
    <div>

        <form
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="nroPokedex">Nro. de Pokedex:</label>
            <input type="text" id="nroPokedex" name="nroPokedex" required><br>


            <label for="tipo1">Primer Tipo:</label>
            <select id="tipo1" name="tipo1" required>
                <option value="1">Normal</option>
                <option value="2">Pelea</option>
                <option value="3">Volador</option>
                <option value="4">Veneno</option>
                <option value="5">Tierra</option>
                <option value="6">Roca</option>
                <option value="7">Insecto</option>
                <option value="8">Fantasma</option>
                <option value="9">Acero</option>
                <option value="10">Fuego</option>
                <option value="11">Agua</option>
                <option value="12">Planta</option>
                <option value="13">Eléctrico</option>
                <option value="14">Psíquico</option>
                <option value="15">Hielo</option>
                <option value="16">Dragón</option>
                <option value="17">Siniestro</option>
                <option value="18">Hada</option>
            </select><br>

            <label for="tipo2">Segundo Tipo:</label>
            <select id="tipo2" name="tipo2">
                <option value="">Ninguno</option>
                <option value="1">Normal</option>
                <option value="2">Pelea</option>
                <option value="3">Volador</option>
                <option value="4">Veneno</option>
                <option value="5">Tierra</option>
                <option value="6">Roca</option>
                <option value="7">Insecto</option>
                <option value="8">Fantasma</option>
                <option value="9">Acero</option>
                <option value="10">Fuego</option>
                <option value="11">Agua</option>
                <option value="12">Planta</option>
                <option value="13">Eléctrico</option>
                <option value="14">Psíquico</option>
                <option value="15">Hielo</option>
                <option value="16">Dragón</option>
                <option value="17">Siniestro</option>
                <option value="18">Hada</option>
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