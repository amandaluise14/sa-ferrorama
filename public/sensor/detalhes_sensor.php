
<?php
include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

// Receber ID do sensor
$id_sensor = $_GET['id_sensor'] ?? 0;
$sensor = null;
$rota = null;

// Buscar sensor
if ($id_sensor) {
    $sql = "SELECT * FROM sensores WHERE id_sensor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sensor);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $sensor = $resultado->fetch_assoc();
    $stmt->close();

    // Buscar rota
    if ($sensor && $sensor['rota_id']) {
        $id_rota = $sensor['rota_id'];
        $sql = "SELECT * FROM rotas WHERE id_rota = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_rota);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $rota = $resultado->fetch_assoc();
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Detalhes do Sensor | Info Trem</title>
</head>
<body>
<div class="pagina">
    <!-- MENU LATERAL -->
    <div class="sidebar">
        <div class="logo">
            <img id="imagem_logo" src="../../assets/image/logo_png_branca.png" alt="Logo Info Trem">
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

    <!-- CONTEÚDO -->
    <div class="conteudo_pagina conteudo-detalhes">
        <main id="conteudo_detalhes">
            <a href="../pagina_monitoramento.php" class="botao-voltar">
                <i class="bi bi-arrow-left"></i> Voltar ao monitoramento
            </a>

            <?php if ($sensor): ?>
                <!-- CABEÇALHO -->
                <div class="cabecalho-detalhes">
                    <h1>
                        <i class="bi bi-cpu"></i>
                        <?= htmlspecialchars($sensor['nome']) ?>
                    </h1>
                    <div class="status_operacao">
                        <span class="bolinha_status"></span>
                        Operação normal
                    </div>
                </div>

                <!-- DADOS DO SENSOR -->
                <section class="painel-detalhes">
                    <h2 class="titulo-secao">
                        <i class="bi bi-broadcast-pin"></i> Dados do sensor
                    </h2>
                    <div class="grade-informacoes">
                        <div class="informacao">
                            <span>ID do sensor</span>
                            <p>#<?= $sensor['id_sensor'] ?></p>
                        </div>
                        <div class="informacao">
                            <span>Nome do sensor</span>
                            <p><?= htmlspecialchars($sensor['nome']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Descrição da localização</span>
                            <p><?= htmlspecialchars($sensor['descricao_localizacao']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Dado monitorado</span>
                            <p><?= htmlspecialchars($sensor['dado_monitorado']) ?></p>
                        </div>
                    </div>
                </section>

                <!-- DADOS DA ROTA -->
                <section class="painel-detalhes">
                    <h2 class="titulo-secao">
                        <i class="bi bi-signpost-2"></i> Informações da rota
                    </h2>
                    <img src="../../assets/image/rota_ilustrativa.png" alt="Imagem ilustrativa de uma ferrovia" class="imagem_rota">
                    <div class="grade-informacoes">
                        <div class="informacao">
                            <span>Nome da rota</span>
                            <p><?= htmlspecialchars($rota['nome']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Estação de origem</span>
                            <p><?= htmlspecialchars($rota['estacao_origem']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Estação de destino</span>
                            <p><?= htmlspecialchars($rota['estacao_destino']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Distância total</span>
                            <p><?= htmlspecialchars($rota['distancia_total']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Duração</span>
                            <p><?= htmlspecialchars($rota['duracao']) ?></p>
                        </div>
                        <div class="informacao">
                            <span>Descrição da rota</span>
                            <p><?= htmlspecialchars($rota['descricao']) ?></p>
                        </div>
                    </div>
                </section>
            <?php else: ?>
                <!-- SENSOR NÃO ENCONTRADO -->
                <div class="mensagem-erro">
                    <i class="bi bi-exclamation-circle"></i>
                    <h2>Sensor não encontrado</h2>
                    <p>O sensor solicitado não existe ou o identificador informado é inválido.</p>
                    <a href="../pagina_monitoramento.php" class="botao-retornar">
                        <i class="bi bi-arrow-left"></i> Voltar ao monitoramento
                    </a>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
</body>
</html>
<?php
$conn->close();
?>
