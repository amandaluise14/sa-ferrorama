<?php

include '../../infra/conexao.php';

if (isset($_POST['id'])) {
    $senha = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

}

$sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
