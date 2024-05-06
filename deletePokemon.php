<?php

require_once 'db.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /pokedex/index.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $IdPokemon = $_GET['id'];

    $sqlDeleteTypes = "DELETE FROM pokemon_tipo WHERE IdPokemon = $IdPokemon";
    if ($conn->query($sqlDeleteTypes) === true) {

        $sqlImageRoute = "SELECT image FROM pokemon WHERE Id = $IdPokemon";
        $result = $conn->query($sqlImageRoute);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $imageRoute = $_SERVER['DOCUMENT_ROOT'] . $row['image'];

            unlink($imageRoute);

        }

        $sqlDeletePokemon = "DELETE FROM pokemon WHERE Id = $IdPokemon";
        if ($conn->query($sqlDeletePokemon) === true) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "No se pudo borrar Pokémon: " . $conn->error;
        }
    } else {
        echo "No se pudo borrar tipos del Pokémon: " . $conn->error;
    }
} else {
    header("Location: dashboard.php");
    exit();
}
