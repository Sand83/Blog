<?php
include('config/config.php');
include('lib/bdd.lib.php');


$vue='orders.phtml';
$title = 'Mes commandes';
$activeMenu='orders';

/** On essaie de se connecter et de faire notre requête
 * Principe des exception en programmation
 * Je vous expliquerai tout ça mais vous pouvez déjà lire ceci :
 * https://www.pierre-giraud.com/php-mysql/cours-complet/php-exceptions.php
 * http://php.net/manual/fr/language.exceptions.php
 * 
 */

try
{
    /** 1 : connexion au serveur de BDD - SGBDR */
    $dbh = connexion();

    /** 2 : Prépare ma requête SQL */
    $sth = $dbh->prepare('SELECT * FROM orders');

    /** 3 : executer la requête */
    $sth->execute();

    /** 4 : recupérer les résultats */
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
    $vue = 'erreur.phtml';
    //Si une exception est envoyée par PDO (exemple : serveur de BDD innaccessible) on arrive ici
    $messageErreur =  'Une erreur de connexion a eu lieu :'.$e->getMessage();
}
catch (Exception $e)
{
    $vue = 'erreur.phtml';
    $messageErreur =  'Tu as lancé une exception : '.$e->getMessage();
}


/** On inclu la vue pour afficher les résultats */
include('tpl/layout.phtml');