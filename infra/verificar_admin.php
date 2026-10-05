<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['cargo'] !== 'administrador') {
    header("Location: ../pagina_monitoramento.php");
    exit;
}