<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
require('db/connexion.php');
require('fonctions/fonctionsql.php');
$actor = getActor($_GET['id_actor']);
include('includes/actor_presentation.php');

