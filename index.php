<?php
session_start();
require('db/connexion.php');
require('fonctions/fonctionsql.php');
if (isset($_SESSION['username'])) { //verifie si déjà loggé et ouvre la page home.php
    $actors = getactors();
    include('includes/home.php'); //ajouter le elsif vers actor
} elseif (@$_GET['login'] == 'register') { //ouvre la page d'inscription via le lien
    include('includes/register.php');
} elseif (@$_GET['login'] == 'forgetpass') { //ouvre la page mofid de mdp via le lien
    include('includes/forgetpass.php');
} else {
    include('includes/login.php'); // si pas loggé affiche la page de login
}
include("includes/footer.php"); //inclus toujours le footer
