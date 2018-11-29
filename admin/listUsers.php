<?php
session_start();
include('../config/config.php');
include('../lib/bdd.lib.php');

userIsConnected();

$vue='listUsers.phtml';
$title = 'Liste des utilisateurs';
//$activeMenu='clients';

try
{
 
    $dbh = connexion();

    /**2 : Prépare ma requête SQL */
    $sth = $dbh->prepare('SELECT * FROM blog_user ORDER BY user_id');

    /** 3 : executer la requête */
    $sth->execute();

    /** 4 : recupérer les résultats */
    $users = $sth->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e)
{
    $vue = 'erreur.phtml';
    //Si une exception est envoyée par PDO (exemple : serveur de BDD innaccessible) on arrive ici
    $messageErreur = 'Une erreur de connexion a eu lieu :'.$e->getMessage();
}


include('tpl/layout.phtml');