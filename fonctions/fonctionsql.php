<?php
//faire un fichier par usage plutot qu'un global
function getactors() {
    require('db/connexion.php');
    $listactor = $db->query('SELECT * FROM actor');
    $actors = $listactor->fetchAll();
    return $actors;
}

function getuser($username) {
    require('db/connexion.php'); //a sup partout
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE username = ?');
    $req->execute(array($username));
    $user = $req->fetch();
    return $user;
}

function getanswer($answer, $username) {
    require('db/connexion.php');
    $req = $db->prepare('SELECT id, lastname, firstname, username, password, question, answer FROM user WHERE answer = :answer AND username = ?'); //a corriger partout =:
    $req->execute(array($answer, $username)); // faire comme ligne 43
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
    $req->execute(array($newusername, $username));
}
function updatelastname($newLastname, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE gbaf_member SET lastname = ? WHERE username = ?');
    $req->execute(array($newlastname, $username));
}

function updatefirstname($newFirstname, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE gbaf_member SET firstname = ? WHERE username = ?');
    $req->execute(array($newfirstname, $username));
}

function updatequestionanswer($newQuestion, $newAnswer, $username)
{
    require('db/connexion.php');
    $req = $db->prepare('UPDATE gbaf_member SET question = ?, answer = ? WHERE username = ?');
    $req->execute(array($newquestion, $newanswer, $username));
}
?>
