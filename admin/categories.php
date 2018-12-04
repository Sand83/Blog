<?php
session_start();

include('../config/config.php');
include('../lib/bdd.lib.php');

userIsConnected();

$vue='categories.phtml';
$title = "Catégories";
//$activeMenu='clients';
$categorie =[
    'cat_name'=> ''
];

$error = [];

try
{
    if(array_key_exists('nomCategorie',$_GET)){

        if(!isset($_GET['nomCategorie']) || $_GET['nomCategorie']==''){
            $error[] = 'Remplir le champ catégorie';
        }else{
            $categorie['cat_name'] = $_POST['nomCategorie'];
        }

        if(empty($error)){
            $dbh = connexion();

            $sth = $dbh->prepare('INSERT INTO blog_categories (cat_id, cat_name) VALUES (NULL, :cat_name)');

            $sth->execute($categorie);


            $sth = $dbh->prepare('SELECT * FROM blog_categories ORDER BY cat_id');
        
            $sth->execute();
        
            $cats = $sth->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    $dbh = connexion();

    $sth = $dbh->prepare('SELECT * FROM blog_categories ORDER BY cat_id');
    
    $sth->execute();
    
    $cats = $sth->fetchAll(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
    $error[]= 'Une erreur de connexion a eu lieu :'.$e->getMessage();
}

include('tpl/layout.phtml');