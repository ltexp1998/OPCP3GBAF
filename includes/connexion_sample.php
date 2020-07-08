<?php

    try {
        $db = new PDO('mysql:host=adresse de l\'hôte de la base de données;dbname=nom de la base de données;charset=utf8','utilisateur de la base de données','mot de passe de la base de données', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch (\Exception $e) {
        die('Erreur :' . $e->getMessage());
    }
// renommer ce fichier "connexion.php" !
