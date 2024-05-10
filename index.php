<?php

require_once('models/DataBase.php');
require_once('controlleur/Controlleur.php');


$database = new Database();

$controller = new Controller($database);

$controller->handleRequest();

?>
