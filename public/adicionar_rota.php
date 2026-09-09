<?php

include '../../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $sensor_id = $_POST['sensor_id'];

    $sql = "INSERT INTO rota (nome, estacao_origem, estacao_destino, distancia_total, sensor_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $estacao_origem, $estacao_destino, $distancia_total, $sensor_id);
    if ($stmt->execute() === TRUE) {
        echo "Nova rota cadastrada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}