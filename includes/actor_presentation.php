<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="style.css"/>
        <title><?= $actor['name']; ?></title>
        <link rel="icon" sizes="144x144" href="img/fav_icon_gbaf.png">
    </head>
    <body>
        <?php include("includes/header.php"); ?>
        <br/>
        <main>
            <section id="presentation_acteur">
                <div class="logo_page_acteur">
                    <img src="<?= 'img' . DIRECTORY_SEPARATOR . $actor['filename']; ?>" alt="logo de l'acteur"/>
                </div>
                <div class="description_page_acteur">
                    <h2><?= $actor['name']; ?></h2>
                    <p><?= $actor['description']; ?></p>
                </div>
            </section>
        </main>
        <?php include("includes/footer.php");?>
