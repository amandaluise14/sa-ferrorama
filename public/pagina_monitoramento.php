
<?php

include '../infra/conexao.php';
include '../infra/verificar_admin.php';

function esc($valor)
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

// Pesquisa
$busca = trim($_GET['busca'] ?? '');

// Consulta dos sensores
$sql = "SELECT
            sensores.*,
            rotas.nome AS nome_rota
        FROM sensores
        LEFT JOIN rotas
            ON sensores.rota_id = rotas.id_rota";

if ($busca !== '') {

    $sql .= " WHERE
                CAST(sensores.id_sensor AS CHAR) LIKE ?
                OR sensores.nome LIKE ?
                OR sensores.descricao_localizacao LIKE ?
                OR sensores.dado_monitorado LIKE ?
                OR rotas.nome LIKE ?";

    $stmt = $conn->prepare($sql);

    $termo = '%' . $busca . '%';

    $stmt->bind_param(
        "sssss",
        $termo,
        $termo,
        $termo,
        $termo,
        $termo
    );

    $stmt->execute();

    $resultado = $stmt->get_result();

} else {

    $sql .= " ORDER BY sensores.id_sensor DESC";

    $resultado = $conn->query($sql);

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitoramento | Info Trem</title>

    <link rel="stylesheet" href="../style/style.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

</head>

<body>

<div class="pagina">

    <!-- MENU LATERAL -->

    <aside class="sidebar">

        <div class="logo">

            <img
                id="imagem_logo"
                src="../assets/image/logo_png_branca.png"
                alt="Logo Info Trem"
            >

        </div>

        <ul>

            <?php if (($_SESSION['cargo'] ?? '') === 'administrador'): ?>

                <a href="pagina_home.php" class="menu-link">
                    <li>Início</li>
                </a>

                <a href="pagina_relatorios.php" class="menu-link">
                    <li>Relatórios</li>
                </a>

                <a href="usuario/adicionar_usuario.php" class="menu-link">
                    <li>Adicionar usuário</li>
                </a>

            <?php endif; ?>

            <a href="pagina_monitoramento.php" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="sensor/listar_sensor.php" class="menu-link">
                <li>Listar sensores</li>
            </a>

            <a href="logout.php" class="menu-link">
                <li>Sair</li>
            </a>

        </ul>

    </aside>

    <!-- CONTEÚDO -->

    <main class="conteudo-monitoramento">

        <!-- CABEÇALHO -->

        <div class="cabecalho-monitoramento">

            <h1>Monitoramento</h1>

            <p>
                Visualize e acompanhe os sensores do sistema.
            </p>

        </div>

        <!-- PESQUISA -->

        <form method="GET" class="formulario-busca">

            <div class="campo-busca">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="busca"
                    placeholder="Pesquisar sensor..."
                    value="<?= esc($busca) ?>"
                >

            </div>

            <button type="submit" class="botao-buscar">
                Pesquisar
            </button>

        </form>

        <!-- CARDS DOS SENSORES -->

        <div class="lista-sensores">

            <?php if ($resultado && $resultado->num_rows > 0): ?>

                <?php while ($sensor = $resultado->fetch_assoc()): ?>

                    <a
                        href="sensor/detalhes_sensor.php?id_sensor=<?= (int) $sensor['id_sensor'] ?>"
                        class="link-sensor"
                    >

                        <div class="card-sensor">

                            <div class="icone-sensor">

                                <i class="bi bi-broadcast"></i>

                            </div>

                            <div class="informacoes-sensor">

                                <h3>
                                    <?= esc($sensor['nome']) ?>
                                </h3>

                                <p>
                                    <?= esc($sensor['descricao_localizacao'] ?: 'Localização não informada') ?>
                                </p>

                                <span>
                                    <?= esc($sensor['dado_monitorado'] ?: 'Dado não informado') ?>
                                </span>

                            </div>

                            <i class="bi bi-chevron-right seta-sensor"></i>

                        </div>

                    </a>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="nenhum-sensor">

                    <i class="bi bi-cpu"></i>

                    <strong>Nenhum sensor encontrado.</strong>

                    <p>
                        Verifique a pesquisa ou cadastre um novo sensor.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </main>

</div>

</body>
</html>

<?php

if (isset($stmt)) {
    $stmt->close();
}

?>
