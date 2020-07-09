<?php
session_start();
if (!isset($_SESSION['username'])) { //verification login sinon renvoi vers index et login
    header('Location: index.php');
    exit();
}
require('db/connexion.php');
require('fonctions/fonctionsql.php');
$actor = getActor($_GET['id_actor']); //verification de l'acteur a afficher
include('includes/actor_presentation.php'); // ouverture de la page

