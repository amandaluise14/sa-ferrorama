<?php

include '../infra/conexao.php';
include '../infra/verificar_admin.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Cadastrar Rota</title>
    <style>
</style>
</head>

<body>

        <div class="sidebar">

            <div class="logo">
                <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
            </div>

            <ul>
              
      
            <a href="pagina_monitoramento.php" class="menu-link ">
                    <li>Monitoramento</li>
                </a>

            <a href="logout.php" class="menu-link ">
                    <li>Sair</li>
                </a>

                <?php if ($_SESSION['cargo'] === 'administrador'): ?>


         <!-- Adminitrador pode acessar  -->
                <a href="pagina_home.php" class="menu-link ">
                   <li>Início</li>
                </a>
                <a href="pagina_relatorios.php" class="menu-link ">
                    <li>Relatórios</li>
                </a>
                <a href="usuario/adicionar_usuario.php" class="menu-link ">
                    <li>Adicionar usuário</li>
                </a>

    <?php endif; ?>

            </ul>
        </div>

</body>

</html>

