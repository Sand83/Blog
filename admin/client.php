<?php
include('config/config.php');
include('lib/bdd.lib.php');


$vue='client.phtml';
$title = 'Fiche client';
$activeMenu='clients';

try
{
    /** On envoi une exception si l'id n'est pas pasé dans la chaine de requête
     * Le reste des ligne du bloc try ne sera pas executé
     * On va directement au bloc catch
     */
    if(!array_key_exists('id',$_GET))
        throw new Exception('Tu fais quoi ici ?');

    $customerNumber = $_GET['id'];

    /** 1 : connexion au serveur de BDD - SGBDR */
    $dbh = connexion();

    /**2 : Prépare ma requête SQL */
    $sth = $dbh->prepare('SELECT * FROM customers WHERE customerNumber = ?');

    /** 3 : executer la requête */
    $sth->execute(array($customerNumber));

    /** 4 : recupérer les résultats 
     * On utilise FETCH car un seul résultat attendu
    */
    $result = $sth->fetch(PDO::FETCH_ASSOC);


    /** On va maintenant récupérer toutes les commandes du 
     * client en faisant une nouvelle requête 
     * On est déjà connecté donc inutile de se reconnecter au serveur
     * On commence à l'étape 2 
    */
    /**2 : Prépare ma requête SQL */
    $sth = $dbh->prepare('SELECT * FROM orders WHERE customerNumber = ?');
    /** 3 : executer la requête */
    $sth->execute(array($customerNumber));
    /** 4 : recupérer les résultats */
    $cmds = $sth->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e)
{
    $vue = 'erreur.phtml';
    //Si une exception est envoyée par PDO (exemple : serveur de BDD innaccessible) on arrive ici
    $messageErreur = 'Une erreur de connexion a eu lieu :'.$e->getMessage();
}
catch(Exception $e)
{
    $vue = 'erreur.phtml';
    //Si une exception est envoyée
    $messageErreur =  'Erreur dans la page :'.$e->getMessage();
}



include('tpl/layout.phtml');

