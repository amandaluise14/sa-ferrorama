<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$erro = '';
$sucesso = '';

$id_rota = $_GET['id_rota'] ?? $_POST['id_rota'] ?? '';

if ($id_rota == '') {
    die("ID da rota não fornecido.");
}

$sql = "SELECT * FROM rotas WHERE id_rota = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rota);
$stmt->execute();

$resultado = $stmt->get_result();
$rota = $resultado->fetch_assoc();
$stmt->close();

if (!$rota) {
    die("Rota não encontrada.");
}

if (isset($_POST['id_rota'])) {

    $id = $_POST['id_rota'];
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $trem_id = $_POST['trem_id'];

    $sql = "UPDATE rotas
            SET nome = ?,
                estacao_origem = ?,
                estacao_destino = ?,
                distancia_total = ?,
                descricao = ?,
                duracao = ?,
                trem_id = ?
            WHERE id_rota = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssii",
        $nome,
        $estacao_origem,
        $estacao_destino,
        $distancia_total,
        $descricao,
        $duracao,
        $trem_id,
        $id
    );

    if ($stmt->execute()) {
        $sucesso = "Rota atualizada com sucesso!";

        $sql = "SELECT * FROM rotas WHERE id_rota = ?";
        $consulta = $conn->prepare($sql);
        $consulta->bind_param("i", $id);
        $consulta->execute();

        $resultado = $consulta->get_result();
        $rota = $resultado->fetch_assoc();

        $consulta->close();

    } else {
        $erro = "Erro ao atualizar rota.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Editar Rota</title>
</head>

<body>

<div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>

            <ul>

                <?php if ($_SESSION['cargo'] === 'administrador'): ?>

                    <a href="../pagina_home.php" class="menu-link">
                        <li>Início</li>
                    </a>

                    <a href="../pagina_relatorios.php" class="menu-link">
                        <li>Relatórios</li>
                    </a>

                    <a href="adicionar_usuario.php" class="menu-link">
                        <li>Adicionar usuário</li>
                    </a>

                <?php endif; ?>

                <a href="../pagina_monitoramento.php" class="menu-link">
                    <li>Monitoramento</li>
                </a>

                <a href="../logout.php" class="menu-link">
                    <li>Sair</li>
                </a>

            </ul>
        </div>

<div class="formulario-container">
        <form method="POST" class="forms_sensores">
             <?php if (!empty($erro)): ?>
    <div class="alert alert-danger alert-dismissible fade show"
         role="alert">
        <strong>⚠️ Ops!</strong>
        <?= htmlspecialchars($erro) ?>

        <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Fechar">
        </button>
    </div>
<?php endif; ?>

<?php if (!empty($sucesso)): ?>
    <div class="alert alert-success alert-dismissible fade show"
         role="alert">
        <strong>✅ Sucesso!</strong>
        <?= htmlspecialchars($sucesso) ?>

        <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Fechar">
        </button>
    </div>
<?php endif; ?>
<input type="hidden" name="id_rota" value="<?php echo $id_rota; ?>">

            <h2 id="titulo-admin">Editar Rota</h2>
            <div class="conteudo">


            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($rota['nome']); ?>" required>
            <br><br>

            <label>Estação Origem:</label>
            <input type="text" name="estacao_origem" value="<?php echo htmlspecialchars($rota['estacao_origem']); ?>" required>
            <br><br>

            <label>Distancia total:</label>
            <input type="text" name="distancia_total" value="<?php echo htmlspecialchars($rota['distancia_total']); ?>" required>
            <br><br>

            <label>Estação Destino:</label>
            <input type="text" name="estacao_destino" value="<?php echo htmlspecialchars($rota['estacao_destino']); ?>" required>
            <br><br>

            <label>Descrição:</label>
            <textarea name="descricao" required><?php echo htmlspecialchars($rota['descricao']); ?></textarea>
            <br><br>

            <label>Tempo previsto ou duração:</label>
            <input type="time" name="duracao" value="<?php echo htmlspecialchars($rota['duracao']); ?>" required>
            <br><br>

<label>Selecione o Trem Vinculado:</label>

<select name="trem_id" required>

    <option value="">Selecione o Trem</option>

    <?php
    $sql = "SELECT id_trem, modelo FROM trens";
    $trens = $conn->query($sql);

    while ($trem = $trens->fetch_assoc()) {
    ?>

        <option value="<?php echo $trem['id_trem']; ?>"
            <?php if ($rota['trem_id'] == $trem['id_trem']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($trem['modelo']); ?>
        </option>

    <?php
    }
    ?>

</select>


            </select>

            <br><br>
                <button id="botaoCadastro" type="submit">Editar Rota</button>
                <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';">Visualizar Rotas Cadastradas</button>
                <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
            </div>
        </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>