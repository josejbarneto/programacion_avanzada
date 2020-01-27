<?php

if (!isset($_SESSION)) {
    session_start();
}
    
if (!isset($_SESSION['usuario'])) {
    include_once("header2.php");
} else {
    include_once("header.php");
    $user = $_SESSION['usuario'];
    $preferencias = $_SESSION['preferencias'];
}

