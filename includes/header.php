<header>
    <a href="index.php"><img id="logo" src="img/logo_gbaf.png" alt="logo de GBAF"/></a>
    <div id="user">
        <p><a href="account.php"><?= $_SESSION['firstname']; ?> <?= $_SESSION['lastname']; ?></a><br/><a href="logout.php">Se déconnecter</a></p>
    </div>
</header>
