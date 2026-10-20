<?php
session_start();

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// aqui busca os trens cadastrados
$sql = "SELECT * FROM trens ORDER BY id_trem";
$trens = mysqli_query($conn, $sql);

if (!$trens) {
    die("Erro ao consultar os trens: " . mysqli_error($conn));
}
?>

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Administrador</title>
    <!-- Bootstrap Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
</head>

<body>

<div class="d-flex align-items-start">

    <div class="sidebar">

        <!-- Botão de voltar -->
        <button type="button" onclick="history.back()"
            aria-label="Voltar para a página anterior"
            style="position: absolute; top: 10px; left: 165px; background: none; border: none; cursor: pointer; font-size: 20px; color: black;">
            <i class="bi bi-arrow-90deg-left"></i>
        </button>

        <div class="logo">
            <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
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

<!-- Aparece para administrador e usuário comum -->
<a href="../pagina_monitoramento.php" class="menu-link">
    <li>Monitoramento</li>
</a>

<a href="../logout.php" class="menu-link">
    <li>Sair</li>
</a>

        </ul>
    </div>

    <div class="container mt-4">

        <div class="d-flex align-items-center gap-3 mb-5">

            <h2 class="titulo-admin">
                Bem vindo, <?php echo $_SESSION['usuario'] ?? ''; ?>
            </h2>
        </div>

        <div class="table-responsive">

            <table class="table tabela-sensores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificação</th>
                        <th>Modelo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>TR-001</td>
                        <td>Carga</td>
                        <td>Ativo</td>
                        <td>
                            <a href="#" class="excluir">Excluir</a>
                        </td>
                    </tr>

                    <tr>
                        <td>14</td>
                        <td>TR-014</td>
                        <td>Passageiros</td>
                        <td>Em manutenção</td>
                        <td>
                            <a href="#" class="excluir">Excluir</a>
                        </td>
                    </tr>

                    <tr>
                        <td>500</td>
                        <td>TR-500</td>
                        <td>Expresso</td>
                        <td>Ativo</td>
                        <td>
                            <a href="#" class="excluir">Excluir</a>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
