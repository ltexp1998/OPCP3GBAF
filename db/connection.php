<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=GBAF;charset=utf8','root','root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (\Exception $e) {
    die('Erreur de connexion à la base de donnée : ' . $e->getMessage() . ' se référer à la notice d\'utilisation de PHP et MySql.');
}

?>