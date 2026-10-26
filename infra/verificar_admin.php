<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'administrador') {
    //header("Location: ../index.php");
    //exit;
}

$caminhoAtual = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$posPublic = strpos($caminhoAtual, '/public/');

if ($posPublic !== false) {
    $caminhoBase = substr($caminhoAtual, 0, $posPublic);
} else {
    $caminhoBase = '';
}

$origem = $_SERVER['HTTP_REFERER'] ?? '';
$hostOrigem = parse_url($origem, PHP_URL_HOST);
$hostAtual = explode(':', $_SERVER['HTTP_HOST'] ?? '')[0];

if (
    empty($origem) ||
    empty($hostOrigem) ||
    strcasecmp($hostOrigem, $hostAtual) !== 0
) {
    header("Location: " . $caminhoBase . "/public/login.php");
    exit;
}

?>