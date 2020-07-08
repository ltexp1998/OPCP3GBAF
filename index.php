<?php
session_start();
require('db/connexion.php');
require('fonctions/fonctionsql.php');
$actors = getactors();
if (isset($_SESSION['username'])) {
    include('includes/home.php');
} elseif (@$_GET['login'] == 'register') {
    include('includes/register.php');
} elseif (@$_GET['login'] == 'forgetpass') {
    include('includes/forgetpass.php');
} else {
    include('includes/login.php');
}
include("includes/footer.php");
