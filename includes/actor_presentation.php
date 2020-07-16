<?php include ('includes/header.php'); ?>
    <body>
        <br/>
        <main>
            <section id="presentation_acteur">
                <div class="logo_page_acteur">
                    <img src="<?= 'img' . DIRECTORY_SEPARATOR . $actor['filename']; ?>" alt="logo de l'acteur"/>
                    <!-- DIRECTORY_SEPARATOR sert a eviter les pb de chemin lors du deploiement-->
                </div>
                <div class="description_page_acteur">
                    <h2><?= $actor['name']; ?></h2>
                    <p><?= $actor['description']; ?></p>
                </div>
            </section>
        </main>
    <?php include("includes/footer.php");?>