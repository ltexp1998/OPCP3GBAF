<?php // requêtes SQL

function getUser($username)
{
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE username = ?');
    $req->execute(array($username));
    $user = $req->fetch();
    return $user;
}

function getActors()
{
    require('db/connexion.php');
    $listActor = $db->query('SELECT * FROM actor');
    $actors = $listActor->fetchAll();
    return $actors;
}

function getAnswer($answer, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE answer = ? AND username = ?');
    $req->execute(array($answer, $username));
    $answer = $req->fetch();
    return $answer;
}

function getActor($idActor)
{
    require('db/connexion.php');
    $actorInfo = $db->prepare('SELECT * FROM actor WHERE id = ?');
    $actorInfo->execute(array($idActor));
    $actor = $actorInfo->fetch();
    return $actor;
}

function createNewuser($lastname, $firstname, $username, $pass_hache, $question, $answer)
{
    require('db/connexion.php');
    $req = $db->prepare('INSERT INTO user(lastname, firstname, username, password, question, answer) VALUES(:lastname, :firstname, :username, :password, :question, :answer)');
    $req->execute(array(
        'lastname'=> $lastname,
        'firstname' => $firstname,
        'username' => $username,
        'password' => $pass_hache,
        'question' => $question,
        'answer' => $answer
    ));
}

function updatePass($pass_hache, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET password = ? WHERE username = ?');
    $req->execute(array($pass_hache, $username));
}

function updateUsername($newUsername, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET username = ? WHERE username = ?');
    $req->execute(array($newUsername, $username));
}

function updateLastname($newLastname, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET lastname = ? WHERE username = ?');
    $req->execute(array($newLastname, $username));
}

function updateFirstname($newFirstname, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET firstname = ? WHERE username = ?');
    $req->execute(array($newFirstname, $username));
}

function updateQuestionAnswer($newQuestion, $newAnswer, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET question = ?, answer = ? WHERE username = ?');
    $req->execute(array($newQuestion, $newAnswer, $username));
}

function getComment($id_actor)
{
    require('db/connexion.php');
    $listComment = $db->prepare('SELECT comment.comment, DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%imin%ss\') AS date_add_fr, user.firstname, user.id FROM comment
        LEFT JOIN user ON comment.user_id = user.id
        WHERE comment.actor_id = ? ORDER BY comment.date_add DESC');
    $listComment->execute(array($id_actor));
    return $listComment;
}

function getVoteByActor($îd_actor)
{
    require('db/connexion.php');
    $listVotes = $db->prepare('SELECT * FROM vote WHERE actor_id= ?');
    $listVotes->execute(array($îd_actor));
    return $listVotes;
}

function getLikeByActor($id_actor)
{
    require('db/connexion.php');
    $req = $db->prepare('SELECT COUNT(vote.vote) AS nb_vote FROM vote WHERE actor_id = ? AND vote = 1');
    $req->execute(array($id_actor));
    $like = $req->fetch();
    return $like;
}

function getDislikeByActor($id_actor)
{
    require('db/connexion.php');
    $req = $db->prepare('SELECT COUNT(vote.vote) AS nb_vote FROM vote WHERE actor_id = ? AND vote = 0');
    $req->execute(array($id_actor));
    $dislike = $req->fetch();
    return $dislike;
}

function getLikes()
{
    require('db/connexion.php');
    $listLikes = $db->query('SELECT COUNT(*) AS nb_likes, actor_id FROM vote WHERE vote = 1 GROUP BY actor_id');
    $likes = $listLikes->fetchAll();
    return $likes;
}

function getDislikes()
{
    require('db/connexion.php');
    $listDislikes = $db->query('SELECT COUNT(*) AS nb_dislikes, actor_id FROM vote WHERE vote = 0 GROUP BY actor_id');
    $dislikes = $listDislikes->fetchAll();
    return $dislikes;
}

function getCommentExist($id_actor, $id_user)
{
    require('db/connexion.php');
    $req = $db->prepare('SELECT comment.comment FROM comment
        LEFT JOIN user ON comment.user_id = user.id
        WHERE comment.actor_id = ? AND comment.user_id = ?');
    $req->execute(array($id_actor, $id_user));
    $commentExist = $req->fetch();
    return $commentExist;
}

function getVoteExist($id_actor, $id_user)
{
    require('db/connexion.php');
    $req = $db->prepare('SELECT vote.vote FROM vote
        LEFT JOIN user ON vote.user_id = user.id
        WHERE vote.actor_id = ? AND vote.user_id = ?');
    $req->execute(array($id_actor, $id_user));
    $voteExist = $req->fetch();
    return $voteExist;
}

function insertComment($comment, $idActor, $iduser)
{
    require('db/connexion.php');
    $req = $db->prepare('INSERT INTO comment(comment, date_add, actor_id, user_id) VALUES(:comment, NOW(), :actor_id, :user_id)');
    $req->execute(array(
        'comment' => $comment,
        'actor_id' => $idActor,
        'user_id' => $iduser
    ));
}

function insertLike($vote, $idActor, $iduser)
{
    require('db/connexion.php');
    $req = $db->prepare('INSERT INTO vote(vote, actor_id, user_id) VALUES(:vote, :actor_id, :user_id)');
    $req->execute(array(
        'vote' => $vote,
        'actor_id' => $idActor,
        'user_id' => $iduser
    ));
}
