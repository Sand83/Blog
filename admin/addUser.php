<?php
session_start();

include('../config/config.php');
include('../lib/bdd.lib.php');

userIsConnected();

$vue='addUser.phtml';
$title = "Formulaire d'inscription";
//$activeMenu='clients';
$recup =[
    'user_nom' =>'',
    'user_prenom' =>'',
    'user_username' =>'',
    'user_email' =>'',
    'user_password' =>'',
    'user_bio' =>''
];

$error = [];

try
{
    if(array_key_exists('nom',$_POST)){

        if(!isset($_POST['nom']) || $_POST['nom']==''){
            $error[] = 'Remplir le champ nom';
        }else{
            $recup['user_nom'] = $_POST['nom'];
        }

        if(!isset($_POST['prenom']) || $_POST['prenom']==''){
            $error[] = 'Remplir le champ prenom';
        }else{
            $recup['user_prenom'] = $_POST['prenom'];
        }
        if(!isset($_POST['pseudo']) || $_POST['pseudo']==''){
            $error[] = 'Remplir le champ pseudo';
        }else{
            $recup['user_username'] = $_POST['pseudo'];
        }

        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL )===false) {
            $error[] = 'Email pas bon';
        } else{
            $recup['user_email'] = $_POST['mail'];
        }

        if(isset($_POST['nom']) && $_POST['nom'] != '' && $_POST['pass']==$_POST['pass2']){
            $recup['user_password'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        } else{
            $error[]= 'Les mots de passe ne sont pas identiques';
        }
        $recup['user_bio'] = $_POST['bio'];

        if(empty($error)){
            $dbh = connexion();

            /**2 : Prépare ma requête SQL */
            $sth = $dbh->prepare('INSERT INTO blog_user (user_id, user_nom, user_prenom, user_username, user_email, user_password, user_bio ) 
            VALUES (NULL, :user_nom, :user_prenom, :user_username, :user_email, :user_password, :user_bio);');
        
            /** 3 : executer la requête */
            $sth->execute($recup);
        }

    }

}
catch(PDOException $e)
{
    //$vue = 'erreur.phtml';
    //Si une exception est envoyée par PDO (exemple : serveur de BDD innaccessible) on arrive ici
    $error[]= 'Une erreur de connexion a eu lieu :'.$e->getMessage();
}



include('tpl/layout.phtml');