<?php

session_start();

function login()
{
    if(!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit();
    }
}

function logout()
{
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}