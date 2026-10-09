<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'administrador') {
    
}