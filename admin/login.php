<?php
session_start();

include('../config/config.php');
include('../lib/bdd.lib.php');

$vue ='login.phtml';
$title = "Connexion";
$impossible = false;
try
{
    if(array_key_exists('mail',$_POST))
    {
        $userMail = $_POST['mail'];

        $dbh = connexion();

        $sth = $dbh->prepare('SELECT * FROM blog_user WHERE user_email = ?');

        $sth->execute(array($userMail));

        $verifMail = $sth->fetch(PDO::FETCH_ASSOC);


        if($verifMail != false){

            if (password_verify($_POST['pass'], $verifMail['user_password'])) {
                $_SESSION['connect'] = true;
                $_SESSION['user_id'] = $verifMail['user_id'];
                $_SESSION['user'] = [$verifMail['user_id'],$verifMail['user_nom'],$verifMail['user_prenom']];
                header('Location:addArticle.php');
            } else {
                $impossible = 'Mot de passe incorrect';
            }
        } else{
            $impossible = 'Adresse email inconnue';
        }
    } 
}
catch(PDOException $e)
{
    //Si une exception est envoyée par PDO (exemple : serveur de BDD innaccessible) on arrive ici
    $messageErreur = 'Une erreur de connexion a eu lieu :'.$e->getMessage();
}

include('tpl/layout.phtml');