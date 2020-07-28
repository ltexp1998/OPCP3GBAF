<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Vérification de l'existance du User
    if ($_POST['change_pass_form'] == 'username') { 
        $username = htmlspecialchars($_POST['username'] ); 
        $userexist = getUser($username); 
        $question = $userexist['question'];
        if (empty($userexist)) {
            $errorusername = 'Utilisateur inconnu';
        }
    }
    //Vérification de la réponse à la question secrête
    if ($_POST['change_pass_form'] == 'question') {
        $answer = htmlspecialchars($_POST['answer']);
        $username = $_POST['username'];
        $answerexist = getAnswer($answer, $username);
        if (empty($answerexist)) {
            $erroranswer = 'Réponse incorrecte';
            $userexist = getUser($username);
            $question = $userexist['question'];
        }
    }
    //Création du nouveau mot de passe avec vérification de la double entrée
    if ($_POST['change_pass_form'] == 'newpass') {
        $username = $_POST['username'];
        $newpass = htmlspecialchars($_POST['newpass']);
        $checkpass = htmlspecialchars($_POST['checkpass']);
        if (empty($newpass) OR strlen($newpass) > 70 OR strlen($newpass) < 4) {
            $errorpass = 'Le mot de passe est vide ou est trop long ou trop court';
        } else {
            if ($newpass != $checkpass) {
                $diffpass = 'Le mot de passe n\'est pas identique';
            } else {
                $pass_hache = password_hash($newpass, PASSWORD_BCRYPT);
                updatePass($pass_hache, $username);
                header('Location: index.php');
                exit();
            }
        }
    }
}
?>

<?php include('headerregister.php') ?>
        <main>
            <section class="form">
                <h1>Changer votre mot de passe</h1>
                <?php
                if ($_SERVER['REQUEST_METHOD'] != 'POST' OR isset($errorUsername)) { ?>
                    <form method="post">
                        <input type="hidden" name="change_pass_form" value="username" />
                        <label for="username">Saisissez votre nom d'utilisateur : </label><input type="text" name="username" id="username" value="<?= isset($_POST['username']) ? $username : '' ?>" required />
                        <p class="error"><?= isset($errorusername) ? $errorusername : '' ?></p>
                        <input type="submit" value="Valider">
                    </form>
                <?php }
                if (@$_POST['change_pass_form'] == 'username' AND !isset($errorusername) OR isset($erroranswer)) { ?>
                    <label>Votre question secrète :</label>
                    <p id="question"><?= $question; ?></p>
                    <form method="post">
                        <input type="hidden" name="change_pass_form" value="question" />
                        <input type="hidden" name="username" value="<?= $username; ?>" />
                        <label for="answer">Votre réponse : </label><input type="text" name="answer" id="answer" value="<?= isset($_POST['answer']) ? $answer : '' ?>" required />
                        <p class="error"><?= isset($erroranswer) ? $erroranswer : '' ?></p>
                        <input type="submit" value="Valider">
                    </form>
                <?php }
                if (@$_POST['change_pass_form'] == 'question' AND !isset($erroranswer) OR isset($diffpass) OR isset($errorpass)) { ?>
                    <form method="post">
                        <input type="hidden" name="change_pass_form" value="newpass" />
                        <input type="hidden" name="username" value="<?= $username; ?>" />
                        <p><label for="newpass">Votre nouveau mot de passe : </label><br /><input type="password" name="newpass" id="newpass" /></p>
                        <p class="error"><?= isset($errorpass) ? $errorpass : '' ?></p>
                        <p><label for="checkpass">Confirmer votre nouveau mot de passe : </label><br /><input type="password" name="checkpass" id="checkpass" /></p>
                        <p class="error"><?= isset($diffpass) ? $diffpass : '' ?></p>
                        <input type="submit" value="Valider">
                    </form>
                <?php } ?>
            </section>
        </main>
