<?php
session_start();
require('db/connexion.php');
require('model/model.php');
$actors = getActors();
/* echo "<pre>";
print_r($actors);
die(); */
if (isset($_SESSION['username'])) {
    include('includes/home.php');
} elseif ($_GET['login'] == 'register') {
    include('includes/register.php');
} elseif ($_GET['login'] == 'forgetpass') {
    include('includes/forgetpass.php');
} else {
    include('includes/login.php');
}
include("includes/footer.php");
