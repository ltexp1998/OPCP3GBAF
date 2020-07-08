<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['change_pass_form'] == 'username') {
        $username = htmlspecialchars($_POST['username'] );
        $userExist = getUser($username);
        $question = $userExist['question'];
        if (empty($userExist)) {
            $errorUsername = 'Utilisateur inconnu';
        }
    }
    if ($_POST['change_pass_form'] == 'question') {
        $answer = htmlspecialchars($_POST['answer']);
        $username = $_POST['username'];
        $answerExist = getAnswer($answer, $username);
        if (empty($answerExist)) {
            $errorAnswer = 'Réponse incorrecte';
            $userExist = getUser($username);
            $question = $userExist['question'];
        }
    }
    if ($_POST['change_pass_form'] == 'newpass') {
        $username = $_POST['username'];
        $newpass = htmlspecialchars($_POST['newpass']);
        $checkpass = htmlspecialchars($_POST['checkpass']);
        if (empty($newpass) OR strlen($newpass) > 20 OR strlen($newpass) < 4) {
            $errorPass = 'Le mot de passe est vide ou est trop long ou trop court';
        } else {
            if ($newpass != $checkpass) {
                $diffPass = 'Le mot de passe n\'est pas identique';
            } else {
                $pass_hache = password_hash($newpass, PASSWORD_DEFAULT);
                updatePass($pass_hache, $username);
                header('Location: index.php');
                exit();
            }
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
        <title>Nouveau mot de passe</title>
        <link rel="icon" sizes="144x144" href="img/fav_icon_gbaf.png">
    </head>
    <body>
        <div id="header_form">
            <a href="index.php"><img id="logo" src="img/logo_gbaf.png" alt="logo de GBAF"/></a>
            <p>Le Groupement Banque Assurance Français</p>
        </div>
        <main>
            <section class="form">
                <h1>Changer votre mot de passe</h1>
                <?php
                if ($_SERVER['REQUEST_METHOD'] != 'POST' OR isset($errorUsername)) { ?>
                    <form method="post">
                        <input type="hidden" name="change_pass_form" value="username" />
                        <label for="username">Saisissez votre nom d'utilisateur : </label><input type="text" name="username" id="username" value="<?= isset($_POST['username']) ? $username : '' ?>" required />
                        <p class="error"><?= isset($errorUsername) ? $errorUsername : '' ?></p>
                        <input type="submit" value="Valider">
                    </form>
                <?php }
                if ($_POST['change_pass_form'] == 'username' AND !isset($errorUsername) OR isset($errorAnswer)) { ?>
                    <label>Votre question secrète :</label>
                    <p id="question"><?= $question; ?></p>
                    <form method="post">
                        <input type="hidden" name="change_pass_form" value="question" />
                        <input type="hidden" name="username" value="<?= $username; ?>" />
                        <label for="answer">Votre réponse : </label><input type="text" name="answer" id="answer" value="<?= isset($_POST['answer']) ? $answer : '' ?>" required />
                        <p class="error"><?= isset($errorAnswer) ? $errorAnswer : '' ?></p>
                        <input type="submit" value="Valider">
                    </form>
                <?php }
                if ($_POST['change_pass_form'] == 'question' AND !isset($errorAnswer) OR isset($diffPass) OR isset($errorPass)) { ?>
                    <form method="post">
                        <input type="hidden" name="change_pass_form" value="newpass" />
                        <input type="hidden" name="username" value="<?= $username; ?>" />
                        <p><label for="newpass">Votre nouveau mot de passe : </label><br /><input type="password" name="newpass" id="newpass" /><p/>
                        <p class="error"><?= isset($errorPass) ? $errorPass : '' ?></p>
                        <p><label for="checkpass">Confirmer votre nouveau mot de passe : </label><br /><input type="password" name="checkpass" id="checkpass" /></p>
                        <p class="error"><?= isset($diffPass) ? $diffPass : '' ?></p>
                        <input type="submit" value="Valider">
                    </form>
                <?php } ?>
            </section>
        </main>
