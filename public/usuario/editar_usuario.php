<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

$erro = '';
$sucesso = '';

$id_usuario = (int) ($_GET['id_usuario'] ?? 0);

if ($id_usuario <= 0) {
    die("ID do usuário não foi enviado.");
}

// BUSCAR DADOS DO USUÁRIO E DO ENDEREÇO
$sql = "SELECT usuarios.*, 
               enderecos.cep,
               enderecos.logradouro,
               enderecos.bairro,
               enderecos.cidade,
               enderecos.uf
        FROM usuarios
        LEFT JOIN enderecos
        ON usuarios.id_endereco = enderecos.id_endereco
        WHERE usuarios.id_usuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

$stmt->close();

if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $data_nascimento = $_POST['data_nascimento'];
    $status_usuario = $_POST['status_usuario'];

    // DADOS DO ENDEREÇO
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    $conn->begin_transaction();

    try {

        if (!empty($usuario['id_endereco'])) {

            $sql = "UPDATE enderecos SET
                    cep = ?,
                    logradouro = ?,
                    bairro = ?,
                    cidade = ?,
                    uf = ?
                    WHERE id_endereco = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "sssssi",
                $cep,
                $logradouro,
                $bairro,
                $cidade,
                $uf,
                $usuario['id_endereco']
            );

            $stmt->execute();
            $stmt->close();

            $id_endereco = $usuario['id_endereco'];

        } else {

            $sql = "INSERT INTO enderecos
                    (cep, logradouro, bairro, cidade, uf)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "sssss",
                $cep,
                $logradouro,
                $bairro,
                $cidade,
                $uf
            );

            $stmt->execute();

            $id_endereco = $conn->insert_id;

            $stmt->close();
        }

        if ($senha !== '') {

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "UPDATE usuarios SET
                    nome = ?,
                    email = ?,
                    senha = ?,
                    telefone = ?,
                    cpf = ?,
                    cargo = ?,
                    data_nascimento = ?,
                    status_usuario = ?,
                    id_endereco = ?
                    WHERE id_usuario = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "ssssssssii",
                $nome,
                $email,
                $senhaHash,
                $telefone,
                $cpf,
                $cargo,
                $data_nascimento,
                $status_usuario,
                $id_endereco,
                $id_usuario
            );

        } else {

            $sql = "UPDATE usuarios SET
                    nome = ?,
                    email = ?,
                    telefone = ?,
                    cpf = ?,
                    cargo = ?,
                    data_nascimento = ?,
                    status_usuario = ?,
                    id_endereco = ?
                    WHERE id_usuario = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "sssssssii",
                $nome,
                $email,
                $telefone,
                $cpf,
                $cargo,
                $data_nascimento,
                $status_usuario,
                $id_endereco,
                $id_usuario
            );
        }

        $stmt->execute();
        $stmt->close();

        $conn->commit();

        $sucesso = "Usuário atualizado com sucesso!";

        $stmt = $conn->prepare($sql = "SELECT usuarios.*, 
                                             enderecos.cep,
                                             enderecos.logradouro,
                                             enderecos.bairro,
                                             enderecos.cidade,
                                             enderecos.uf
                                      FROM usuarios
                                      LEFT JOIN enderecos
                                      ON usuarios.id_endereco = enderecos.id_endereco
                                      WHERE usuarios.id_usuario = ?");

        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        $stmt->close();

    } catch (Exception $e) {

        $conn->rollback();
        $erro = "Erro ao atualizar usuário: " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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

    <!-- ÁREA PRINCIPAL -->
    <main class="area-cadastro">

        <!-- CABEÇALHO -->
        <div class="cabecalho-pagina">

            <div class="usuario-logado">
                <span class="icone-usuario">◉</span>
                <span>Administrador</span>
            </div>

            <h2>Editar Usuário</h2>

            <p>Atualize as informações do usuário abaixo.</p>

        </div>

        <!-- MENSAGEM DE ERRO -->
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

        <!-- MENSAGEM DE SUCESSO -->
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

            <div class="formulario-cabecalho">

                <div class="icone-formulario">
                    <i class="bi bi-person-gear"></i>
                </div>

                <div>
                    <h3>Informações do usuário</h3>
                    <p>Atualize os dados cadastrais e as permissões do usuário.</p>
                </div>

            </div>

            <form method="POST" class="form-cadastro-usuario">

                <div class="grade-formulario">

                    <!-- NOME -->
                    <div class="campo">
                        <label for="nome">Nome completo</label>

                        <input type="text"
                               id="nome"
                               name="nome"
                               value="<?= htmlspecialchars($usuario['nome']) ?>"
                               placeholder="Nome completo"
                               required>
                    </div>

                    <!-- EMAIL -->
                    <div class="campo">
                        <label for="email">E-mail</label>

                        <input type="email"
                               id="email"
                               name="email"
                               value="<?= htmlspecialchars($usuario['email']) ?>"
                               placeholder="exemplo@email.com"
                               required>
                    </div>

                    <!-- SENHA -->
                    <div class="campo">
                        <label for="senha">Nova senha</label>

                        <input type="password"
                               id="senha"
                               name="senha"
                               placeholder="Deixe vazio para manter a senha atual">
                    </div>

                    <!-- TELEFONE -->
                    <div class="campo">
                        <label for="telefone">Telefone</label>

                        <input type="tel"
                               id="telefone"
                               name="telefone"
                               value="<?= htmlspecialchars($usuario['telefone']) ?>"
                               placeholder="(47) 99999-9999"
                               required>
                    </div>

                    
<!-- ENDEREÇO -->
<div class="campo">
    <label for="cep">CEP</label>
    <input type="text"
           id="cep"
           name="cep"
           value="<?= htmlspecialchars($usuario['cep'] ?? '') ?>"
           placeholder="00000-000"
           required>
</div>

<div class="campo campo-largo">
    <label for="logradouro">Logradouro</label>
    <input type="text"
           id="logradouro"
           name="logradouro"
           value="<?= htmlspecialchars($usuario['logradouro'] ?? '') ?>"
           placeholder="Rua, número e complemento"
           required>
</div>

<div class="campo">
    <label for="bairro">Bairro</label>
    <input type="text"
           id="bairro"
           name="bairro"
           value="<?= htmlspecialchars($usuario['bairro'] ?? '') ?>"
           placeholder="Bairro"
           required>
</div>

<div class="campo">
    <label for="cidade">Cidade</label>
    <input type="text"
           id="cidade"
           name="cidade"
           value="<?= htmlspecialchars($usuario['cidade'] ?? '') ?>"
           placeholder="Cidade"
           required>
</div>

<div class="campo">
    <label for="uf">Estado (UF)</label>
    <input type="text"
           id="uf"
           name="uf"
           maxlength="2"
           value="<?= htmlspecialchars($enderecos['uf'] ?? '') ?>"
           placeholder="SC"
           required>
</div>


                    <!-- CPF -->
                    <div class="campo">
                        <label for="cpf">CPF</label>

                        <input type="text"
                               id="cpf"
                               name="cpf"
                               value="<?= htmlspecialchars($usuario['cpf']) ?>"
                               placeholder="000.000.000-00"
                               required>
                    </div>

                    <!-- DATA DE NASCIMENTO -->
                    <div class="campo">
                        <label for="data_nascimento">Data de nascimento</label>

                        <input type="date"
                               id="data_nascimento"
                               name="data_nascimento"
                               value="<?= htmlspecialchars($usuario['data_nascimento']) ?>"
                               required>
                    </div>

                    <!-- CARGO -->
                    <div class="campo">

                        <label for="cargo">Cargo</label>

                        <select name="cargo" id="cargo" required>

                            <option value="">Selecione o cargo</option>

                            <option value="administrador"
                                <?= ($usuario['cargo'] === 'administrador') ? 'selected' : '' ?>>
                                Administrador
                            </option>

                            <option value="usuário"
                                <?= ($usuario['cargo'] === 'usuário') ? 'selected' : '' ?>>
                                Usuário
                            </option>

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div class="campo">

                        <label for="status_usuario">Status</label>

                        <select name="status_usuario"
                                id="status_usuario"
                                required>

                            <option value="">Selecione o status</option>

                            <option value="ativo"
                                <?= ($usuario['status_usuario'] === 'ativo') ? 'selected' : '' ?>>
                                Ativo
                            </option>

                            <option value="inativo"
                                <?= ($usuario['status_usuario'] === 'inativo') ? 'selected' : '' ?>>
                                Inativo
                            </option>

                        </select>

                    </div>

                </div>

                <!-- BOTÕES -->
                <div class="acoes-formulario">

                    <button type="button"
                            class="botao-voltar"
                            onclick="window.location.href='visualizar_usuario.php';">

                        ← Visualizar usuários cadastrados

                    </button>

                    <button type="submit"
                            class="botao-cadastrar">

                        <i class="bi bi-person-check"></i>
                        Editar usuário

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
