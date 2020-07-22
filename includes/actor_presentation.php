<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
require('db/connection.php');
$user = getUser($_SESSION['username']);
$commentExist = getCommentExist($_GET['id_actor'],$user['id']);
$voteExist = getVoteExist($_GET['id_actor'],$user['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['actor_post'] == 'comment') {
        $comment = htmlspecialchars($_POST['comment']);
        $idActor = $_POST['idActor'];
        $errors = 0;
        if(!empty($commentExist)) {
            $errors++;
            $errorComment = "Vous avez déjà écrit un commentaire ici";
        }
        if (empty($comment) OR strlen($comment) > 500) {
            $errors++;
            $errorComment = "vide ou trop long";
        }
        if ($errors === 0) {
        insertComment($comment, $idActor, $user['id']);
        $commentExist = getCommentExist($_GET['id_actor'],$user['id']);
        }
    }
    if ($_POST['actor_post'] == 'vote') {
        $like = $_POST['up'];
        $dislike = $_POST['down'];
        $idActor = $_POST['idActor'];
        if (isset($like)) {
        $vote = 1;
        }
        if (isset($dislike)) {
        $vote = 0;
        }
        insertLike($vote, $idActor, $user['id']);
        $voteExist = getVoteExist($_GET['id_actor'],$user['id']);
    }
}
$actor = getActor($_GET['id_actor']);
$pageTitle = $actor['name'];
$like = getLikeByActor($_GET['id_actor']);
$dislike = getDislikeByActor($_GET['id_actor']);
$listComment = getComment($_GET['id_actor']);
$comments = $listComment->fetchAll();
$listVotes = getVoteByActor($_GET['id_actor']);
$votes = $listVotes->fetchAll();
$votesByActor = [];
foreach ($votes as $vote) {
    $votesByActor += [$vote['user_id'] => $vote['vote']];
}
?>

<?php include("includes/header.php"); ?>
    <body>
        <main>
            <section id="presentation_acteur">
                <div class="logo_page_acteur">
                    <img src="<?= 'img' . DIRECTORY_SEPARATOR . $actor['filename']; ?>" alt="logo de l'acteur"/>
                </div>
                <div class="description_page_acteur">
                    <h2><?= $actor['name']; ?></h2>
                    <p><?= $actor['description']; ?></p>
                </div>
                <div class="like">
                    <img src="img/like.png" alt="like" />  <?= $like['nb_vote']; ?></span>
                    <img src="img/dislike.png" alt="dislike" /> <?= $dislike['nb_vote']; ?></span>
                </div>
            </section>
            <section id="sectionComment">
                <?php if (empty($voteExist)) { ?>
                    <div class="buttonLike">
                        <form method="post">
                            <input type="hidden" name="actor_post" value="vote" />
                            <input type="hidden" name="idActor" value="<?= $_GET['id_actor'] ?>" />
                            <button type="submit" name="up"><img src="img/like.png" alt="like" /> </button>
                            <button type="submit" name="down"><img src="img/dislike.png" alt="dislike" /></button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="newComment">
                        <p><strong> Vous avez déjà voté pour cet acteur </strong></p>
                    </div>
                <?php }
                if (empty($commentExist)) { ?>
                    <div class="newComment">
                        <h3>Mon commentaire</h3>
                        <div class="form_newComment">
                            <div>
                                <form method="post">
                                    <input type="hidden" name="actor_post" value="comment" />
                                    <input type="hidden" name="idActor" value="<?= $_GET['id_actor'] ?>" />
                                    <p><textarea name="comment" rows="4" cols="100" placeholder="Votre commentaire"><?= isset($comment) ? $comment : '' ?></textarea></p>
                                    <p class="error"><?= isset($errorComment) ? $errorComment : '' ?></p>
                                    <input type="submit" value="Envoyer" />
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="newComment">
                        <p><strong> Vous avez déjà commenté cet acteur </strong></p>
                    </div>
                <?php }?>
                <div>
                    <h2>Commentaires</h2>
                    <?php foreach ($comments AS $comment) : ?>
                    <div class="commentaires">
                        <div class="head_comment">
                            <div>
                                <p class="firstname"><strong>Posté par : </strong><?= $comment['firstname'] ?></p>
                                <p class="created_at"><strong>Posté le : </strong><?= $comment['created_at_fr'] ?></p>
                            </div>
                            <?php if ($votesByActor[$comment['id']] === '1') : ?>
                                <p><img src="img/like.png" alt="like" /> </p>
                            <?php elseif ($votesByActor[$comment['id']] === '0') : ?>
                                <p><img src="img/dislike.png" alt="dislike" /></p>
                            <?php endif; ?>
                        </div>
                        <p class="comment"><strong>Commentaire :</strong> </br><?= $comment['comment']; ?></p>
                    </div>
                <?php endforeach; ?>
                </div>
            </section>
        </main>

    <?php include("includes/footer.php"); ?>
