<?php
session_start();

include('../config/config.php');
include('../lib/bdd.lib.php');

$vue ='login.phtml';
$title = "Connexion";


include('tpl/layout.phtml');