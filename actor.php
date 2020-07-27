<?php
session_start();
if (!isset($_SESSION['username'])) { //verification login sinon renvoi vers index et login
    header('Location: index.php');
    exit();
}
require('db/connection.php');
require('functions/functionsql.php');
$actor = getActor($_GET['id_actor']); //verification de l'acteur a afficher
include('includes/actor_presentation.php'); // ouverture de la page

