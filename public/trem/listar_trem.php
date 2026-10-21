<?php
session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

<!-- Aparece para administrador e usuário comum -->
<a href="../pagina_monitoramento.php" class="menu-link">
    <li>Monitoramento</li>
</a>

<a href="../logout.php" class="menu-link">
    <li>Sair</li>
</a>

        </ul>
    </div>

    <div class="container mt-4">

        <div class="d-flex align-items-center gap-3 mb-5">

            <h2 class="titulo-admin mb-4">
                Bem vindo <?php echo $_SESSION['usuario'] ?? ''; ?>
            </h2>

           

          <?php if ($administrador): ?>

            <a href="adicionar_trem.php" class="btn btn-danger mb-3">
                Cadastrar trem
            </a>

        <?php endif; ?>
        
    </div>

        <div class="table-responsive">

            <table class="table tabela-sensores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificação</th>
                        <th>Modelo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
<!-- Aqui é onde os dados dos trens serão exibidos na tabela -->
                   <?php while ($trem = mysqli_fetch_assoc($trens)): ?>

        <tr>
            <td><?php echo $trem['id_trem']; ?></td>
            <td><?php echo $trem['identificacao']; ?></td>
            <td><?php echo $trem['modelo']; ?></td>
            <td><?php echo $trem['status']; ?></td>
            <td>
                <a href="excluir_trem.php?id_trem=<?php echo $trem['id_trem']; ?>"
                   class="excluir"
                   onclick="return confirm('Tem certeza que deseja excluir este trem?')">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
