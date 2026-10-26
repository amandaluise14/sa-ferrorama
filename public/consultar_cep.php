<?php

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['cep'])) {
    echo json_encode(['error' => 'CEP não fornecido']);
    exit;
}

$cep = preg_replace('/\D/', '', $_GET['cep']);

if (strlen($cep) != 8) {
    echo json_encode(['erro' => 'CEP inválido']);
    exit;
}

$url = "https://viacep.com.br/ws/$cep/json/";

$resposta = @file_get_contents($url);

if ($resposta === false) {
    echo json_encode([
        'erro' => 'Não foi possível consultar o CEP'
    ]);
    exit;
}

$dados = json_decode($resposta, true);

if (isset($dados['erro'])) {
    echo json_encode(['erro' => 'CEP não encontrado']);
    exit;
}

echo json_encode($dados);

?>