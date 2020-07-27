<!DOCTYPE html>
<html lang="fr" dir="ltr">
<header>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="style.css"/>
        <title>GBAF</title>
        <link rel="icon" sizes="144x144" href="img/fav_icon_gbaf.png">
    </head>
    <a href="index.php"><img id="logo" src="img/logo_gbaf.png"/></a>
    <div id="user">
        <p><a href="account.php"><?= $_SESSION['firstname']; ?> <?= $_SESSION['lastname']; ?></a><br/><a href="logout.php">Se déconnecter</a></p>
    </div>
</header>