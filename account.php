<?php
$pageTitle = 'Mon compte sur le site GBAF';
session_start();
//verification si déjà loggé sinon renvois vers page d'acceuil
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
require('db/connection.php');
require('functions/functionsql.php');
//Formatage et vérification des différentes entrées User
$user = getUser($_SESSION['username']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['account_form'] == 'username') {
        $newUsername = htmlspecialchars($_POST['username']);
        $testUsername = getUser($newUsername);
        if (!empty($testUsername)) {
            $errorUsername = 'c\'est votre pseudo actuel ou ce pseudo est déjà pris veuillez en saisir un autre';
        } elseif (empty($newUsername) OR strlen($newUsername) > 20 OR strlen($newUsername) < 4) {
            $errorUsername = 'Le nom d\'utilisateur est vide ou est trop long ou trop court';
        } else {
            updateUsername($newUsername, $_SESSION['username']);
            $_SESSION['username'] = $newUsername;
            $confirmUsername = 'Votre nom d\'utilisateur a bien été changé';
        }
    }
    if ($_POST['account_form'] == 'password') {
        $newpass = htmlspecialchars($_POST['newpass']);
        $checkpass = htmlspecialchars($_POST['checkpass']);
        if (empty($newpass) OR strlen($newpass) > 20 OR strlen($newpass) < 4) {
            $errorPass = 'Le mot de passe est vide ou est trop long ou trop court';
        } elseif ($newpass != $checkpass) {
            $diffPass = "Vos mots de passe saisis ne sont pas identiques, Réessayez";
        } else {
            $pass_hache = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
            updatePass($pass_hache, $_SESSION['username']);
            $confirmPassword = 'Votre mot de passe a bien été changé';
        }
    }
    if ($_POST['account_form'] == 'lastname') {
        $newLastname = htmlspecialchars($_POST['lastname']);
        if (empty($newLastname) OR strlen($newLastname) > 30) {
            $errorLastname = 'Le nom est vide ou est trop long';
        } else {
            updateLastname($newLastname, $_SESSION['username']);
            $_SESSION['lastname'] = $newLastname;
            $confirmLastname = 'Votre nom a bien été changé';
        }
    }
    if ($_POST['account_form'] == 'firstname') {
        $newFirstname = htmlspecialchars($_POST['firstname']);
        if (empty($newFirstname) OR strlen($newFirstname) > 30) {
            $errorFirstname = 'Le prénom est vide ou est trop long';
        } else {
            updateFirstname($newFirstname, $_SESSION['username']);
            $_SESSION['firstname'] = $newFirstname;
            $confirmFirstname = 'Votre prénom a bien été changé';
        }
    }
    if ($_POST['account_form'] == 'questionAnswer') {
        $newQuestion = htmlspecialchars($_POST['question']);
        $newAnswer = htmlspecialchars($_POST['answer']);
        if (empty($newQuestion) OR strlen($newQuestion) > 150) {
            $errorQuestion = 'La question est vide ou est trop longue';
        } elseif (empty($newAnswer) OR strlen($newAnswer) > 50) {
            $errorAnswer = 'La réponse est vide ou est trop longue';
        } else {
            updateQuestionAnswer($newQuestion, $newAnswer, $_SESSION['username']);
            $confirmQuestionAnswer = 'Vos question/réponse ont bien été changées';
            $user = getUser($_SESSION['username']);
        }
    }
}
include("includes/header.php");
?>
<main id="account">
    <h1><?= $_SESSION['firstname'] ?>&nbsp;&nbsp;<?= $_SESSION['lastname'] ?></h1>

    <section class="form">
        <h2>Changer mon nom d'utilisateur</h2>
        <form method="post">
            <input type="hidden" name="account_form" value="username" />
            <p><label for="username">Nom d'utilisateur : </label><br /><input type="text" name="username" id="username" value="<?= $_SESSION['username']; ?>" /></p>
            <p class="error"><?= isset($errorUsername) ? $errorUsername : '' ?></p>
            <p class="confirm"><?= isset($confirmUsername) ? $confirmUsername : '' ?></p>
            <input type="submit" value="Valider les changements">
        </form>

        <h2>Changer mon nom</h2>
        <form method="post" novalidate>
            <input type="hidden" name="account_form" value="lastname" />
            <p><label for="lastname">Nom : </label><br /><input type="text" name="lastname" id="lastname" value="<?= $_SESSION['lastname']; ?>" /></p>
            <p class="error"><?= isset($errorLastname) ? $errorLastname : '' ?></p>
            <p class="confirm"><?= isset($confirmLastname) ? $confirmLastname : '' ?></p>
            <input type="submit" value="Valider les changements">
        </form>

        <h2>Changer mon prénom</h2>
        <form method="post" novalidate>
            <input type="hidden" name="account_form" value="firstname" />
            <p><label for="firstname">Prénom : </label><br /><input type="text" name="firstname" id="firstname" value="<?= $_SESSION['firstname']; ?>" /></p>
            <p class="error"><?= isset($errorFirstname) ? $errorFirstname : '' ?></p>
            <p class="confirm"><?= isset($confirmFirstname) ? $confirmFirstname : '' ?></p>
            <input type="submit" value="Valider les changements">
        </form>

        <h2>Changer ma question secrète et ma réponse</h2>
        <form method="post" novalidate>
            <input type="hidden" name="account_form" value="questionAnswer" />
            <p><label for="question">Ma nouvelle question : </label><br /><input type="text" name="question" id="question" value="<?= $user['question']; ?>" required /></p>
            <p class="error"><?= isset($errorQuestion) ? $errorQuestion : '' ?></p>
            <p><label for="answer">Ma nouvelle réponse : </label><br /><input type="text" name="answer" id="answer" value="<?= $user['answer']; ?>" required /></p>
            <p class="error"><?= isset($errorAnswer) ? $errorAnswer : '' ?></p>
            <p class="confirm"><?= isset($confirmQuestionAnswer) ? $confirmQuestionAnswer : '' ?></p>
            <input type="submit" value="Valider les changements">
        </form>
    </section>

    <section class="form">
        <h2>Changer mon mot de passe</h2>
        <form method="post" novalidate>
            <input type="hidden" name="account_form" value="password" />
            <p><label for="newpass">Mon nouveau mot de passe : </label><br /><input type="password" name="newpass" id="newpass" required /></p>
            <p class="error"><?= isset($errorPass) ? $errorPass : '' ?></p>
            <p><label for="checkpass">Confirmation du nouveau mot de passe : </label><br /><input type="password" name="checkpass" id="checkpass" required /></p>
            <p class="error"><?= isset($diffPass) ? $diffPass : '' ?></p>
            <p class="confirm"><?= isset($confirmPassword) ? $confirmPassword : '' ?></p>
            <input type="submit" value="Valider les changements">
        </form>
    </section>

</main>
<?php include("includes/footer.php"); ?>
