
<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'excluido') {
    $mensagem = 'Sensor excluído com sucesso!';
    $tipoMensagem = 'success';

} elseif (isset($_GET['erro'])) {

    if ($_GET['erro'] === 'nao_encontrado') {
        $mensagem = 'O sensor não foi encontrado.';

    } elseif ($_GET['erro'] === 'em_rota') {
        $mensagem = 'Não foi possível excluir! Este sensor está vinculado a uma rota.';

    } else {
        $mensagem = 'Erro ao excluir o sensor. Tente novamente.';
    }

    $tipoMensagem = 'danger';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">

    <title>Listagem de sensores</title>

</head>

<body class="pagina-listagem">

    <div class="pagina">
        <div class="sidebar">

            <div class="logo">
                <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
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

                <!-- Aparece para administrador e usuário comum -->
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

    <form method="GET" class="forms_sensores">

    <h2 id="titulo-admin">
        Visualizar Sensores
    </h2>

    <p class="descricao-listagem">
        Consulte e gerencie os sensores cadastrados no sistema Info Trem.
    </p>

    <div class="pesquisa-sensores-layout">
        <input
            type="text"
            name="pesquisa"
            class="pesquisa-sensores-input"
            placeholder="Pesquisar sensores..."
            value="<?= htmlspecialchars($_GET['pesquisa'] ?? '') ?>"
        >

        <button type="submit" class="pesquisa-sensores-btn">
            <i class="bi bi-search"></i>
            Pesquisar
        </button>
    </div>

</form>

            <div class="cartao-listagem">
 

                        <div class="table-responsive">

                            <table class="tabela">

                            <thead>
                            <tr class="cabecalho-tabela">
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Rota vinculada</th>
                                <th>Descrição da Localização</th>
                                <th>Dado Monitorado</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                                <?php

                               $pesquisa = $_GET['pesquisa'] ?? '';

                    $sql = "SELECT sensores.*, rotas.nome AS nome_rota
                    FROM sensores
                    LEFT JOIN rotas
                    ON sensores.rota_id = rotas.id_rota
                    WHERE sensores.nome LIKE ?
                    OR rotas.nome LIKE ?
                    OR sensores.descricao_localizacao LIKE ?
                    OR sensores.dado_monitorado LIKE ?";

                $stmt = $conn->prepare($sql);

                $busca = "%$pesquisa%";

                $stmt->bind_param("ssss", $busca, $busca, $busca, $busca);

                $stmt->execute();

                $sensores = $stmt->get_result();

                                while ($sensor = $sensores->fetch_assoc()) {
                                ?>

                                    <tr>
                                        <td><?php echo $sensor['id_sensor']; ?></td>
                                        <td><?php echo $sensor['nome']; ?></td>
                                        <td><?php echo $sensor['nome_rota'] ?? 'Sem rota vinculada'; ?></td>
                                        <td><?php echo $sensor['descricao_localizacao']; ?></td>
                                        <td><?php echo $sensor['dado_monitorado']; ?></td>

                                        <td>

                                            <button class="editar acao-tooltip"
                                                data-tooltip="Editar"
                                                type="button"
                                                onclick="window.location.href='editar_sensor.php?id_sensor=<?php echo (int) $sensor['id_sensor']; ?>'">

                                                <i class="bi bi-pencil"></i>

                                            </button>

                                            <button
                                                class="excluir acao-tooltip"
                                                data-tooltip="Excluir"
                                                type="button"
                                                onclick="if (confirm('Tem certeza que deseja excluir este sensor?')) {
                                                    window.location.href='excluir_sensor.php?id_sensor=<?php echo (int) $sensor['id_sensor']; ?>';
                                                }">

                                                <i class="bi bi-person-dash-fill"></i>

                                            </button>

                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </table>

                        </div>

                    <button class="botaoVisualizar" type="button"
                    onclick="window.location.href='adicionar_sensor.php';">
                    + Novo Sensor
                </button>

                </form>

            </div>
    


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

