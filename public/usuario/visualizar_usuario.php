<?php
$usuario = "Administrador";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuários/Administradores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <title>Visualizar Usuários/Administradores</title>
     <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Visualizar Usuários/Administradores</h2>
            <div class="conteudo">

    <div class="container mt-3">

        <main class="conteudo">

      <div class="d-block p-2">

      <div class="d-flex align-items-start">
      <h2>Bem-vindo, <?php echo $usuario; ?></h2>
       </div>

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

       <input type="text" id="pesquisar" placeholder="Pesquisar">

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
        <th>Telefone</th>
        <th>Status</th>
        <th>Tipo de conta</th>
        <th>Último acesso</th>
        <th>Ações</th>
        </tr>
        </thead>

        <tbody>

         <tr>
        <td>1</td>
        <td>Amanda</td>
        <td>amanda14@gmail.com</td>
        <td>(47) 9999-2358</td>
        <td>Ativo</td>
        <td>Usuário</td>
        <td>14/06</td>
        <td> <a href="#" class="excluir">Excluir</a>
         <a href="#" class="editar">Editar</a></td>
        </tr>

        <tr>
        <td>22</td>
        <td>Ana Luíza</td>
        <td>ana_jung@gmail.com</td>
        <td>(47) 1349-2275</td>
        <td>Inativo</td>
        <td>Administrador</td>
        <td>12/01</td>
        <td> <a href="#" class="excluir">Excluir</a>
         <a href="#" class="editar">Editar</a></td>
        </tr>

        <tr>
        <td>11</td>
        <td>Carine</td>
        <td>carine_sts@gmail.com</td>
        <td>(47) 1234-5678</td>
        <td>Inativo</td>
        <td>Usuário</td>
        <td>11/02</td>
        <td> <a href="#" class="excluir">Excluir</a>
         <a href="#" class="editar">Editar</a></td>
        </tr>

        <tr>
        <td>199</td>
        <td>Gabriela</td>
        <td>baartz291122@gmail.com</td>
        <td>(47) 8923-8000</td>
        <td>Ativo</td>
        <td>Administrador</td>
        <td>13/06</td>
         <td>  <a href="#" class="excluir">Excluir</a>
        <a href="#" class="editar">Editar</a></td>
         </tr>

      </tbody>

      </table>

      <button class="botaoVisualizar" type="button" onclick="window.location.href='adicionar_usuario.php';">Ir para adicionar</button>
        </div>
        </main>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>