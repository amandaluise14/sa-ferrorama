

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
<title>Listagem de Sensores</title>
     <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <div class="conteudo">

    <h2 id="titulo-admin">Listagem de Sensores</h2>

    <table>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Ações</th>
        <?php
        include '../../infra/conexao.php';
        $sql = "SELECT * FROM sensores";
        $sensores = $conn->query($sql);
        while ($sensor = $sensores->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $sensor['id']; ?></td>
                <td><?php echo $sensor['nome']; ?></td>
                <td><?php echo $sensor['email']; ?></td>
                <td><?php echo $sensor['telefone']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='public/sensor/editar_sensor.php?id=<?php echo $sensor['id']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Tem certeza que deseja excluir este sensor?')) { window.location.href='public/sensor/excluir_sensor.php?id=<?php echo $sensor['id']; ?>'; }">Excluir</button>
                </td>
            </tr>

        <?php
        }
        ?>
    </table>
 
    </div>
    </form> 
    </div>  
</body>
</html>