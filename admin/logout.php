<?php
session_start();
$_SESSION['connect'] = false;
unset($_SESSION['connect']);
header('Location:addUser.php');