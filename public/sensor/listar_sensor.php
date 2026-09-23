<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Listagem de sensores</title>
</head>

<body>

   <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
        <li>Início</li>
        <li class="active"> Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
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
</body>
</html>