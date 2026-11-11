<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
$erro = '';
$sucesso = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "INSERT INTO sensores (nome, localizacao, descricao_localizacao, dado_monitorado) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $localizacao, $descricao_localizacao, $dado_monitorado);
    if ($stmt->execute() === TRUE) {
        $sucesso = "Novo sensor cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar sensor: " . $stmt->error;
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Sensor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

          <script src="../js/persistencia_formularios.js" defer></script>
</head>

<body>

<div class="pagina">
    <div class="sidebar">

        <div class="logo">
            <img id="imagem_logo"
                 src="../../assets/image/logo_png_branca.png"
                 alt="Logo Info Trem">
        </div>

        <ul>

            <?php if ($_SESSION['cargo'] === 'administrador'): ?>

                <a href="../pagina_home.php" class="menu-link">
                    <li>Início</li>
                </a>

                <a href="../pagina_relatorios.php" class="menu-link">
                    <li>Relatórios</li>
                </a>

                <a href="../usuario/adicionar_usuario.php" class="menu-link">
                    <li>Adicionar usuário</li>
                </a>

            <?php endif; ?>

            <a href="../pagina_monitoramento.php" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="../logout.php" class="menu-link">
                <li>Sair</li>
            </a>

        </ul>

    </div>

    <main class="area-cadastro">
        <div class="cabecalho-pagina">

            <div class="usuario-logado">
                <span class="icone-usuario">◉</span>
                <span>Administrador</span>
            </div>

            <h2>Cadastrar Sensor</h2>

            <p>Cadastre um novo sensor para monitoramento no sistema Info Trem.</p>

        </div>

        <?php if (!empty($erro)): ?>

            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">

                <strong>⚠️ Ops!</strong>
                <?= htmlspecialchars($erro) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fechar">
                </button>

            </div>

        <?php endif; ?>


        <?php if (!empty($sucesso)): ?>

            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">

                <strong>✅ Sucesso!</strong>
                <?= htmlspecialchars($sucesso) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fechar">
                </button>

            </div>

        <?php endif; ?>


        <div class="cartao-formulario">

            <div class="formulario-cabecalho">

                <div class="icone-formulario">
                    <i class="bi bi-broadcast-pin"></i>
                </div>

                <div>
                    <h3>Informações do sensor</h3>
                    <p>Preencha os dados para cadastrar um novo sensor.</p>
                </div>

            </div>

            <form method="POST" class="form-cadastro-usuario">

                <div class="grade-formulario">
                    <div class="campo campo-largo">

                        <label for="nome">Nome do sensor</label>

                        <input type="text"
                               id="nome"
                               name="nome"
                               placeholder="Ex: Sensor de velocidade do trem 77"
                               required>
                    </div>
                    <div class="campo campo-largo">

                        <!-- <label>Localização do sensor</label>

                        <div class="opcoes-localizacao">

                            <label class="opcao-radio" for="localizacao_trem">

                                <input type="radio"
                                       id="localizacao_trem"
                                       name="localizacao"
                                       value="Trem"
                                       required>

                                <span>
                                    <i class="bi bi-train-front"></i>
                                    Trem
                                </span>

                            </label>
                            

                            <label class="opcao-radio" for="localizacao_rota">

                                <input type="radio"
                                       id="localizacao_rota"
                                       name="localizacao"
                                       value="Rota"
                                       required>

                                <span>
                                    <i class="bi bi-signpost-2"></i>
                                    Rota
                                </span>

                            </label>

                        </div> --->

                    </div>
                    <div class="campo campo-largo">

                        <label for="descricao_localizacao">
                            Descrição da localização
                        </label>

                        <input type="text"
                               id="descricao_localizacao"
                               name="descricao_localizacao"
                               placeholder="Ex: Sensor de velocidade localizado na rota"
                               required>

                    </div>
                    <div class="campo campo-largo">

                        <label for="dado_monitorado">
                            Tipo do dado monitorado
                        </label>

                        <input type="text"
                               id="dado_monitorado"
                               name="dado_monitorado"
                               placeholder="Ex: Velocidade"
                               required>
                    </div>

                </div>

                <div class="acoes-formulario">
                    <button type="button"
                            class="botao-voltar"
                            onclick="window.location.href='listar_rotas.php';">
                        ← Visualizar Sensores Cadastrados
                    </button>
                    <button type="submit"
                            class="botao-cadastrar">
                        <i class="bi bi-signpost-2"></i>
                        Cadastrar rota
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



