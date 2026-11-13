<?php

include '../infra/conexao.php';
include '../infra/verificar_admin.php';
include '../infra/clima.php';

$sql_totais = "SELECT
    (SELECT COUNT(*) FROM rotas) AS total_rotas,
    (SELECT COUNT(*) FROM trens) AS total_trens,
    (SELECT COUNT(*) FROM sensores) AS total_sensores";

$resultado_totais = mysqli_query($conn, $sql_totais);

$totais = mysqli_fetch_assoc($resultado_totais); 

$sql_usuarios = "SELECT
    COUNT(*) AS total_usuarios,
    SUM(CASE WHEN cargo = 'administrador' THEN 1 ELSE 0 END) AS total_administradores,
    SUM(CASE WHEN cargo = 'usuário' THEN 1 ELSE 0 END) AS total_comuns
    FROM usuarios";

$resultado_usuarios = mysqli_query($conn, $sql_usuarios);

$usuarios = mysqli_fetch_assoc($resultado_usuarios);

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
                    <li><i class="bi bi-house-fill"></i> Início</li>
                </a>


                <a href="usuario/adicionar_usuario.php" class="menu-link">
                    <li><i class="bi bi-person-plus"></i> Adicionar usuário</li>
                </a>

            <?php endif; ?>

            <a href="pagina_monitoramento.php" class="menu-link">
                <li><i class="bi bi-graph-up"></i> Monitoramento</li>
            </a>

            <a href="logout.php" class="menu-link">
                <li><i class="bi bi-box-arrow-right"></i> Sair</li>
            </a>


    </ul>
    </div>

    <title>Página Home</title>
     <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Bem vindo, Administrador</h2>

    <div class="painel-superior">
 
            <div class="conteudo">


    <div class="acessos-rapidos">

    <div class="titulo-acessos">
        <h3>Acessos rápidos</h3>
        <p>Selecione uma opção para gerenciar o sistema.</p>
    </div>

    <div class="grade-acessos">

        <!-- CADASTRAR SENSOR -->
        <a href="sensor/adicionar_sensor.php" class="card-acesso">

            <div class="icone-acesso">
                <i class="bi bi-broadcast-pin"></i>
            </div>

            <div class="info-acesso">
                <h4>Sensores</h4>
                <p>Cadastre e gerencie os sensores de monitoramento.</p>
            </div>


        </a>


        <!-- CADASTRAR TREM -->
        <a href="trem/adicionar_trem.php" class="card-acesso">

            <div class="icone-acesso">
                <i class="bi bi-train-front"></i>
            </div>

            <div class="info-acesso">
                <h4>Trens</h4>
                <p>Cadastre e gerencie os trens do sistema.</p>
            </div>

        </a>


        <!-- CADASTRAR ROTA -->
        <a href="rota/adicionar_rota.php" class="card-acesso">

            <div class="icone-acesso">
                <i class="bi bi-signpost-2"></i>
            </div>

            <div class="info-acesso">
                <h4>Rotas</h4>
                <p>Cadastre e organize as rotas ferroviárias.</p>
            </div>

        </a>

    </div>

</div>
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

 <!-- USUÁRIOS DO SISTEMA -->
<div class="card-usuarios">

    <div class="titulo-controle">
        <h3>Usuários do sistema</h3>
        <p>Resumo dos usuários cadastrados.</p>
    </div>

    <div class="usuario-item">
        <div class="usuario-icone">
            <i class="bi bi-people"></i>
        </div>

        <div>
            <h2><?php echo $usuarios['total_comuns']; ?></h2>
            <h4>Usuários</h4>
            <p>Usuários cadastrados</p>
        </div>
    </div>

    <div class="usuario-item">
        <div class="usuario-icone">
            <i class="bi bi-person-badge"></i>
        </div>

        <div>
            <h2><?php echo $usuarios['total_administradores']; ?></h2>
            <h4>Administradores</h4>
            <p>Administradores cadastrados</p>
        </div>
    </div>

    <div class="total-usuarios">
        <span>Total de contas no sistema</span>
        <strong><?php echo $usuarios['total_usuarios']; ?></strong>
    </div>


    </div>
          </div>

          <!-- CONTROLE GERAL -->
<div class="controle-geral">

    <div class="titulo-controle">
        <h3>Controle geral</h3>
        <p>Resumo dos registros cadastrados no sistema.</p>
    </div>

    <div class="grade-controle">

        <div class="card-controle">
            <div class="icone-controle">
                <i class="bi bi-signpost-2"></i>
            </div>

            <div class="info-controle">
                <h2><?php echo $totais['total_rotas']; ?></h2>
                <h4>Rotas cadastradas</h4>
                <p>Total de rotas no sistema</p>
            </div>
        </div>

        <div class="card-controle">
            <div class="icone-controle">
                <i class="bi bi-train-front"></i>
            </div>

            <div class="info-controle">
                <h2><?php echo $totais['total_trens']; ?></h2>
                <h4>Trens cadastrados</h4>
                <p>Total de trens no sistema</p>
            </div>
        </div>

        <div class="card-controle">
            <div class="icone-controle">
                <i class="bi bi-broadcast-pin"></i>
            </div>

            <div class="info-controle">
                <h2><?php echo $totais['total_sensores']; ?></h2>
                <h4>Sensores cadastrados</h4>
                <p>Total de sensores no sistema</p>
            </div>
        </div>


</div>

    </div>
</div>

    </form> 
    </div>
    </body>
</html>
