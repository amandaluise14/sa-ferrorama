
<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$erro = '';
$sucesso = '';

$id_sensor = (int) ($_GET['id_sensor'] ?? 0);

if ($id_sensor <= 0) {
    die("ID do sensor não foi enviado.");
}

// Buscar os dados do sensor
$sql = "SELECT * FROM sensores WHERE id_sensor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_sensor);
$stmt->execute();

$resultado = $stmt->get_result();
$sensor = $resultado->fetch_assoc();

if (!$sensor) {
    die("Sensor não encontrado.");
}

// Atualizar sensor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id_sensor']) || empty($_POST['id_sensor'])) {
        die("ID do sensor não foi enviado.");
    }

    $id_sensor = (int) $_POST['id_sensor'];

    $nome = $_POST['nome'];
    $rota_id = (int) $_POST['rota_id'];
    $descricao_localizacao = $_POST['descricao_localizacao'];
    $dado_monitorado = $_POST['dado_monitorado'];

    $sql = "UPDATE sensores 
            SET nome=?, rota_id=?, descricao_localizacao=?, dado_monitorado=? 
            WHERE id_sensor=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sissi",
        $nome,
        $rota_id,
        $descricao_localizacao,
        $dado_monitorado,
        $id_sensor
    );

    if ($stmt->execute() === TRUE) {
        $sucesso = "Sensor atualizado com sucesso!";

        // Atualizar os dados exibidos no formulário
        $sensor['nome'] = $nome;
        $sensor['rota_id'] = $rota_id;
        $sensor['descricao_localizacao'] = $descricao_localizacao;
        $sensor['dado_monitorado'] = $dado_monitorado;

    } else {
        $erro = 'Erro ao atualizar o sensor!' . $stmt->error;
    }
}

// Buscar as rotas cadastradas
$sql_rotas = "SELECT * FROM rotas";
$rotas = $conn->query($sql_rotas);

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

        <!-- CABEÇALHO -->
        <div class="cabecalho-pagina">

            <div class="usuario-logado">
                <span class="icone-usuario">◉</span>
                <span>Administrador</span>
            </div>

            <h2>Editar Sensor</h2>

            <p>Atualize as informações do sensor abaixo.</p>

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

                <input type="hidden" name="id_sensor"
                       value="<?php echo $sensor['id_sensor']; ?>">

                <div class="grade-formulario">

                    <div class="campo">
                        <label for="nome">Nome do sensor</label>

                        <input type="text"
                               id="nome"
                               name="nome"
                               value="<?php echo htmlspecialchars($sensor['nome']); ?>"
                               placeholder="Ex: Sensor de velocidade do trem 77"
                               required>
                    </div>

                    <div class="campo">

                        <label for="rota_id">Rota vinculada</label>

                        <select name="rota_id"
                                id="rota_id"
                                required>

                            <option value="">Selecione uma rota</option>

                            <?php while ($rota = $rotas->fetch_assoc()): ?>

                                <option value="<?= $rota['id_rota'] ?>"
                                    <?= ($sensor['rota_id'] == $rota['id_rota']) ? 'selected' : '' ?>>

                                    <?= htmlspecialchars($rota['nome']) ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="campo campo-largo">

                        <label for="descricao_localizacao">
                            Descrição da localização
                        </label>

                        <input type="text"
                               id="descricao_localizacao"
                               name="descricao_localizacao"
                               value="<?php echo htmlspecialchars($sensor['descricao_localizacao']); ?>"
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
                               value="<?php echo htmlspecialchars($sensor['dado_monitorado']); ?>"
                               placeholder="Ex: Velocidade"
                               required>

                    </div>

                </div>

                <div class="acoes-formulario">

                    <button type="button"
                            class="botao-voltar"
                            onclick="window.location.href='listar_sensor.php';">

                        ← Visualizar sensores cadastrados

                    </button>

                    <button type="submit"
                            class="botao-cadastrar">

                        <i class="bi bi-broadcast-pin"></i>
                        Editar sensor

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
