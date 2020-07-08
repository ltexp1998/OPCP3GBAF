<?php

function getactors() {
    require('db/connexion.php');
    $listactor = $db->query('SELECT * FROM actor');
    $actors = $listactor->fetchAll();
    return $actors;
}

function getuser($username) {
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE username = ?');
    $req->execute(array($username));
    $user = $req->fetch();
    return $user;
}

function getanswer($answer, $username) {
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE answer = ? AND username = ?');
    $req->execute(array($answer, $username));
    $answer = $req->fetch();
    return $answer;
}

function getactor($idactor) {
    require('db/connexion.php');
    $actorinfo = $db->prepare('SELECT * FROM actor WHERE id = ?');
    $actorinfo->execute(array($idactor));
    $actor = $actorinfo->fetch();
    return $actor;
}

function createnewuser($lastname, $firstname, $username, $pass_hache, $question, $answer) {
    require('db/connexion.php');
    $req = $db->prepare('INSERT INTO user(lastname, firstname, username, password, question, answer) VALUES(:lastname, :firstname, :username, :password, :question, :answer)');
    $req->execute(array(
        'lastname'=> $lastname,
        'firstname' => $firstname,
        'username' => $username,
        'password' => $pass_hache,
        'question' => $question,
        'answer' => $answer));
}

function updatepass($pass_hache, $username) {
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET password = ? WHERE username = ?');
    $req->execute(array($pass_hache, $username));
}

function updateusername($newusername, $username) {
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET username = ? WHERE username = ?');
    $req->execute(array($newUsername, $username));
}
?>
