<?php
session_start();
require('db/connection.php');
require('functions/functionsql.php');
if (isset($_SESSION['username'])) { //verifie si déjà loggé et ouvre la page home.php
    $actors = getactors();
    include('includes/home.php');
} elseif (isset($_GET['action'])) {
    ($_GET['action'] == 'register');  //ouvre la page d'inscription via le lien
    include('includes/register.php');
} elseif (isset($_GET['page'])) {
    ($_GET['page'] == 'forgetpass');  //ouvre la page mofid de mdp via le lien
    include('includes/forgetpass.php');
} else {
    include('includes/login.php'); // si pas loggé affiche la page de login
}
include("includes/footer.php"); //inclus toujours le footer
