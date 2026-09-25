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
        <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
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

        
        <button id="botaoHome" type="submit" onclick="window.location.href='../../adicionar_sensor.php';">Cadastrar Sensor</button>
        <button id="botaoHome" type="submit" onclick="window.location.href='../../adicionar_trens.php';">Cadastrar Trens</button>
        <br><br>
        <button id="botaoHome" type="submit" onclick="window.location.href='../../adicionar_rotas.php';">Cadastrar Rotas</button>
        <button id="botaoHome" type="submit">Visualizar Cadastros</button>
        
    </div>
    </form> 
    </div>
    </body>
</html>