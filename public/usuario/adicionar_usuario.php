<?php 


include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
$erro = '';
$sucesso = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST ['telefone'];
    $cpf = $_POST ['cpf'];
    $cargo = $_POST ['cargo'];
    $data_nascimento = $_POST ['data_nascimento'];
    $status_usuario = $_POST ['status_usuario'];


    // Cria um hash seguro para a senha 
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
    // Dados do endereço
    $cep = preg_replace('/\D/', '', $_POST['cep']);
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = strtoupper($_POST['uf']);


    // Inicia a transação para evitar cadastros incompletos
    $conn->begin_transaction();


    try {


        // Cadastra o endereço
        $sqlEndereco = "INSERT INTO enderecos
        (cep, logradouro, bairro, cidade, uf)
        VALUES (?, ?, ?, ?, ?)";


        $stmtEndereco = $conn->prepare($sqlEndereco);


        $stmtEndereco->bind_param(
            "sssss",
            $cep,
            $endereco,
            $bairro,
            $cidade,
            $uf
        );


        if (!$stmtEndereco->execute()) {
            throw new Exception($stmtEndereco->error);
        }


        // Recupera o ID do endereço cadastrado
        $id_endereco = $conn->insert_id;


        $stmtEndereco->close();




    $sql = "INSERT INTO usuarios
(nome, email, senha, telefone, cpf, cargo,
data_nascimento, status_usuario, id_endereco)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


$stmt->bind_param(
    "ssssssssi",
    $nome,
    $email,
    $senhaHash,
    $telefone,
    $cpf,
    $cargo,
    $data_nascimento,
    $status_usuario,
    $id_endereco
);
    if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }


        $stmt->close();


        // Confirma os cadastros
        $conn->commit();


        $sucesso = "Novo usuário/administrador cadastrado!";


    } catch (Exception $e) {


        // Desfaz o cadastro se ocorrer um erro
        $conn->rollback();


        $erro = "Erro ao cadastrar usuário/administrador: "
              . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">
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
            <a href="../pagina_home.php" class="menu-link">
                <li>Início</li>
            </a>

            <a href="../pagina_relatorios.php" class="menu-link">
                <li>Relatórios</li>
            </a>

            <a href="adicionar_usuario.php" class="menu-link">
                <li class="active">Adicionar usuário</li>
            </a>

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

            <h2>Cadastrar Usuário</h2>

            <p>Cadastre um novo usuário ou administrador no sistema Info Trem.</p>

        </div>

        <!-- MENSAGENS -->
        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($sucesso) ?>
            </div>
        <?php endif; ?>

        <!-- CARTÃO DO FORMULÁRIO -->
        <div class="cartao-formulario">

            <div class="formulario-cabecalho">

                <div class="icone-formulario">♙</div>

                <div>
                    <h3>Informações da conta</h3>
                    <p>Preencha os dados para cadastrar uma nova conta.</p>
                </div>

            </div>

            <form method="POST" class="form-cadastro-usuario">

                <div class="grade-formulario">

                    <div class="campo">
                        <label for="nome">Nome completo</label>
                        <input type="text" id="nome" name="nome"
                               placeholder="Digite o nome completo" required>
                    </div>

                    <div class="campo">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf"
                               placeholder="Digite o CPF" required>
                    </div>

                    <div class="campo">
                        <label for="data_nascimento">Data de nascimento</label>
                        <input type="date" id="data_nascimento"
                               name="data_nascimento" required>
                    </div>

                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email"
                               placeholder="exemplo@email.com" required>
                    </div>

                    <div class="campo">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone"
                               placeholder="(47) 99999-9999" required>
                    </div>

                    <div class="campo">
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep"
                               placeholder="Digite o CEP" maxlength="9" required>
                    </div>

                    <div class="campo campo-largo">
                        <label for="endereco">Logradouro</label>
                        <input type="text" id="endereco" name="endereco"
                               placeholder="Rua ou avenida" required>
                    </div>

                    <div class="campo">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro"
                               placeholder="Digite o bairro" required>
                    </div>

                    <div class="campo">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade"
                               placeholder="Digite a cidade" required>
                    </div>

                    <div class="campo">
                        <label for="uf">Estado (UF)</label>
                        <input type="text" id="uf" name="uf"
                               placeholder="Ex: SC" maxlength="2" required>
                    </div>

                    <div class="campo">
                        <label for="senha">Senha inicial</label>
                        <input type="password" id="senha" name="senha"
                               placeholder="Crie uma senha" required>
                    </div>

                    <div class="campo">
                        <label for="cargo">Tipo de conta</label>

                        <select id="cargo" name="cargo" required>
                            <option value="">Selecione o tipo de conta</option>
                            <option value="administrador">Administrador</option>
                            <option value="usuário">Usuário</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="status_usuario">Status da conta</label>

                        <select id="status_usuario" name="status_usuario" required>
                            <option value="">Selecione o status</option>
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                    </div>

                </div>

                <!-- BOTÕES -->
                <div class="acoes-formulario">

                    <button type="button" class="botao-voltar"
                            onclick="window.location.href='visualizar_usuario.php';">
                        ← Visualizar Usuários Cadastrados
                    </button>

                    <button type="submit" class="botao-cadastrar">
                        ♙ Cadastrar usuário
                    </button>
                    

                </div>

            </form>

        </div>

    </main>

</div>

<script>
document.getElementById('cep').addEventListener('blur', async function () {

    const cep = this.value.replace(/\D/g, '');

    if (cep.length !== 8) {
        return;
    }

    try {
        const resposta = await fetch(
            'https://viacep.com.br/ws/' + cep + '/json/'
        );

        if (!resposta.ok) {
            throw new Error('Falha na consulta');
        }

        const dados = await resposta.json();

        if (dados.erro) {
            alert('CEP não encontrado!');
            return;
        }

        document.getElementById('cep').value = dados.cep || '';
        document.getElementById('endereco').value = dados.logradouro || '';
        document.getElementById('bairro').value = dados.bairro || '';
        document.getElementById('cidade').value = dados.localidade || '';
        document.getElementById('uf').value = dados.uf || '';

    } catch (erro) {
        alert('Não foi possível consultar o CEP.');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
