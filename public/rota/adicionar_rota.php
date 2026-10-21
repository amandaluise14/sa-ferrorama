
<?php

session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $trem_id = (int) $_POST['trem_id'];

    $sql = "INSERT INTO rotas
        (nome, descricao, distancia_total, estacao_origem, estacao_destino, duracao, trem_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssi",
        $nome,
        $descricao,
        $distancia_total,
        $estacao_origem,
        $estacao_destino,
        $duracao,
        $trem_id
    );

    if ($stmt->execute()) {
        $mensagem = "Nova rota cadastrada com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar rota: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT id_trem, modelo FROM trens";
$trens = $conn->query($sql);

if (!$trens) {
    die("Erro ao consultar os trens: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Rota</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>

<div class="pagina">

    <div class="sidebar">

        <div class="logo">
            <img id="imagem_logo"
                 src="../../assets/image/logo_png_branca.png"
                 alt="Logo Info Trem">
        </div>

        <ul>

            <?php if ($_SESSION['cargo'] === 'administrador'): ?>

                <a href="../pagina_home.php" class="menu-link">
                    <li>Início</li>
                </a>

                <a href="../pagina_relatorios.php" class="menu-link">
                    <li>Relatórios</li>
                </a>

                <a href="../usuario/adicionar_usuario.php" class="menu-link">
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
 <title>Cadastar Rota </title>
      <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Cadastrar Rota</h2>
            <div class="conteudo">

        <?php if ($mensagem !== ''): ?>
            <p><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <form method="POST">

            <label>Nome:</label>
            <input type="text" name="nome" required>
            <br><br>

            <label>Estação de Origem:</label>
            <input type="text" name="estacao_origem" required>
            <br><br>

            <label>Estação de Destino:</label>
            <input type="text" name="estacao_destino" required>
            <br><br>

            <label>Distância total:</label>
            <input type="text" name="distancia_total" required>
            <br><br>

            <label>Descrição:</label>
            <textarea name="descricao" required></textarea>
            <br><br>

            <label>Tempo previsto ou duração:</label>
            <input type="text" name="duracao" required>
            <br><br>

            <label>Selecione o Trem Vinculado:</label>

            <select name="trem_id" required>
                <option value="">Selecione o trem</option>

                <?php while ($trem = $trens->fetch_assoc()): ?>

                    <option value="<?php echo $trem['id_trem']; ?>">
                        <?php echo htmlspecialchars($trem['modelo']); ?>
                    </option>

                <?php endwhile; ?>

            </select>

            <br><br>

        <button id="botaoCadastro" type="submit">Cadastrar Rota</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
   <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';">Visualizar Rotas Cadastradas</button>

        </form>

    </div>

</div>

</body>
</html>
