<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// aqui busca as rotas cadastradas 
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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>


<div class="pagina">

 <!-- Botão de voltar -->
        <button type="button" onclick="history.back()"
            style="position: absolute; top: 10px; left: 165px; background: none; border: none; cursor: pointer; font-size: 20px; color: black;">
            <i class="bi bi-arrow-90deg-left"></i>
        </button>
        
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

            <form method="POST" class="forms_rotas">

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

                   <tbody>

    <?php while ($rota = mysqli_fetch_assoc($resultado)): ?>
<!-- Aqui é onde os dados das rotas serão exibidos na tabela e cria uma linha pra cada uma -->
        <tr>
            <td><?php echo $rota['id_rota']; ?></td>
            <td><?php echo $rota['origem']; ?></td>
            <td><?php echo $rota['destino']; ?></td>
            <td><?php echo $rota['distancia']; ?></td>
            <td>
                <span class="text-muted">Ações pendentes</span>
            </td>
        </tr>

    <?php endwhile; ?>

</tbody>

                </tbody>

            </table>
            </form>

            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!-- nesta pagina precisei de ajuda do chat gpt para dar auxilio na criação da tabela de listagem de rotas -->