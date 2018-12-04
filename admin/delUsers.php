<?php
session_start();
include('../config/config.php');
include('../lib/bdd.lib.php');

userIsConnected();

$vue='listUsers.phtml';
$title = 'Liste des utilisateurs';
try
{
    $delete = $_POST[''];

    $dbh = connexion();

    $sth = $dbh->prepare('DELETE FROM blog_user WHERE user_id = ?');

    $sth->execute();

    $delete = $sth->fetch(PDO::FETCH_ASSOC);
    header('Location:listUsers.php');
}
catch (PDOException $e)
{
    $messageErreur =  'Une erreur de connexion a eu lieu :'.$e->getMessage();
}
/** On inclu la vue pour afficher les résultats */
include('tpl/layout.phtml');