<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=GBAF;charset=utf8','root','root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (\Exception $e) {// à modif en GLOBAL
    die('Erreur :' . $e->getMessage());
}
