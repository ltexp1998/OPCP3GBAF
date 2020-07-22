<?php
    require_once('functions/functionsql.php');
    $pageTitle = 'Groupement Banque Assurance Français';
    $actors = getActors();
    $likes = getLikes();
    $dislikes = getDislikes();
    $likesByActor = [];
    foreach ($likes as $like) {
        $likesByActor += [$like['actor_id'] => $like['nb_likes']];
    }
    $dislikesByActor = [];
    foreach ($dislikes as $dislike) {
        $dislikesByActor += [$dislike['actor_id'] => $dislike['nb_dislikes']];
    }
    // le & qui permet d'enregistrer les modifications faites dans la fonction
    //$tableau;
    //foreach ($tableau as &$ligne) {
    //    $ligne++;
    //}

?>

    <?php include("includes/header.php"); ?>
        <main>
            <section id="presentation">
                <h1>Présentation du Groupement Banque Assurance Français</h1>
                <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération  représentant les 6 grands groupes français :</p>
                <div class="listeacteurs">
                    <ul>
                        <li>BNP Paribas ;</li>
                        <li>BPCE ;</li>
                        <li>Crédit Agricole ;</li>
                    </ul>
                    <ul>
                        <li>Crédit Mutuel-CIC ;</li>
                        <li>Société Générale ;</li>
                        <li>La Banque Postale.</li>
                    </ul>
                </div>
                <p>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.</p>
				<p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.</p>
                <p>C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
                <div id="illustration"><img src="img/illustration.jpg" alt="illustration"/></div>
            </section>
            <section id="acteurs">
                <h2>Présentation des acteurs</h2>
                <div id="conteneur_acteur">
                    <?php foreach ($actors as $actor) : ?>
                        <div class="acteur">
                            <div class="presentation_acteur">
                                <img class="logo_acteur" src="<?= 'img' . DIRECTORY_SEPARATOR . $actor['filename']; ?>" alt="logo de l'acteur">
                                <!-- DIRECTORY_SEPARATOR sert a eviter les pb de chemin lors du deploiement-->
                                <div class="description">
                                    <h3><?= $actor['name']; ?></h3>
                                    <p><?= substr($actor['description'], 0, 248) . '...'; ?></p>
                                </div>
                            </div>
                            <div class="votesButton">
                                <div class="homeVotes">
                                    <p><img src="img/like.png" alt="like" />

                                    <?= ($likesByActor[$actor['id']] == NULL) ? '0' : $likesByActor[$actor['id']]; ?>

                                    <p><img src="img/dislike.png" alt="dislike" />
                                   
                                    <?= ($dislikesByActor[$actor['id']] == NULL) ? '0' : $dislikesByActor[$actor['id']]; ?>
                                </div>
                                <a class="button" href="actor.php?id_actor=<?= $actor['id']; ?>">Lire la suite</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                </div>
            </section>
