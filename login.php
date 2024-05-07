<?php

session_start();

if(isset($_SESSION['admin_id'])) {
    header("Location: /pokedex/admin/dashboard.php");
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include_once("db.php");

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT 1 FROM admin WHERE User = '$username' AND Password = '$password'";
    $result = $conn->query($sql);


    if($result->num_rows > 0) {

        $_SESSION['admin_id'] = 1;
        header("Location: /pokedex/admin/dashboard.php");
        exit();
    } else {

        $error = "Incorrect username or password";
    }
}

header("Location: /pokedex/index.php?error=$error");
exit();
