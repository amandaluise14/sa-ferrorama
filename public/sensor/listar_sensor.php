<?php

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
    <title>Listagem de sensores</title>

    <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>

   <div class="pagina">

      <!-- Botão de voltar -->
        <button type="button" onclick="history.back()"
            aria-label="Voltar para a página anterior"
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

        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Listagem de Sensores</h2>
            <div class="conteudo">

             <div class="table-responsive">

    <table class="table tabela-sensores">
        <th>ID</th>
        <th>Nome</th>
        <th>Localização</th>
        <th>Descrição da Localização</th>
        <th>Dado Monitorado</th>
        <th>Ações</th>
        <?php
        include '../../infra/conexao.php';
        $sql = "SELECT * FROM sensores";
        $sensores = $conn->query($sql);
        while ($sensor = $sensores->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $sensor['id_sensor']; ?></td>
                <td><?php echo $sensor['nome']; ?></td>
                <td><?php echo $sensor['localizacao']; ?></td>
                <td><?php echo $sensor['descricao_localizacao']; ?></td>
                <td><?php echo $sensor['dado_monitorado']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='editar_sensor.php?id=<?php echo $sensor['id_sensor']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Tem certeza que deseja excluir este sensor?')) { window.location.href='excluir_sensor.php?id=<?php echo $sensor['id_sensor']; ?>'; }">Excluir</button>
                </td>
            </tr>

        <?php
        }
        ?>
    </table>
    </div>
 
    </div>
    </form> 
    </div>  
    </div>
</body>
</html>