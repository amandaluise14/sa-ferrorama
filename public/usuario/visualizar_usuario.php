<?php

include '../../infra/conexao.php';
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['usuario'] ?? null;

    if ($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
        $resultado = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT * FROM usuarios";
        $resultado = mysqli_query($conn, $sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuários/Administradores</title>
   <link rel="stylesheet" href="../../style/style.css">
</head>
<body>

</head>
<body>
    <div class="pagina">
        <div class="sidebar">
            <div class="logo">
            <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
            </div>
            <ul>
            <a href="../pagina_home.php" class="menu-link "><li>Início</li></a>
            <a href="../pagina_sensoresetrens.php" class="menu-link "><li>Sensores e Trens</li></a>
            <a href="../pagina_monitoramento.php" class="menu-link "><li>Monitoramento</li></a>
            <a href="../pagina_relatorios.php" class="menu-link "><li>Relatórios</li></a>
            <a href="../usuario/adicionar_usuario.php" class="menu-link "><li>Adicionar usuário</li></a>
            <a href="../logout.php" class="menu-link "><li>Sair</li></a>
            </ul>
        </div>
    <div class="formulario-container">
    <form method="POST" class="forms_sensores">
    <h2 id="titulo-admin">Visualizar Usuários/Administradores</h2>
    <div class="conteudo">

    <section class="cards">
        <div class="card-total">
        <h5>Total de funcionários</h5>
        <p>25</p>
        </div>
        <div class="card-total">
        <h5>Total de administradores</h5>
        <p>14</p>
        </div>           
        <div class="card-total">
        <h5>Total de usuários</h5>
        <p>200</p>
        </div>
        <div class="card-total">
        <h5>Total de administradores ativos</h5>
        <p>180</p>
        </div>
    </section>

       <section class="filtros">

       <input type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar">

               <form method="POST">
            <label for="usuario">Filtro por Usuário</label>
            <select id="usuario" name="usuario">
                <option value="">Todos</option>
                <?php
                $sqlUsuarios = "SELECT * FROM usuarios";
                $resultadoUsuarios = mysqli_query($conn, $sqlUsuarios);
                while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
                }

                ?>
            </select>
            <button type="submit">Filtrar</button>
            <br>
            <br>

        <label for="conta">Tipo de conta:</label>
        <select id="conta">
        <option>Administrador</option>
        <option>Usuário</option>
        <option>Selecione</option>
         </select>

        <label for="status">Status:</label>
        <select id="status">
        <option>Inativo</option>
        <option>Ativo</option>
        <option>Selecione</option>
        </select>

        <button type="submit" id="botaofiltrar">
        Filtrar
        </button>

        </section>

        <table class="tabela">

        <thead>
        <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Status</th>
        <th>Tipo de conta</th>
        <th>Último acesso</th>
        <th>Ações</th>
        </tr>
        </thead>
        <?php
        include '../../infra/conexao.php';
        $sql = "SELECT * FROM usuarios";
        $usuarios = $conn->query($sql);
        while ($usuario = $usuarios->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $usuario['id_usuario']; ?></td>
                <td><?php echo $usuario['nome']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['telefone']; ?></td>
                <td><?php echo $usuario['endereco']; ?></td>
                <td><?php echo $usuario['data_nascimento']; ?></td>
                <td><?php echo $usuario['cpf']; ?></td>
                <td><?php echo $usuario['cargo']; ?></td>
                <td><?php echo $usuario['status_usuario']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='editar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Tem certeza que deseja excluir este usuário?')) { window.location.href='excluir_usuario.php?id=<?php echo $usuario['id_usuario']; ?>'; }">Excluir</button>
                </td>
            </tr>

        <?php
        }
        ?>

      </table>
      <button class="botaoVisualizar" type="button" onclick="window.location.href='adicionar_usuario.php';">Ir para adicionar</button>

        </div>
        </main>

    </div>
    </div>
    </div>
    </div>
</body>
</html>