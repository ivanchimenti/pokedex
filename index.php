<?php
session_start();
include_once ("configuration.php");
$router = Configuration::getRouter();

$controller = isset($_GET['controller']) ? $_GET['controller'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : "";

$router->route($controller,$action, $id);