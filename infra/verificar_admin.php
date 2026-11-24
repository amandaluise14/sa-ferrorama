<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'administrador') {
    // header("Location: login.php");
    // exit;
}


// substitui um texto por outro e guardamos na variável
$caminhoAtual = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$posPublic = strpos($caminhoAtual, '/public/');
// Vai procurar a pasta public e vai guardr a posição na variável e retorna strpos retorna false se não encontrou

// Verifica se encontrou a pasta public
if ($posPublic !== false) {
    // Vai pegar o caminho que vem antes da pasta public e usar o caminho como base 
    $caminhoBase = substr($caminhoAtual, 0, $posPublic);
} else {
    $caminhoBase = '';
    // Se não encontrar deixa o caminho vazio
}

// pega o endereço de onde o usuário veio
$origem = $_SERVER['HTTP_REFERER'] ?? '';
// O endereço do site de origem, pegar somente o endreço do site
$hostOrigem = parse_url($origem, PHP_URL_HOST);
// Pega o endereço do site atual e retira a porta, pega a primeira parte da divisão
$hostAtual = explode(':', $_SERVER['HTTP_HOST'] ?? '')[0];

if (
    empty($origem) ||
    empty($hostOrigem) ||
    strcasecmp($hostOrigem, $hostAtual) !== 0
    // essa condição verifica se o endereço de origem é diferente do endereço atual.
) {
    // Se forem diferentes, a condição será verdadeira e o código fará o redirecionamento para a página de login.
    header("Location: " . $caminhoBase . "/public/login.php");
    exit;
}

?>