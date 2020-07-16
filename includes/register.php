<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['register_form'] == 'register') {
        $lastname = htmlspecialchars($_POST['lastname']); //formatage pour eviter entree incoherentes
        $firstname = htmlspecialchars($_POST['firstname']);
        $username = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['pass']);
        $checkpass = htmlspecialchars($_POST['checkpass']);
        $question = htmlspecialchars($_POST['question']);
        $answer = htmlspecialchars($_POST['answer']);
        $errors = 0;
        $errorsmsg = [];
        if (empty($lastname) OR strlen($lastname) > 45) { //verification longueur de l'entree
            $errors++;
            $errorsmsg['lastname'] = 'Le nom est vide ou est trop long';
        }
        if (empty($firstname) OR strlen($firstname) > 45) {
            $errors++;
            $errorsmsg['firstname'] = 'Le prénom est vide ou est trop long';
        }
        $user = getUser($username);
        if (!empty($user)) {
            $errors++;
            $errorsmsg['username'] = 'ce pseudo est déjà pris veuillez en saisir un autre';
        }
        if (empty($username) OR strlen($username) > 45 OR strlen($username) < 4) {
            $errors++;
            $errorsmsg['username'] = 'Le nom d\'utilisateur est vide ou est trop long ou trop court';
        }
        if (empty($pass) OR strlen($pass) > 70 OR strlen($pass) < 4) {
            $errors++;
            $errorsmsg['pass'] = 'Le mot de passe est vide ou est trop long ou trop court';
        }
        if ($pass != $checkpass) {
            $errors++;
            $errorsmsg['diffPass'] = 'Le mot de passe n\'est pas identique';
        }
        if (empty($question) OR strlen($question) > 255) {
            $errors++;
            $errorsmsg['question'] = 'La question est vide ou est trop longue';
        }
        if (empty($answer) OR strlen($answer) > 45) {
            $errors++;
            $errorsmsg['answer'] = 'La réponse est vide ou est trop longue';
        }
        if ($errors === 0) { // si tout est ok creation du newuser et cryptage du pswd
                $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
                createNewuser($lastname, $firstname, $username, $pass_hache, $question, $answer);
                header('Location: index.php');
                exit();
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
        <title>Inscription sur le site GBAF</title>
        <link rel="icon" sizes="144x144" href="img/fav_icon_gbaf.png">
    </head>
    <body>
        <div id="header_form">
            <a href="index.php"><img id="logo" src="img/logo_gbaf.png" alt="logo de GBAF"/></a>
            <p>Le Groupement Banque Assurance Français</p>
        </div>
        <main>
            <section class="form">
                <h1>Inscription</h1>
                <form method="post" novalidate>
                    <input type="hidden" name="register_form" value="register" />
                    <p><label for="lastname">Nom : </label><input type="text" name="lastname" id="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" required /></p>
                    <p class="error"><?= isset($errorsmsg['lastname']) ? $errorsmsg['lastname'] : '' ?></p>
                    <p><label for="firstname">Prénom : </label><input type="text" name="firstname" id="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>"required /></p>
                    <p class="error"><?= isset($errorsmsg['firstname']) ? $errorsmsg['firstname'] : '' ?></p>
                    <p><label for="username">Nom d'utilisateur : </label><input type="text" name="username" id="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required /></p>
                    <p class="error"><?= isset($errorsmsg['username']) ? $errorsmsg['username'] : '' ?></p>
                    <p><label for="pass">Mot de passe :</label><input type="password" name="pass" id="pass" required /></p>
                    <p class="error"><?= isset($errorsmsg['pass']) ? $errorsmsg['pass'] : '' ?></p>
                    <p><label for="checkpass">Confirmation du Mot de passe :</label><input type="password" name="checkpass" id="checkpass" required /></p>
                    <p class="error"><?= isset($errorsmsg['diffPass']) ? $errorsmsg['diffPass'] : '' ?></p>
                    <p><label for="question">Question secrète : </label><input type="text" name="question" id="question" value="<?= isset($_POST['question']) ? $_POST['question'] : '' ?>" required /></p>
                    <p class="error"><?= isset($errorsmsg['question']) ? $errorsmsg['question'] : '' ?></p>
                    <p><label for="answer">Réponse à la question secrète : </label><input type="text" name="answer" id="answer" value="<?= isset($_POST['answer']) ? $_POST['answer'] : '' ?>" required /></p>
                    <p class="error"><?= isset($errorsmsg['answer']) ? $errorsmsg['answer'] : '' ?></p>
                    <p><input type="submit" value="Valider" /></p>
                </form>
            </section>
        </main>

