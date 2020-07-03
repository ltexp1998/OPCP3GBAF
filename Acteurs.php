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
                            <div class="Nouveau_commentaire">
                            <p>bouton Nouveau</br>commentaire</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="votes">
                        <div class="pouce_up">
                            <img src="img/pouce_up.png" alt=""/>
                            <p>nb pouces up<!-- a recuperer de la DB --></p>
                        </div>
                        <div class="pouce_down">
                            <img src="img/pouce_down.png" alt=""/>
                            <p>nb pouces down<!-- a recuperer de la DB --></p>
                        </div>
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
