<?php

include '../../infra/conexao.php';
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuario = $_POST['usuario'] ?? '';

    if (!empty($id_usuario)) {

        $id_usuario = (int) $id_usuario;

        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";

        $resultado = mysqli_query($conn, $sql);

    } else {

        $sql = "SELECT * FROM usuarios";

        $resultado = mysqli_query($conn, $sql);
    }
}

//funcionarios
$sqlTotal = "SELECT COUNT(*) AS total FROM usuarios";
$resultadoTotal = $conn->query($sqlTotal);
$totalFuncionarios = $resultadoTotal->fetch_assoc()['total'];

//administradores
$sqlAdmins = "SELECT COUNT(*) AS total FROM usuarios WHERE cargo = 'administrador'";
$resultadoAdmins = $conn->query($sqlAdmins);
$totalAdmins = $resultadoAdmins->fetch_assoc()['total'];

//usuarios
$sqlUsuarios = "SELECT COUNT(*) AS total FROM usuarios WHERE cargo = 'usuário'";
$resultadoUsuarios = $conn->query($sqlUsuarios);
$totalUsuarios = $resultadoUsuarios->fetch_assoc()['total'];

//ativos
$sqlAtivos = "SELECT COUNT(*) AS total FROM usuarios WHERE status_usuario = 'ativo'";
$resultadoAtivos = $conn->query($sqlAtivos);
$totalAtivos = $resultadoAtivos->fetch_assoc()['total'];

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
                    <a href="../pagina_home.php" class="menu-link ">
                        <li>Início</li>
                    </a>
                    <a href="../pagina_sensoresetrens.php" class="menu-link ">
                        <li>Sensores e Trens</li>
                    </a>
                    <a href="../pagina_monitoramento.php" class="menu-link ">
                        <li>Monitoramento</li>
                    </a>
                    <a href="../pagina_relatorios.php" class="menu-link ">
                        <li>Relatórios</li>
                    </a>
                    <a href="../usuario/adicionar_usuario.php" class="menu-link ">
                        <li>Adicionar usuário</li>
                    </a>
                    <a href="../logout.php" class="menu-link ">
                        <li>Sair</li>
                    </a>
                </ul>
            </div>
            <div class="formulario-container">
                <form method="POST" class="forms">
                    <h2 id="titulo-admin">Visualizar Usuários/Administradores</h2>
                    <div class="conteudo">

                        <section class="cards">
                            <div class="card-total">
                                <h5>Total de Funcionários</h5>
                                <p><?php echo $totalFuncionarios; ?></p>
                            </div>
                            <div class="card-total">
                                <h5>Total de Administradores</h5>
                                <p><?php echo $totalAdmins; ?></p>
                            </div>
                            <div class="card-total">
                                <h5>Total de Usuários</h5>
                                <p><?php echo $totalUsuarios; ?></p>
                            </div>
                            <div class="card-total">
                                <h5>Total de Administradores Ativos</h5>
                                <p><?php echo $totalAtivos; ?></p>
                            </div>
                        </section>

                        <section class="filtros">

                            <input type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar">

                                <?php
                                $sqlUsuarios = "SELECT * FROM usuarios";
                                $resultadoUsuarios = mysqli_query($conn, $sqlUsuarios);
                                while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)) {
                                    echo "<option value='{$usuario['id_usuario']}'>{$usuario['nome']}</option>";
                                }

                                ?>
                            </select>
                            <br>
                            <br>

                            <select id="conta" name="cargo">

                                <option value=""> Todos </option>

                                <option value="administrador"> Administrador</option>

                                <option value="usuário"> Usuário </option>

                            </select>

                            <select id="status" name="status">
                                <option value=""> Todos </option>

                                <option value="ativo"> Ativo </option>

                                <option value="inativo"> Inativo </option>

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
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                    <th>Data de Nascimento</th>
                                    <th>CPF</th>
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
                                    
                                    <button class= "editar" type="button"
                                            onclick="window.location.href='editar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>'">Editar</button>
                                        <button type="button"
                                            onclick="if (confirm('Tem certeza que deseja excluir este usuário?')) { window.location.href='excluir_usuario.php?id=<?php echo $usuario['id_usuario']; ?>'; }">Excluir</button>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>

                        </table>
                        <button class="botaoVisualizar" type="button"
                            onclick="window.location.href='adicionar_usuario.php';">Ir para adicionar</button>

                    </div>
                    </main>

            </div>
        </div>
        </div>
        </div>
    </body>

</html>