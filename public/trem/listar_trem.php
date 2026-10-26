
<?php
session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
//mensagem de erro e sucesso ao excluir
$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'excluido') {
    $mensagem = 'Trem excluído com sucesso!';
    $tipoMensagem = 'success';
} elseif (isset($_GET['erro'])) {
    if ($_GET['erro'] === 'nao_encontrado') {
        $mensagem = 'O trem não foi encontrado.';
    } else {
        $mensagem = 'Erro ao excluir o trem. Tente novamente.';
    }

    $tipoMensagem = 'danger';
}

$sql = "SELECT * FROM trens";
$trens = mysqli_query($conn, $sql);

if (!$trens) {
    die("Erro ao consultar os trens: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Listar Trens</title>
</head>

<body>

<div class="d-flex align-items-start">

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

            <a href="../pagina_monitoramento.php" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="../logout.php" class="menu-link">
                <li>Sair</li>
            </a>

        </ul>
    </div>

    <div class="container mt-4">
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
        <div class="d-flex align-items-center gap-3 mb-5">

            <h2 class="titulo-admin mb-4">
                Listagem de Trens
            </h2>



        </div>

        <div class="table-responsive">

    <table class="table tabela-sensores">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Velocidade</th>
                <th>Linha</th>
                <th>Carga</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($trem = mysqli_fetch_assoc($trens)): ?>

                <tr>
                    <td><?php echo $trem['id_trem']; ?></td>
                    <td><?php echo $trem['modelo']; ?></td>
                    <td><?php echo $trem['velocidade']; ?></td>
                    <td><?php echo $trem['linha']; ?></td>
                    <td><?php echo $trem['carga']; ?></td>
                    <td>

                      <button class="editar acao-tooltip"


                                        <button class="editar acao-tooltip"
                                            data-tooltip="Editar"
                                            type="button"
                                            onclick="window.location.href='editar_trem.php?id_trem=<?php echo (int) $trem['id_trem']; ?>'">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button
                                            class="excluir acao-tooltip"
                                            data-tooltip="Excluir"
                                            type="button"
                                            onclick="if (confirm('Tem certeza que deseja excluir este trem?')) {
                                                window.location.href='excluir_trem.php?id_trem=<?php echo (int) $trem['id_trem']; ?>';
                                            }">

                                            <i class="bi bi-person-dash-fill"></i>

                                        </button>

                    </td>


                                    </td>

                </tr>

            <?php endwhile; ?>

        </tbody>
    </table>




<button class="botaoVisualizar" type="button" onclick="window.location.href='adicionar_trem.php'"> Cadastrar Trem </button>

</div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
