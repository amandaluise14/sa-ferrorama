<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
         <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
        <li>Início</li>
        <li>Sensores e Trens</li>
        <li>Monitoramento</li>
        <li>Relatórios</li>
        <li>Adicionar usuário</li>
        <li>Sair</li>
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
        <select id="botaoHome" name="select">Visualizar Cadastros
            <option type="button" value="rota">Visualizar Rotas</option>
            <option type="button" value="trens">Visualizar Trens</option>
            <option type="button" value="sensores">Visualizar Sensores</option>
        </select>
    </div>
    </form> 
    </div>
    </body>
</html>