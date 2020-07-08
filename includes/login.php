<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['login_form'] == 'connexion') {
        $username = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['pass']);
        $user = getUser($username);
        $isPasswordCorrect = password_verify($pass, $user['password']);
        if ($isPasswordCorrect) {
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit();
        } else {
            $errorMsg = "Vérifiez vos identifiants";
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
        <title>Connexion à GBAF</title>
        <link rel="icon" sizes="144x144" href="img/fav_icon_gbaf.png">
    </head>
    <body>
        <div id="header_form">
            <a href="index.php"><img id="logo" src="img/logo_gbaf.png" alt="logo de GBAF"/></a>
            <p>Le Groupement Banque Assurance Français</p>
        </div>
        <main>
            <section class="form">
                <h1>Connectez-vous</h1>
                <form method="post">
                    <input type="hidden" name="login_form" value="connexion" />
                    <p><label for="username">Nom d'utilisateur : </label><br /><input type="text" name="username" id="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required /></p>
                    <p><label for="pass">Mot de passe : </label><br /><input type="password" name="pass" id="pass" required /></p>
                    <p class="error"><?= isset($errorMsg) ? $errorMsg : '' ?></p>
                    <p><input type="submit" value="Se connecter" /></p>
                </form>
                <p>Pas encore de compte ? <a href="index.php?login=register">Inscrivez-vous !</a></p>
                <p>Mot de passe oublié ? <a href="index.php?login=forgetpass">Créer un nouveau mot de passe</a></p>
            </section>
        </main>
