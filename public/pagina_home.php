<?php

include '../infra/conexao.php';
include '../infra/verificar_admin.php';
include '../infra/clima.php';

?>
<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
         <div class="pagina">
    <div class="sidebar">

        <div class="logo">
        <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>

    <ul>
                   
          <?php if ($_SESSION['cargo'] === 'administrador'): ?>

                <a href="pagina_home.php" class="menu-link">
                    <li>Início</li>
                </a>

                <a href="pagina_relatorios.php" class="menu-link">
                    <li>Relatórios</li>
                </a>

                <a href="usuario/adicionar_usuario.php" class="menu-link">
                    <li>Adicionar usuário</li>
                </a>

            <?php endif; ?>

            <a href="pagina_monitoramento.php" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="logout.php" class="menu-link">
                <li>Sair</li>
            </a>


    </ul>
    </div>

    <title>Página Home</title>
     <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Bem vindo, Administrador</h2>
            <div class="conteudo">

  <div class="card-clima">

    <div class="clima-cabecalho">
        <div>
            <h5>Clima atual</h5>
            <p>Joinville - SC</p>
        </div>

        <i class="bi bi-cloud-sun clima-icone"></i>
    </div>

    <div class="clima-temperatura">
        <h2><?php echo $temperatura; ?>°C</h2>
        <span><?php echo $condicao; ?></span>
    </div>

    <div class="clima-informacoes">

        <div class="clima-item">
            <i class="bi bi-droplet"></i>
            <div>
                <small>Umidade</small>
                <p><?php echo $umidade; ?>%</p>
            </div>
        </div>

        <div class="clima-item">
            <i class="bi bi-clock"></i>
            <div>
                <small>Última atualização</small>
                <p>
                    <?php echo date(
                        'd/m/Y H:i',
                        strtotime($horario)
                    ); ?>
                </p>
            </div>
        </div>

    </div>

    <div class="clima-rodape">
        <span>Fonte: Open-Meteo</span>
        <i class="bi bi-cloud-check"></i>
    </div>

</div>


        <button id="botaoHome" type="button" onclick="window.location.href='sensor/adicionar_sensor.php';">Cadastrar Sensor</button>
        <br>
        <button id="botaoHome" type="button" onclick="window.location.href='trem/adicionar_trem.php';">Cadastrar Trens</button>
        <br>
        <button id="botaoHome" type="button" onclick="window.location.href='rota/adicionar_rota.php';">Cadastrar Rotas</button>
        <br>
    </div>
    </form> 
    </div>
    </body>
</html>