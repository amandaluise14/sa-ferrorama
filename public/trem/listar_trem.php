
<?php
session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'excluido') {
    $mensagem = 'Trem excluído com sucesso!';
    $tipoMensagem = 'success';

} elseif (isset($_GET['erro'])) {

    if ($_GET['erro'] === 'nao_encontrado') {
        $mensagem = 'O trem não foi encontrado.';

    } elseif ($_GET['erro'] === 'possui_usuarios') {
        $mensagem = 'Não foi possível excluir! Este trem possui usuários vinculados.';

    } else {
        $mensagem = 'Erro ao excluir o trem. Tente novamente.';
    }

    $tipoMensagem = 'danger';
}

// PESQUISA DE TRENS

$pesquisa = $_GET['pesquisa'] ?? '';

$sql = "SELECT trens.*, usuarios.nome AS nome_usuario
        FROM trens
        LEFT JOIN usuarios
        ON trens.usuario_id = usuarios.id_usuario
        WHERE trens.modelo LIKE ?
        OR trens.velocidade LIKE ?
        OR CAST(trens.linha AS CHAR) LIKE ?
        OR trens.carga LIKE ?
        OR usuarios.nome LIKE ?";

$stmt = $conn->prepare($sql);

$busca = "%$pesquisa%";

$stmt->bind_param("sssss", $busca, $busca, $busca, $busca, $busca);

$stmt->execute();

$trens = $stmt->get_result();

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

    <title>Listagem de Trens</title>
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
                    <li><i class="bi bi-house-fill"></i> Início</li>
                </a>

                <a href="../usuario/adicionar_usuario.php" class="menu-link">
                    <li><i class="bi bi-person-plus"></i> Adicionar usuário</li>
                </a>

                 <a href="../rota/adicionar_rota.php" class="menu-link">
                    <li><i class="bi bi-signpost-2"></i> Rotas</li>
                </a>

                 <a href="../trem/adicionar_trem.php" class="menu-link">
                    <li><i class="bi bi-train-front"></i> Trens</li>
                </a>

                 <a href="../sensor/adicionar_sensor.php" class="menu-link">
                    <li><i class="bi bi-broadcast-pin"></i> Sensores</li>
                </a>


            <?php endif; ?>

            <a href="../pagina_monitoramento.php" class="menu-link">
                <li><i class="bi bi-graph-up"></i> Monitoramento</li>
            </a>
            <br>
            <a href="../logout.php" class="menu-link">
                <li><i class="bi bi-box-arrow-right"></i> Sair</li>
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
                    Visualizar Trens
                </h2>

                <p class="descricao-listagem">
                    Consulte e gerencie os trens cadastrados no sistema Info Trem.
                </p>

                <!-- BARRA DE PESQUISA -->

                <form method="GET" class="pesquisa-sensores-layout">

                    <input
                        type="text"
                        name="pesquisa"
                        class="pesquisa-sensores-input"
                        placeholder="Pesquisar trens..."
                        value="<?= htmlspecialchars($pesquisa) ?>"
                    >

                    <button type="submit" class="pesquisa-sensores-btn">
                        <i class="bi bi-search"></i>
                        Pesquisar
                    </button>

                </form>

                <!-- TABELA DE TRENS -->

                <div class="cartao-listagem">

                    <div class="table-responsive">

                        <table class="tabela">

                            <thead>

                                <tr class="cabecalho-tabela">
                                    <th>ID</th>
                                    <th>Modelo</th>
                                    <th>Velocidade</th>
                                    <th>Linha</th>
                                    <th>Carga</th>
                                    <th>Usuário</th>
                                    <th>Ações</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if ($trens->num_rows > 0): ?>

                                    <?php while ($trem = $trens->fetch_assoc()): ?>

                                        <tr>

                                            <td><?= $trem['id_trem']; ?></td>

                                            <td><?= htmlspecialchars($trem['modelo']); ?></td>

                                            <td><?= htmlspecialchars($trem['velocidade']); ?></td>

                                            <td><?= htmlspecialchars($trem['linha']); ?></td>

                                            <td><?= htmlspecialchars($trem['carga']); ?></td>

                                            <td>
                                                <?= htmlspecialchars($trem['nome_usuario'] ?? 'Não vinculado'); ?>
                                            </td>

                                            <td>

                                                <button class="editar acao-tooltip"
                                                    data-tooltip="Editar"
                                                    type="button"
                                                    onclick="window.location.href='editar_trem.php?id_trem=<?= (int) $trem['id_trem']; ?>'">

                                                    <i class="bi bi-pencil"></i>

                                                </button>

                                                <button class="excluir acao-tooltip"
                                                    data-tooltip="Excluir"
                                                    type="button"
                                                    onclick="if (confirm('Tem certeza que deseja excluir este trem?')) {
                                                        window.location.href='excluir_trem.php?id_trem=<?= (int) $trem['id_trem']; ?>';
                                                    }">

                                                    <i class="bi bi-person-dash-fill"></i>

                                                </button>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="7">
                                            Nenhum trem encontrado.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                    <button class="botaoVisualizar" type="button"
                        onclick="window.location.href='adicionar_trem.php';">

                        + Novo Trem

                    </button>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
