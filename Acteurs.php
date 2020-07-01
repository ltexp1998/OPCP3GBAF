<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css"/>
        <title>nom acteur (php) </title>
    </head>

    <body>
    
    <?php include("includes/header.php"); ?>

        <main>

            <section id="presentation_acteur"><!-- a recuperer de la DB -->

                <div class="logo_page_acteur">  <!-- a recuperer de la DB -->
                    <img src="img/CDE.png" alt=""/> <!-- logo exemple vrai logo a recuperer de la DB -->
                </div>
                <div class="description_page_acteur">
                    <h2>Nom acteur</h2> <!-- a recuperer de la DB -->
                    <a href="#">lien</a>
                    <!-- a recuperer de la DB -->
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>

            </section>

            <section id="commentaire">

                <div class="head_commentaire">
                    <div>
                        <h2>Commentaires</h2>
                    </div>
                    <div class="actions">
                        <a href="#" ><div>
                            <p>Nouveau</br>commentaire</p>
                        </div></a>
                        <div>
                            <p>5 pouces up<!-- a recuperer de la DB --></p> <a href="#"><span class="fas fa-thumbs-up"></span></a> <p>2 pouces down<!-- a recuperer de la DB --></p> <a href="#"><span class="fas fa-thumbs-down"></span></a>
                        </div>
                    </div>
                </div>

                <div class="commentaires"><!-- a recuperer de la DB -->

                    <div>
                        <p>Prénom</p>
                        <p>Date</p>
                        <p>Texte</p>
                    </div>

                    <div>
                        <p>Prénom</p>
                        <p>Date</p>
                        <p>Texte</p>
                    </div>

                    <div>
                        <p>Prénom</p>
                        <p>Date</p>
                        <p>Texte</p>
                    </div>

                </div>

            </section>

        </main>

        <?php include("includes/footer.php"); ?>

    </body>
</html>
