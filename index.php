<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
        <title>GBAF</title>
    </head>

    <body>

        <?php include("includes/header.php"); ?>


        <main>

            <section id="presentation">
                <h1>Présentation du Groupement Banque Assurance Français</h1>
                <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération représentant les 6 grands groupes français :</p>
                <ul>
                    <li>BNP Paribas ;</li>
                    <li>BPCE ;</li>
                    <li>Crédit Agricole ;</li>
                    <li>Crédit Mutuel-CIC ;</li>
                    <li>Société Générale ;</li>
                    <li>La Banque Postale.</li>
                </ul>
				<p>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.</p>
				<p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
            </section>

                <div class="illustration">
                    <a href=""><img src="/img/illustration.jpg"/></a>
                </div>
                
            <section id="acteurs">
                <h2>Présentation des acteurs</h2>
                <div id="conteneur_acteur">
<!-- a recuperer de la DB pour creer autant d'acteurs que d'entrées dans la base avec les details-->
                    <div class="acteur">
                        <div class="presentation_acteur">
                            <img class="logo_acteur" src="img/CDE.png" alt="">
                            <div class="description">
                                <h3>CDE</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <a class="button" href="acteurs.php">Lire la suite</a>
                    </div>
<!-- a recuperer de la DB -->
                    <div class="acteur">
                        <div class="presentation_acteur">
                            <img class="logo_acteur" src="img/Dsa_france.png" alt="">
                            <div class="description">
                                <h3>DSA France</h3>
                                <p>lien Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <a class="button" href="acteurs.php">Lire la suite</a>
                    </div>

                    <div class="acteur">
                        <div class="presentation_acteur">
                            <img class="logo_acteur" src="img/formation_co.png" alt="">
                            <div class="description">
                                <h3>Formation & Co</h3>
                                <p>lien Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <a class="button" href="acteurs.php">Lire la suite</a>
                    </div>

                    <div class="acteur">
                        <div class="presentation_acteur">
                            <img class="logo_acteur" src="img/protectpeople.png" alt="">
                            <div class="description">
                                <h3>Protectpeople</h3>
                                <p>lien Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <a class="button" href="acteurs.php">Lire la suite</a>

            </section>
        </main>
        <footer>
            <?php include("includes/footer.php"); ?>
        </footer>
        </body>
</html>
