
<?php

if (!isset($_GET['id'])) {
    echo "ID do usuário não foi enviado.";
    exit;
}

$id_usuario = $_GET['id'];

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// Verifica se o usuário possui algum trem cadastrado
$sql_verifica = "SELECT COUNT(*) AS total FROM trens WHERE usuario_id = ?";
$stmt = $conn->prepare($sql_verifica);

if (!$stmt) {
    header("Location: visualizar_usuario.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();


$stmt->close();

if ($dados['total'] > 0) {
    header("Location: visualizar_usuario.php?erro=possui_trens");
    exit;
}
if ($dados['total'] > 0) {
    header("Location: visualizar_usuario.php?erro=possui_trens");
    exit;
}

$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: visualizar_usuario.php?erro=falha");
    exit;
}

$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {

        if ($_SESSION['id_usuario'] == $id_usuario) {
            session_unset();
            session_destroy();

            header("Location: ../login.php");
            exit;
        }

        header("Location: visualizar_usuario.php?sucesso=excluido");
        exit;

    } else {
        header("Location: visualizar_usuario.php?erro=nao_encontrado");
        exit;
    }
} else {
    header("Location: visualizar_usuario.php?erro=falha");
    exit;
}

$stmt->close();
exit;
?>


