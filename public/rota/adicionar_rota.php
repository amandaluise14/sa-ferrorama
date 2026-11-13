<?php 

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
$erro = '';
$sucesso = '';
$sql = "SELECT * FROM trens";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar trens: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $descricao= $_POST ['descricao'];
    $duracao = $_POST ['duracao'];
    $trem_id = $_POST ['trem_id'];



    $sql = "INSERT INTO rotas (nome, estacao_origem, estacao_destino, distancia_total, descricao, duracao, trem_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $estacao_origem, $estacao_destino, $distancia_total,  $descricao, $duracao,$trem_id);
     if ($stmt->execute() === TRUE) {
        $sucesso = "Nova Rota cadastrada com sucesso";
 } else {
     $erro = "Erro ao cadastrar rota: " . $stmt->error;
 }

}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Rota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="../../style/style.css">

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
                    <li><i class="bi bi-house-fill"></i> Início</li>
                </a>

                <a href="../usuario/adicionar_usuario.php" class="menu-link">
                    <li><i class="bi bi-person-plus"></i> Adicionar usuário</li>
                </a>

                 <a href="../rota/adicionar_rota.php" class="menu-link">
                    <li><i class="bi bi-signpost-2"></i> Rotas</li>
                </a>

                 <a href="../trem/adicionar_trem.php" class="menu-link">
                    <li><i class="bi bi-train-front"></i> Trens</li>
                </a>

                 <a href="../sensor/adicionar_sensor.php" class="menu-link">
                    <li><i class="bi bi-broadcast-pin"></i> Sensores</li>
                </a>


            <?php endif; ?>

            <a href="../pagina_monitoramento.php" class="menu-link">
                <li><i class="bi bi-graph-up"></i> Monitoramento</li>
            </a>
            <br>
            <a href="../logout.php" class="menu-link">
                <li><i class="bi bi-box-arrow-right"></i> Sair</li>
            </a>
        </ul>

    </div>

    <main class="area-cadastro">

        <div class="cabecalho-pagina">

            <div class="usuario-logado">
                <span class="icone-usuario">◉</span>
                <span>Administrador</span>
            </div>

            <h2>Cadastrar Rota</h2>

            <p>Cadastre uma nova rota ferroviária no sistema Info Trem.</p>

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
                    <i class="bi bi-signpost-2"></i>
                </div>

                <div>
                    <h3>Informações da rota</h3>
                    <p>Preencha os dados para cadastrar uma nova rota ferroviária.</p>
                </div>

            </div>


            <form method="POST" class="form-cadastro-usuario">

                <div class="grade-formulario">

                    <div class="campo">

                        <label for="nome">Nome da rota</label>

                        <input type="text"
                               id="nome"
                               name="nome"
                               placeholder="Ex: Rota Joinville - Araquari"
                               required>

                    </div>

                    <div class="campo">

                        <label for="trem_id">Trem vinculado</label>

                        <select name="trem_id" id="trem_id" required>

                            <option value="">Selecione um trem</option>

                            <?php
                            mysqli_data_seek($resultado, 0);

                            while ($trem = mysqli_fetch_assoc($resultado)):
                            ?>

                                <option value="<?= htmlspecialchars($trem['id_trem']) ?>">
                                    <?= htmlspecialchars($trem['modelo']) ?>
                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="campo">

                        <label for="estacao_origem">Estação de origem</label>

                        <input type="text"
                               id="estacao_origem"
                               name="estacao_origem"
                               placeholder="Ex: Estação Guanabara"
                               required>

                    </div>

                    <div class="campo">

                        <label for="estacao_destino">Estação de destino</label>

                        <input type="text"
                               id="estacao_destino"
                               name="estacao_destino"
                               placeholder="Ex: Estação Itaum"
                               required>

                    </div>

                    <div class="campo">

                        <label for="distancia_total">Distância total (km)</label>

                        <input type="number"
                               id="distancia_total"
                               name="distancia_total"
                               placeholder="Ex: 25"
                               min="0"
                               step="0.01"
                               required>

                    </div>


                    <div class="campo">

                        <label for="duracao">Tempo previsto de viagem</label>

                        <input type="time"
                               id="duracao"
                               name="duracao"
                               placeholder="Ex: 2 horas e 30 minutos"
                               required>

                    </div>


                    <div class="campo campo-largo">

                        <label for="descricao">Descrição da rota</label>

                        <textarea id="descricao"
                                  name="descricao"
                                  rows="3"
                                  placeholder="Descreva as características e informações da rota..."
                                  required></textarea>

                    </div>

                </div>


                <!-- BOTÕES -->
                <div class="acoes-formulario">

                    <button type="button"
                            class="botao-voltar"
                            onclick="window.location.href='listar_rotas.php';">

                        ← Visualizar Rotas Cadastradas

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
