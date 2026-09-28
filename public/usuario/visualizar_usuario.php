<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Listagem de Usuários</title>
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
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Visualizar Usuários/Administradores</h2>
            <div class="conteudo">

    <div class="container mt-3">

        <main class="conteudo">

      <div class="d-block p-2">

      <div class="d-flex align-items-start">
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
    </div>
</body>
</html>