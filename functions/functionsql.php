<?php // requêtes SQL
    require 'db/connection.php';
function getUser($username)
{
    global $bdd;
    $req = $bdd->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE username = ?');
    $req->execute([$username]);
    $user = $req->fetch();
    return $user;
}

function getActors()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM actor');
    $actors = $req->fetchAll(); 
    $req->closeCursor();
    return $actors;
}

function getAnswer($answer, $username)
{
    global $bdd;
    $req = $bdd->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE answer = ? AND username = ?');
    $req->execute([$answer, $username]);
    $answer = $req->fetch();
    return $answer;
}

function getActor($idActor)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM actor WHERE id = ?');
    $req->execute([$idActor]);
    $actor = $req->fetch();
    return $actor;
}

function createNewUser($lastname, $firstname, $username, $pass_hache, $question, $answer)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO user(lastname, firstname, username, password, question, answer) VALUES(:lastname, :firstname, :username, :password, :question, :answer)');
    return $req->execute([
        'lastname'=> $lastname,
        'firstname' => $firstname,
        'username' => $username,
        'password' => $pass_hache,
        'question' => $question,
        'answer' => $answer
    ]);

}

function updatePass($pass_hache, $username)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE user SET password = ? WHERE username = ?');
    return $req->execute([$pass_hache, $username]);

}

function updateUsername($newUsername, $username)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE user SET username = ? WHERE username = ?');
    return $req->execute([$newUsername, $username]);
}

function updateLastname($newLastname, $username)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE user SET lastname = ? WHERE username = ?');
    return $req->execute([$newLastname, $username]);
}

function updateFirstname($newFirstname, $username)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE user SET firstname = ? WHERE username = ?');
    return $req->execute([$newFirstname, $username]);
}

function updateQuestionAnswer($newQuestion, $newAnswer, $username)
{
    global $bdd;
    $req = $bdd->prepare('UPDATE user SET question = ?, answer = ? WHERE username = ?');
    return $req->execute([$newQuestion, $newAnswer, $username]);
}

function getComment($id_actor)
{
    global $bdd;
    $listComment = $bdd->prepare('SELECT comment.comment, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at_fr, user.firstname, user.id FROM comment
        LEFT JOIN user ON comment.user_id = user.id
        WHERE comment.actor_id = ? ORDER BY comment.created_at DESC');
    $listComment->execute([$id_actor]);
    return $listComment;
}

function getVoteByActor($îd_actor)
{
    global $bdd;
    $listVotes = $bdd->prepare('SELECT * FROM vote WHERE actor_id= ?');
    $listVotes->execute([$îd_actor]);
    return $listVotes;
}

function getLikeByActor($id_actor)
{
    global $bdd;
    $req = $bdd->prepare('SELECT COUNT(vote.vote) AS nb_vote FROM vote WHERE actor_id = ? AND vote = 1');
    $req->execute([$id_actor]);
    $like = $req->fetch();
    return $like;
}

function getDislikeByActor($id_actor)
{
    global $bdd;
    $req = $bdd->prepare('SELECT COUNT(vote.vote) AS nb_vote FROM vote WHERE actor_id = ? AND vote = 0');
    $req->execute([$id_actor]);
    $dislike = $req->fetch();
    return $dislike;
}

function getLikes()
{
    global $bdd;
    $req = $bdd->query('SELECT COUNT(*) AS nb_likes, actor_id FROM vote WHERE vote = 1 GROUP BY actor_id');
    $likes = $req->fetchAll();
    return $likes;
}

function getDislikes()
{
    global $bdd;
    $req = $bdd->query('SELECT COUNT(*) AS nb_dislikes, actor_id FROM vote WHERE vote = 0 GROUP BY actor_id');
    $dislikes = $req->fetchAll();
    return $dislikes;
}

function getCommentExist($id_actor, $id_user)
{
    global $bdd;
    $req = $bdd->prepare('SELECT comment.comment FROM comment
        LEFT JOIN user ON comment.user_id = user.id
        WHERE comment.actor_id = ? AND comment.user_id = ?');
    $req->execute([$id_actor, $id_user]);
    $commentExist = $req->fetch();
    return $commentExist;
}

function getVoteExist($id_actor, $id_user)
{
    global $bdd;
    $req = $bdd->prepare('SELECT vote.vote FROM vote
        LEFT JOIN user ON vote.user_id = user.id
        WHERE vote.actor_id = ? AND vote.user_id = ?');
    $req->execute([$id_actor, $id_user]);
    $voteExist = $req->fetch();
    return $voteExist;
}

function insertComment($comment, $idActor, $iduser)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO comment(comment, created_at, actor_id, user_id) VALUES(:comment, NOW(), :actor_id, :user_id)');
    return $req->execute([
        'comment' => $comment,
        'actor_id' => $idActor,
        'user_id' => $iduser
    ]);
}

function insertLike($vote, $idActor, $iduser)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO vote(vote, actor_id, user_id) VALUES(:vote, :actor_id, :user_id)');
    return $req->execute([
        'vote' => $vote,
        'actor_id' => $idActor,
        'user_id' => $iduser
    ]);
}
