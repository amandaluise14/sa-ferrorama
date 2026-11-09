
<?php

session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'excluido') {
    $mensagem = 'Rota excluída com sucesso!';
    $tipoMensagem = 'success';

} elseif (isset($_GET['erro'])) {

    if ($_GET['erro'] === 'nao_encontrado') {
        $mensagem = 'A rota não foi encontrada.';
    } else {
        $mensagem = 'Erro ao excluir a rota. Tente novamente.';
    }

    $tipoMensagem = 'danger';
}

$sql = "SELECT * FROM rotas ORDER BY id_rota";
$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro ao consultar rotas: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Listar Rotas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../style/style.css">

</head>

<body class="pagina-listagem">

<div class="pagina">

    <!-- MENU LATERAL -->

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


    <!-- CONTEÚDO PRINCIPAL -->

    <main class="area-cadastro">

        <div class="cabecalho-pagina">

            <div class="usuario-logado">
                <span class="icone-usuario">◉</span>
                <span>Administrador</span>
            </div>
        </div>


        <!-- MENSAGENS -->

        <?php if (!empty($mensagem)): ?>

            <div class="alert alert-<?= $tipoMensagem ?> alert-dismissible fade show">

                <?= htmlspecialchars($mensagem) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        <?php endif; ?>


        <!-- NOVO CARTÃO DE LISTAGEM -->

        <section class="cartao-listagem">

            <div class="cabecalho-listagem">

                <div class="icone-listagem">
                    <i class="bi bi-signpost-2"></i>
                </div>

                <div>
                    <h3>Rotas cadastradas</h3>
                    <p>
                        Visualize e gerencie as rotas ferroviárias.
                    </p>
                </div>

                <a href="adicionar_rota.php" class="botao-cadastrar">
                    <i class="bi bi-plus-lg"></i>
                    Cadastrar rota
                </a>

            </div>


            <!-- TABELA NOVA -->

            <div class="tabela-rotas-container">

                <table class="tabela-rotas">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Estação de origem</th>
                            <th>Estação de destino</th>
                            <th>Distância</th>
                            <th>Descrição</th>
                            <th>Tempo estimado</th>
                            <th>Trem vinculado</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($resultado) > 0): ?>

                            <?php while ($rota = mysqli_fetch_assoc($resultado)): ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars($rota['id_rota']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($rota['estacao_origem']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($rota['estacao_destino']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($rota['distancia_total']) ?> km
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($rota['descricao']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($rota['duracao']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($rota['trem_id']) ?>
                                    </td>

                                    <td>

                                        <div class="acoes-rotas">

                                            <button
                                                class="btn-rota btn-editar-rota"
                                                title="Editar"
                                                onclick="window.location.href='editar_rota.php?id_rota=<?= (int)$rota['id_rota'] ?>'">

                                                <i class="bi bi-pencil"></i>

                                            </button>


                                            <button
                                                class="btn-rota btn-excluir-rota"
                                                title="Excluir"
                                                onclick="if(confirm('Deseja realmente excluir esta rota?')) {
                                                    window.location.href='excluir_rota.php?id_rota=<?= (int)$rota['id_rota'] ?>';
                                                }">

                                                <i class="bi bi-trash3"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="sem-rotas">

                                    <i class="bi bi-signpost-split"></i>

                                    Nenhuma rota cadastrada.

                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
