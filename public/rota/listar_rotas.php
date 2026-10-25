
<?php

session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$sql = "SELECT * FROM rotas ORDER BY id_rota";
$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro ao consultar as rotas: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    
    <title>Listar Rotas</title>
</head>

<body>

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

            <a href="../pagina_monitoramento.php" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="../logout.php" class="menu-link">
                <li>Sair</li>
            </a>

        </ul>

    </div>

    <div class="formulario-container">

        <div class="conteudo">

            <h2 class="titulo-admin">Listar Rotas</h2>

            <div class="table-responsive">

                <table class="table tabela-sensores">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Distância</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($rota = mysqli_fetch_assoc($resultado)): ?>

                            <tr>
                                <td><?php echo $rota['id_rota']; ?></td>
                                <td><?php echo $rota['estacao_origem']; ?></td>
                                <td><?php echo $rota['estacao_destino']; ?></td>
                                <td><?php echo $rota['distancia_total']; ?></td>
                                
                                         <button class="editar acao-tooltip"
                                            data-tooltip="Editar"
                                            type="button"
                                            onclick="window.location.href='editar_usuario.php?id_usuario=<?php echo (int) $usuario['id_usuario']; ?>'">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button
                                            class="excluir acao-tooltip"
                                            data-tooltip="Excluir"
                                            type="button"
                                            onclick="if (confirm('Tem certeza que deseja excluir este usuário?')) {
                                                window.location.href='excluir_usuario.php?id=<?php echo (int) $usuario['id_usuario']; ?>';
                                            }">

                                            <i class="bi bi-person-dash-fill"></i>

                                        </button>
                                <td>
                                    <a href="editar_rota.php?id_rota=<?php echo $rota['id_rota']; ?>"
                                       class="editar"
                                       onclick="window.location.href='editar_rota.php?id_rota=<?php echo (int) $rota['id_rota']; ?>'">
                                        Editar
                                    </a>
                                    <a href="excluir_rota.php?id_rota=<?php echo $rota['id_rota']; ?>"
                                       class="excluir"
                                       onclick="return confirm('Tem certeza que deseja excluir esta rota?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
