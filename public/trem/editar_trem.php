<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if (!isset($_GET['id_trem'])) {
    echo "ID do trem não informado.";
    exit;
}

$id_trem = (int) $_GET['id_trem'];

$sql = "SELECT * FROM trens WHERE id_trem = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_trem);
$stmt->execute();

$resultado = $stmt->get_result();
$trem = $resultado->fetch_assoc();

if (!$trem) {
    echo "Trem não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $linha = $_POST['linha'];
    $carga = $_POST['carga'];

    $sql = "UPDATE trens
            SET modelo=?,
                velocidade=?,
                linha=?,
                carga=?
            WHERE id_trem=?";

    $stmt = $conn->prepare($sql);

   $stmt->bind_param(
    "ssssi",
    $modelo,
    $velocidade,
    $linha,
    $carga,
    $id_trem
);

    if ($stmt->execute()) {
        header("Location: listar_trem.php");
        exit();
    } else {
        echo "Erro ao atualizar trem: " . $stmt->error;
    }
}

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Trem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<div class="pagina">

    <!-- SIDEBAR -->
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


    <!-- CONTEÚDO PRINCIPAL -->
    <main class="area-cadastro">

        <!-- CABEÇALHO -->
        <div class="cabecalho-pagina">

            <div class="usuario-logado">
                <span class="icone-usuario">◉</span>
                <span>Administrador</span>
            </div>

            <h2>Editar Trem</h2>

            <p>Atualize as informações do trem no sistema Info Trem.</p>

        </div>


        <!-- MENSAGENS -->
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


        <!-- CARTÃO DO FORMULÁRIO -->
        <div class="cartao-formulario">

            <!-- CABEÇALHO DO CARTÃO -->
            <div class="formulario-cabecalho">

                <div class="icone-formulario">
                    <i class="bi bi-train-front"></i>
                </div>

                <div>
                    <h3>Informações do trem</h3>
                    <p>Preencha os dados para cadastrar um novo trem.</p>
                </div>

            </div>


            <!-- FORMULÁRIO -->
            <form method="POST" class="form-cadastro-usuario">

                <div class="grade-formulario">

                    <!-- MODELO -->
                    <div class="campo">

                        <label for="modelo">Modelo do trem</label>

                        <input type="text"
                               id="modelo"
                               name="modelo"
                               placeholder="Ex: Modelo A"
                               required>

                    </div>


                    <!-- VELOCIDADE -->
                    <div class="campo">

                        <label for="velocidade">Velocidade limite (km/h)</label>

                        <input type="number"
                               id="velocidade"
                               name="velocidade"
                               placeholder="Ex: 120"
                               required>

                    </div>


                    <!-- LINHA -->
                    <div class="campo">

                        <label for="linha">Linha</label>

                        <input type="text"
                               id="linha"
                               name="linha"
                               placeholder="Ex: Linha 1"
                               required>

                    </div>


                    <!-- CARGA -->
                    <div class="campo">

                        <label for="carga">Carga transportada</label>

                        <input type="text"
                               id="carga"
                               name="carga"
                               placeholder="Ex: Carvão"
                               required>

                    </div>


                    <!-- USUÁRIO -->
                    <div class="campo campo-largo">

                        <label for="usuario_id">Usuário vinculado</label>

                        <select name="usuario_id"
                                id="usuario_id"
                                required>

                            <option value="">Selecione um usuário</option>

                            <?php
                            mysqli_data_seek($resultado, 0);

                            while ($usuario = mysqli_fetch_assoc($resultado)):
                            ?>

                                <option value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
                                    <?= htmlspecialchars($usuario['nome']) ?>
                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                </div>


                <!-- BOTÕES -->
                <div class="acoes-formulario">

                    <button type="button"
                            class="botao-voltar"
                            onclick="window.location.href='../pagina_home.php'">

                        ← Voltar para Cadastro de Trem

                    </button>


                    <button type="submit"
                            class="botao-cadastrar">

                        <i class="bi bi-train-front"></i>
                       Editar Trem

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
