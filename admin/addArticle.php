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
     'art_picture' =>'',
     'art_tags'=>'',
     'art_date_publi' =>''
];
 $categ =[
     'blog_articles_art_id' =>'',
     'blog_categories_cat_id' =>'',
];

$error = [];

try
{
    //Récupération des catégories existantes
    $dbh = connexion();

    $sth = $dbh->prepare('SELECT * FROM blog_categories ORDER BY cat_id');

    $sth->execute();

    $categories = $sth->fetchAll(PDO::FETCH_ASSOC);

    //Récupération des données POST
    if(array_key_exists('titre',$_POST)){
        //Id user
        $article['art_fk_user_id'] = $_SESSION['user_id'];
        //Titre
        if(!isset($_POST['titre']) || $_POST['titre']==''){
            $error[] = 'Remplir le champ Titre';
        }else{
            $article['art_title'] = $_POST['titre'];
        }
        //Contenu
        if(!isset($_POST['contenu']) || $_POST['contenu']==''){
            $error[] = 'Remplir le champ contenu';
        }else{
            $article['art_content'] = $_POST['contenu'];
        }
        //Tags
        $article['art_tags']= $_POST['tags'];
        //Récupération des images

            $type = new SplFileInfo($_FILES['photo']['name']);
            $uploadDir = '../upload/image_'.$_POST['titre'].".".$type->getExtension();
            $file = $_FILES['photo']['tmp_name'];
            $article['art_picture'] = $uploadDir;
            move_uploaded_file($file, $uploadDir);

        //Date de publication
        if(!isset($_POST['date']) || $_POST['date']==''){           
            $error[] = 'Remplir le champ date';
        }else{
            $article['art_date_publi'] = $_POST['date']." 00:00:00";
        }

        //Requêtes
        if(empty($error)){
            $dbh = connexion();

            /**Requete blog_article*/
            $sth = $dbh->prepare('INSERT INTO blog_articles (art_id, art_fk_user_id, art_title, art_content, art_tags, art_picture, art_date_publi) 
            VALUES (NULL, :art_fk_user_id, :art_title, :art_content, :art_tags, :art_picture, :art_date_publi);');
        
            $sth->execute($article);

            $categ['blog_articles_art_id'] = $dbh->lastInsertId();
            $categ['blog_categories_cat_id'] = $_POST['cat'];

            /*Requête blog_articles_has_blog_categories*/
            $sth = $dbh->prepare('INSERT INTO blog_articles_has_blog_categories (blog_articles_art_id, blog_categories_cat_id) 
            VALUES (:blog_articles_art_id, :blog_categories_cat_id);');
        
            $sth->execute($categ);
            //Redirection vers la liste des articles
            header('Location:listArticles.php');
        }
    }

}
catch(PDOException $e)
{
    $error[]= 'Une erreur de connexion a eu lieu :'.$e->getMessage();
}



include('tpl/layout.phtml');