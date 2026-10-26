<?php
include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';
//mensagem de erro e sucesso ao excluir
$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'excluido') {
    $mensagem = 'Usuário excluído com sucesso!';
    $tipoMensagem = 'success';
} elseif (isset($_GET['erro'])) {
    if ($_GET['erro'] === 'nao_encontrado') {
        $mensagem = 'O usuário não foi encontrado.';
    } else {
        $mensagem = 'Erro ao excluir o usuário. Tente novamente.';
    }

    $tipoMensagem = 'danger';
}
// Recebe os filtros
$pesquisa = trim($_POST['pesquisar'] ?? '');
$cargo = $_POST['cargo'] ?? '';
$status = $_POST['status'] ?? '';

$busca = "%{$pesquisa}%";

// Consulta de usuários com filtros
$sql = "SELECT * FROM usuarios
        WHERE (? = '' OR nome LIKE ? OR email LIKE ?)
        AND (? = '' OR cargo = ?)
        AND (? = '' OR status_usuario = ?)
        ORDER BY id_usuario";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssss",
    $pesquisa,
    $busca,
    $busca,
    $cargo,
    $cargo,
    $status,
    $status
);

$stmt->execute();
$usuarios = $stmt->get_result();

// Total de funcionários
$sqlTotal = "SELECT COUNT(*) AS total FROM usuarios";
$resultadoTotal = $conn->query($sqlTotal);
$totalFuncionarios = $resultadoTotal->fetch_assoc()['total'];

// Total de administradores
$sqlAdmins = "SELECT COUNT(*) AS total
              FROM usuarios
              WHERE cargo = 'administrador'";
$resultadoAdmins = $conn->query($sqlAdmins);
$totalAdmins = $resultadoAdmins->fetch_assoc()['total'];

// Total de usuários comuns
$sqlUsuarios = "SELECT COUNT(*) AS total
                FROM usuarios
                WHERE cargo = 'usuário'";
$resultadoUsuarios = $conn->query($sqlUsuarios);
$totalUsuarios = $resultadoUsuarios->fetch_assoc()['total'];

// Total de usuários ativos
$sqlAtivos = "SELECT COUNT(*) AS total
              FROM usuarios
              WHERE status_usuario = 'ativo'";
$resultadoAtivos = $conn->query($sqlAtivos);
$totalAtivos = $resultadoAtivos->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visualizar Usuários/Administradores</title>
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"> 
     

    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>

<div class="pagina">

    <div class="sidebar">

        <div class="logo">
            <img
                id="imagem_logo"
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

                <a href="adicionar_usuario.php" class="menu-link">
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

    <div class="formulario-container">
        <?php if (!empty($mensagem)): ?>
    <div class="alert alert-<?= $tipoMensagem ?> alert-dismissible fade show
                position-fixed top-0 start-50 translate-middle-x mt-3"
         role="alert"
         style="z-index: 1055; width: 90%; max-width: 500px;">

        <?php if ($tipoMensagem === 'success'): ?>
            <strong>✅ Sucesso!</strong>
        <?php else: ?>
            <strong>⚠️ Atenção!</strong>
        <?php endif; ?>

        <?= htmlspecialchars($mensagem) ?>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar">
        </button>
    </div>
<?php endif; ?>

        <form method="POST" class="forms">

            <h2 id="titulo-admin">
                Visualizar Usuários/Administradores
            </h2>

            <div class="conteudo">

    
                <section class="cards">

                    <div class="card-total">
                        <h5>Total de Funcionários</h5>
                        <p><?php echo $totalFuncionarios; ?></p>
                    </div>

                    <div class="card-total">
                        <h5>Total de Administradores</h5>
                        <p><?php echo $totalAdmins; ?></p>
                    </div>

                    <div class="card-total">
                        <h5>Total de Usuários</h5>
                        <p><?php echo $totalUsuarios; ?></p>
                    </div>

                    <div class="card-total">
                        <h5>Total de Usuários Ativos</h5>
                        <p><?php echo $totalAtivos; ?></p>
                    </div>

                </section>

        
                <section class="filtros">

                    <input
                        type="text"
                        id="pesquisar"
                        name="pesquisar"
                        placeholder="Buscar por nome ou e-mail"
                        value="<?php echo htmlspecialchars($pesquisa, ENT_QUOTES, 'UTF-8'); ?>">

                    <select id="conta" name="cargo">

                        <option value="">Tipo de conta</option>

                        <option
                            value="administrador"
                            <?php echo ($cargo === 'administrador') ? 'selected' : ''; ?>>
                            Administrador
                        </option>

                        <option
                            value="usuário"
                            <?php echo ($cargo === 'usuário') ? 'selected' : ''; ?>>
                            Usuário
                        </option>

                    </select>

                    <select id="status" name="status">

                        <option value="">Status</option>

                        <option
                            value="ativo"
                            <?php echo ($status === 'ativo') ? 'selected' : ''; ?>>
                            Ativo
                        </option>

                        <option
                            value="inativo"
                            <?php echo ($status === 'inativo') ? 'selected' : ''; ?>>
                            Inativo
                        </option>

                    </select>

                    <button type="submit" id="botaofiltrar">
                        Filtrar
                    </button>

                    <button
                        type="button"
                        onclick="window.location.href=window.location.pathname">
                        Limpar filtros
                    </button>

                </section>

                <table class="tabela">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th>Data de Nascimento</th>
                            <th>CPF</th>
                            <th>Tipo de conta</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($usuarios->num_rows > 0): ?>

                            <?php while ($usuario = $usuarios->fetch_assoc()): ?>

                                <tr>

                         <td><?php echo $usuario['id_usuario']; ?></td>
                                    <td><?php echo $usuario['nome']; ?></td>
                                    <td><?php echo $usuario['email']; ?></td>
                                    <td><?php echo $usuario['telefone']; ?></td>
                                    <td><?php echo $usuario['endereco']; ?></td>
                                    <td><?php echo $usuario['data_nascimento']; ?></td>
                                    <td><?php $cpf = $usuario['cpf']; echo '***.***.***-' . substr($cpf, -2);?></td>
                                    <td><?php echo $usuario['cargo']; ?></td>
                                    <td><?php echo $usuario['status_usuario']; ?></td>
                                    <td>

                                        <button class="editar acao-tooltip"
                                            data-tooltip="Editar"
                                            type="button"
                                            onclick="window.location.href='editar_usuario.php?id_usuario=<?php echo (int) $usuario['id_usuario']; ?>'">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button
                                            class="excluir acao-tooltip"
                                            data-tooltip="Excluir"
                                            type="button"
                                            onclick="if (confirm('Tem certeza que deseja excluir este usuário?')) {
                                                window.location.href='excluir_usuario.php?id=<?php echo (int) $usuario['id_usuario']; ?>';
                                            }">

                                            <i class="bi bi-person-dash-fill"></i>

                                        </button>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </table>
                        <button class="botaoVisualizar" type="button"
                            onclick="window.location.href='adicionar_usuario.php';">Voltar para adicionar Usuário/administrador</button>

                        <?php else: ?>

                            <tr>
                                <td colspan="10">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

                <button
                    class="botaoVisualizar"
                    type="button"
                    onclick="window.location.href='adicionar_usuario.php'">

                    Ir para adicionar

                </button>

            </div>

        </form>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Foi utilizado ajuda da inteligência artrificial para auxiliar na criação da funcionalidade da pesquisa e filtros  -->
