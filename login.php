<?php
session_start();

if(isset($_SESSION['admin_id'])) {
    header("Location: /pokedex/admin/dashboard.php");
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    echo "estoy en login";
    $username = $_POST['username'];
    $password = $_POST['password'];

    include_once("db.php");

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT 1 FROM admin WHERE User = '$username' AND Password = '$password'";
    $result = $conn->query($sql);


    if($result->num_rows > 0) {
        $_SESSION['admin_id'] = 1;
        header("Location: /Pokedex/admin/dashboard.php");
        exit();
    } else {

        $error = "Incorrect username or password";
    }
}
?>

<!--<!DOCTYPE html>-->
<!--<html lang="es">-->
<!---->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Login</title>-->
<!--    <link rel="stylesheet" href="css/common.css">-->
<!--</head>-->
<!---->
<!--<body>-->
<!---->
<!--    <div class="header">-->
<!--        <a href="/pokedex/admin/dashboard.php">-->
<!--            <img src='./assets/Firma.svg' alt='logo' class="firma" />-->
<!--        </a>-->
<!---->
<!--    </div>-->
<!--    <h1 class="formTitle">Bienvenido</h1>-->
<!--    <div class="formulario">-->
<!--        <form action="login.php" method="post">-->
<!--            <label for="username">Usuario:</label><br>-->
<!--            <input type="text" id="username" name="username" required>-->
<!--            <br>-->
<!--            <label for="password">Contraseña:</label><br>-->
<!--            <input type="password" id="password" name="password" required>-->
<!--            <br>-->
<!--            --><?php //if(isset($error)): ?>
<!--            <p class="error">--><?php //echo $error; ?><!--</p>-->
<!--            --><?php //endif; ?>
<!--            <button type="submit" name="submit">Login</button>-->
<!--        </form>-->
<!--    </div>-->
<!---->
<!--</body>-->
<!---->
<!--</html>-->
