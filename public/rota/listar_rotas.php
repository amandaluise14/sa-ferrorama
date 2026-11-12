
<?php

session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// Mensagens de sucesso e erro
$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'excluido') {
    $mensagem = 'Rota excluída com sucesso!';
    $tipoMensagem = 'success';

} elseif (isset($_GET['erro'])) {

    if ($_GET['erro'] === 'nao_encontrado') {
        $mensagem = 'A rota não foi encontrada.';

    } elseif ($_GET['erro'] === 'possui_trem') {
        $mensagem = 'Não foi possível excluir! Esta rota possui um trem vinculado.';

    } else {
        $mensagem = 'Erro ao excluir a rota. Tente novamente.';
    }

    $tipoMensagem = 'danger';
}

// PESQUISA DE ROTAS

$pesquisa = $_GET['pesquisa'] ?? '';

$sql = "SELECT * FROM rotas
        WHERE estacao_origem LIKE ?
        OR estacao_destino LIKE ?
        OR distancia_total LIKE ?
        OR descricao LIKE ?
        OR CAST(duracao AS CHAR) LIKE ?
        OR CAST(trem_id AS CHAR) LIKE ?
        ORDER BY id_rota";

$stmt = $conn->prepare($sql);

$busca = "%$pesquisa%";

$stmt->bind_param(
    "ssssss",
    $busca,
    $busca,
    $busca,
    $busca,
    $busca,
    $busca
);

$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">

    <title>Listagem de Rotas</title>
</head>

<body class="pagina-listagem">

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

        <div class="formulario-container">

            <?php if (!empty($mensagem)): ?>

                <div class="alert alert-<?= $tipoMensagem ?> alert-dismissible fade show
                    position-fixed top-0 start-50 translate-middle-x mt-3"
                    role="alert"
                    style="z-index: 1055; width: 90%; max-width: 500px;">

                    <?php if ($tipoMensagem === 'success'): ?>
                        <strong>✅ Sucesso!</strong>
                    <?php else: ?>
                        <strong>⚠️ Atenção!</strong>
                    <?php endif; ?>

                    <?= htmlspecialchars($mensagem) ?>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fechar">
                    </button>

                </div>

            <?php endif; ?>

            <div class="forms_sensores">

                <h2 id="titulo-admin">
                    Visualizar Rotas
                </h2>

                <p class="descricao-listagem">
                    Consulte e gerencie as rotas cadastradas no sistema Info Trem.
                </p>

                <!-- BARRA DE PESQUISA -->

                <form method="GET" class="pesquisa-sensores-layout">

                    <input
                        type="text"
                        name="pesquisa"
                        class="pesquisa-sensores-input"
                        placeholder="Pesquisar rotas..."
                        value="<?= htmlspecialchars($pesquisa) ?>"
                    >

                    <button type="submit" class="pesquisa-sensores-btn">
                        <i class="bi bi-search"></i>
                        Pesquisar
                    </button>

                </form>

                <!-- TABELA DE ROTAS -->

                <div class="cartao-listagem">

                    <div class="table-responsive">

                        <table class="tabela">

                            <thead>
                                <tr class="cabecalho-tabela">
                                    <th>ID</th>
                                    <th>Estação de Origem</th>
                                    <th>Estação de Destino</th>
                                    <th>Distância</th>
                                    <th>Descrição</th>
                                    <th>Tempo Estimado</th>
                                    <th>Trem vinculado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if ($resultado->num_rows > 0): ?>

                                    <?php while ($rota = $resultado->fetch_assoc()): ?>

                                        <tr>

                                            <td><?= $rota['id_rota']; ?></td>

                                            <td><?= htmlspecialchars($rota['estacao_origem']); ?></td>

                                            <td><?= htmlspecialchars($rota['estacao_destino']); ?></td>

                                            <td><?= htmlspecialchars($rota['distancia_total']); ?></td>

                                            <td><?= htmlspecialchars($rota['descricao']); ?></td>

                                            <td><?= htmlspecialchars($rota['duracao']); ?></td>

                                            <td><?= htmlspecialchars($rota['trem_id'] ?? 'Não vinculado'); ?></td>

                                            <td>

                                                <button class="editar acao-tooltip"
                                                    data-tooltip="Editar"
                                                    type="button"
                                                    onclick="window.location.href='editar_rota.php?id_rota=<?= (int) $rota['id_rota']; ?>'">

                                                    <i class="bi bi-pencil"></i>

                                                </button>

                                                <button class="excluir acao-tooltip"
                                                    data-tooltip="Excluir"
                                                    type="button"
                                                    onclick="if (confirm('Tem certeza que deseja excluir esta rota?')) {
                                                        window.location.href='excluir_rota.php?id_rota=<?= (int) $rota['id_rota']; ?>';
                                                    }">

                                                    <i class="bi bi-person-dash-fill"></i>

                                                </button>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="8">
                                            Nenhuma rota encontrada.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                    <button class="botaoVisualizar" type="button"
                        onclick="window.location.href='adicionar_rota.php';">

                        + Nova Rota

                    </button>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
