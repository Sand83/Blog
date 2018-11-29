<?php
session_start();

include('../config/config.php');
include('../lib/bdd.lib.php');

userIsConnected();

$vue='addArticle.phtml';
$title = "Ajouter un article";
//$activeMenu='clients';
 $article =[
     'art_title' =>'',
     'art_content' =>'',
     'art_picture' =>'vyhvgkhbggk',
     'art_tags'=>'',
     'art_date_publi' =>''
 ];
// $categorie =[
//     'cat_name' =>'',
// ];

$error = [];

try
{
    if(array_key_exists('titre',$_POST)){

        $article['art_fk_user_id'] = $_SESSION['user_id'];

        if(!isset($_POST['titre']) || $_POST['titre']==''){
            $error[] = 'Remplir le champ Titre';
        }else{
            $article['art_title'] = $_POST['titre'];
        }

        if(!isset($_POST['contenu']) || $_POST['contenu']==''){
            $error[] = 'Remplir le champ contenu';
        }else{
            $article['art_content'] = $_POST['contenu'];
        }

        $article['art_tags']= $_POST['tags'];

        if(!isset($_POST['date']) || $_POST['date']==''){           
            $error[] = 'Remplir le champ date';
        }else{
            $article['art_date_publi'] = $_POST['date']." 00:00:00";
        }
        var_dump($_FILES);
        if(empty($error)){
            $dbh = connexion();

            /**2 : Prépare ma requête SQL */
            $sth = $dbh->prepare('INSERT INTO blog_articles (art_id, art_fk_user_id, art_title, art_content, art_tags, art_picture, art_date_publi) 
            VALUES (NULL, :art_fk_user_id, :art_title, :art_content, :art_tags, :art_picture, :art_date_publi);');
        
            /** 3 : executer la requête */
            $sth->execute($article);
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