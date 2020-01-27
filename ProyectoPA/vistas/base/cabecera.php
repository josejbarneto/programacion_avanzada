<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    include_once("header2.php");
    session_destroy();
} else {
    include_once("header.php");
    $user = $_SESSION['usuario'];
    $preferencias = $_SESSION['preferencias'];
}

