<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sensores e Trens</title>
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
         <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
        <a href="pagina_home.php" class="menu-link ">
                   <li>Início</li>
                </a>
                <a href="pagina_sensoresetrens.php" class="menu-link ">
                    <li>Sensores e Trens</li>
                </a>
                <a href="pagina_monitoramento.php" class="menu-link ">
                    <li>Monitoramento</li>
                </a>
                <a href="pagina_relatorios.php" class="menu-link ">
                    <li>Relatórios</li>
                </a>
                <a href="usuario/adicionar_usuario.php" class="menu-link ">
                    <li>Adicionar usuário</li>
                </a>
                <a href="logout.php" class="menu-link ">
                    <li>Sair</li>
                </a>
    </ul>
    </div>

    <title>Página Home</title>
     <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Bem vindo, Administrador</h2>
            <div class="conteudo">

        
        <button id="botaoHome" type="button" onclick="window.location.href='sensor/adicionar_sensor.php';">Cadastrar Sensor</button>
        <button id="botaoHome" type="button" onclick="window.location.href='trem/adicionar_trem.php';">Cadastrar Trens</button>
        <br><br>
        <button id="botaoHome" type="button" onclick="window.location.href='rota/adicionar_rota.php';">Cadastrar Rotas</button>
        <br>
    </div>
    </form> 
    </div>
    </body>
</html>