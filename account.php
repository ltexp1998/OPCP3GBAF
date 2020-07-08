<?php
session_start();
require('db/connexion.php');
require('fonctions/fonctionsql.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['account_form'] == 'username') {
        $user = getUser($_SESSION['username']);
        $username = $user['username'];
        $newUsername = htmlspecialchars($_POST['username']);
        $errors = 0;
        $testUsername = getUser($newUsername);
        if (!empty($testUsername)) {
            $errors++;
            $errorUsername = 'c\'est votre pseudo actuel ou ce pseudo est déjà pris veuillez en saisir un autre';
        }
        if (empty($newUsername) OR strlen($newUsername) > 45 OR strlen($newUsername) < 4) {
            $errors++;
            $errorUsername = 'Le nom d\'utilisateur est vide ou est trop long ou trop court';
        }
        if ($errors === 0) {
            updateUsername($newUsername, $username);
            $user = getUser($username);
            $username = $user['username'];
            $_SESSION['username'] = $newUsername;
            $confirmUsername = 'Votre nom d\'utilisateur a bien été changé';
        }
    }
    if ($_POST['account_form'] == 'password') {
        $username = $_SESSION['username'];
        $newpass = htmlspecialchars($_POST['newpass']);
        $checkpass = htmlspecialchars($_POST['checkpass']);
        $errors = 0;
        if (empty($newpass) OR strlen($newpass) > 70 OR strlen($newpass) < 4) {
            $error++;
            $errorPass = 'Le mot de passe est vide ou est trop long ou trop court';
        }
        if ($newpass != $checkpass) {
            $errors++;
            $diffPass = "Vos mots de passe saisis ne sont pas identiques, Réessayez";
        }
        if ($errors === 0) {
            $pass_hache = password_hash($_POST['newpass'], PASSWORD_DEFAULT);
            updatePass($pass_hache, $username);
            $confirmPassword = 'Votre mot de passe a bien été changé';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="style.css"/>
        <title>Mon compte sur le site GBAF</title>
        <link rel="icon" sizes="144x144" href="img/fav_icon_gbaf.png">
    </head>
    <body>
        <?php include("includes/header.php"); ?>

        <main id="account">
            <p><h1><?= $_SESSION['lastname'] ?> <?= $_SESSION['firstname'] ?></h1></p>
            <section class="form">
                <h2>Changer mon nom d'utilisateur</h2>
                <form method="post">
                    <input type="hidden" name="account_form" value="username" />
                    <p><label for="username">Nom d'utilisateur : </label><br /><input type="text" name="username" id="username" value="<?= $_SESSION['username']; ?>" /></p>
                    <p class="error"><?= isset($errorusername) ? $errorusername : '' ?></p>
                    <p class="confirm"><?= isset($confirmusername) ? $confirmusername : '' ?></p>
                    <input type="submit" value="Valider les changements">
                </form>
            </section>
            <section class="form">
                <h2>Changer mon mot de passe</h2>
                <form method="post">
                    <input type="hidden" name="account_form" value="password" />
                    <p><label for="newpass">Mon nouveau mot de passe : </label><br /><input type="password" name="newpass" id="newpass" required /></p>
                    <p class="error"><?= isset($errorpass) ? $errorpass : '' ?></p>
                    <p><label for="checkpass">Confirmation du nouveau mot de passe : </label><br /><input type="password" name="checkpass" id="checkpass" required /></p>
                    <p class="error"><?= isset($diffpass) ? $diffpass : '' ?></p>
                    <p class="confirm"><?= isset($confirmpassword) ? $confirmpassword : '' ?></p>
                    <input type="submit" value="Valider les changements">
                </form>
            </section>
            
        </main>
        <?php include("includes/footer.php"); ?>
