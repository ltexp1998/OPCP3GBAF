<?php

function getActors() {
    require('db/connexion.php');
    $listActor = $db->query('SELECT * FROM actor');
    $actors = $listActor->fetchAll();
    return $actors;
}

function getUser($username) {
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE username = ?');
    $req->execute(array($username));
    $user = $req->fetch();
    return $user;
}

function getAnswer($answer, $username) {
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE answer = ? AND username = ?');
    $req->execute(array($answer, $username));
    $answer = $req->fetch();
    return $answer;
}

function getActor($idActor) {
    require('db/connexion.php');
    $actorInfo = $db->prepare('SELECT * FROM actor WHERE id = ?');
    $actorInfo->execute(array($idActor));
    $actor = $actorInfo->fetch();
    return $actor;
}

function createNewuser($lastname, $firstname, $username, $pass_hache, $question, $answer) {
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

function updatePass($pass_hache, $username) {
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET password = ? WHERE username = ?');
    $req->execute(array($pass_hache, $username));
}

function updateUsername($newUsername, $username) {
    require('db/connexion.php');
    $req = $db->prepare('UPDATE user SET username = ? WHERE username = ?');
    $req->execute(array($newUsername, $username));
}
