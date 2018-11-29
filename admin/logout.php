<?php
session_start();

include('../config/config.php');
include('../lib/bdd.lib.php');

if($_POST = true){
    $_SESSION['connect'] = false;
    $_SESSION['user'] = '';
    unset($_SESSION['connect']);
    unset($_SESSION['user']);
    header('Location:login.php');
}

include('tpl/layout.phtml');