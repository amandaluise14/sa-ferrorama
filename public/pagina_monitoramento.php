
<?php
include '../infra/conexao.php';
include '../infra/verificar_admin.php';

// Buscar sensores
$sql = "SELECT * FROM sensores ORDER BY id_sensor DESC";
$resultado = $conn->query($sql);

// Buscar trens
$sql = "SELECT * FROM trens ORDER BY id_trem DESC";
$resultadoTrens = $conn->query($sql);

// Dados do gráfico de velocidade
$sql = "SELECT id_trem, modelo, velocidade FROM trens";
$resultadoVelocidade = $conn->query($sql);
$nomesTrens = [];
$velocidadesTrens = [];

while ($trem = $resultadoVelocidade->fetch_assoc()) {
    $nomesTrens[] = $trem['modelo'];
    $velocidadesTrens[] = $trem['velocidade'];
}

// Dados do gráfico de modelos
$sql = "SELECT modelo, COUNT(*) AS quantidade FROM trens GROUP BY modelo";
$resultadoModelo = $conn->query($sql);
$nomesModelos = [];
$quantidadeModelos = [];

while ($modelo = $resultadoModelo->fetch_assoc()) {
    $nomesModelos[] = $modelo['modelo'];
    $quantidadeModelos[] = $modelo['quantidade'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento | Info Trem</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="pagina">
    <!-- MENU LATERAL -->
    <div class="sidebar">
        <div class="logo">
            <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
        </div>
        <ul>
            <?php if ($_SESSION['cargo'] === 'administrador'): ?>
                <a href="pagina_home.php" class="menu-link">
                    <li><i class="bi bi-house-fill"></i> Início</li>
                </a>
                <a href="usuario/adicionar_usuario.php" class="menu-link">
                    <li><i class="bi bi-person-plus"></i> Adicionar usuário</li>
                </a>
                <a href="rota/adicionar_rota.php" class="menu-link">
                    <li><i class="bi bi-signpost-2"></i> Rotas</li>
                </a>
                <a href="trem/adicionar_trem.php" class="menu-link">
                    <li><i class="bi bi-train-front"></i> Trens</li>
                </a>
                <a href="sensor/adicionar_sensor.php" class="menu-link">
                    <li><i class="bi bi-broadcast-pin"></i> Sensores</li>
                </a>
            <?php endif; ?>
            <a href="pagina_monitoramento.php" class="menu-link">
                <li><i class="bi bi-graph-up"></i> Monitoramento</li>
            </a>
            <br>
            <a href="logout.php" class="menu-link">
                <li><i class="bi bi-box-arrow-right"></i> Sair</li>
            </a>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo-monitoramento">
        <div class="cabecalho-monitoramento">
            <h1>Monitoramento</h1>
            <p>Visualize e acompanhe os sensores e trens do sistema.</p>
        </div>

        <!-- SENSORES -->
        <div class="lista-sensores">
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($sensor = $resultado->fetch_assoc()): ?>
                    <a href="sensor/detalhes_sensor.php?id_sensor=<?= $sensor['id_sensor'] ?>" class="link-sensor">
                        <div class="card-sensor">
                            <div class="icone-sensor">
                                <i class="bi bi-broadcast"></i>
                            </div>
                            <div class="informacoes-sensor">
                                <h3><?= htmlspecialchars($sensor['nome']) ?></h3>
                                <p><?= htmlspecialchars($sensor['descricao_localizacao']) ?></p>
                                <span><?= htmlspecialchars($sensor['dado_monitorado']) ?></span>
                            </div>
                            <i class="bi bi-chevron-right seta-sensor"></i>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="nenhum-sensor">
                    <i class="bi bi-cpu"></i>
                    <strong>Nenhum sensor cadastrado.</strong>
                    <p>Cadastre um sensor para acompanhar suas informações.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- TABELA DE TRENS -->
        <h2 class="titulo-trem">Trens cadastrados</h2>
        <div class="table-responsive">
            <table class="tabela">
                <thead>
                    <tr class="cabecalho-tabela">
                        <th>Modelo</th>
                        <th>Velocidade Limite</th>
                        <th>Linha</th>
                        <th>Carga</th>
                        <th>Usuário responsável</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultadoTrens->num_rows > 0): ?>
                        <?php while ($trem = $resultadoTrens->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($trem['modelo']) ?></td>
                                <td><?= htmlspecialchars($trem['velocidade']) ?></td>
                                <td><?= htmlspecialchars($trem['linha']) ?></td>
                                <td><?= htmlspecialchars($trem['carga']) ?></td>
                                <td><?= htmlspecialchars($trem['usuario_id']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- GRÁFICOS -->
        <h2 class="titulo-trem">Relatórios dos Trens</h2>
        <div class="graficos-trens">
            <div class="card-grafico">
                <h3>Velocidade dos Trens</h3>
                <p>Compare a velocidade registrada em cada trem.</p>
                <div class="area-grafico">
                    <canvas id="graficoVelocidade"></canvas>
                </div>
            </div>
            <div class="card-grafico">
                <h3>Quantidade de Trens por Modelo</h3>
                <p>Veja quantos trens existem de cada modelo.</p>
                <div class="area-grafico">
                    <canvas id="graficoModelo"></canvas>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- DADOS DOS GRÁFICOS -->
<script>
window.dadosGraficos = {
    nomesTrens: <?= json_encode($nomesTrens) ?>,
    velocidadesTrens: <?= json_encode($velocidadesTrens) ?>,
    nomesModelos: <?= json_encode($nomesModelos) ?>,
    quantidadeModelos: <?= json_encode($quantidadeModelos) ?>
};
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/graficos_trens.js"></script>
</body>
</html>
