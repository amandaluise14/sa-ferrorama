
<?php

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

function esc($valor)
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

// Recebe o ID do sensor enviado pela página de monitoramento
$id_sensor = filter_input(INPUT_GET, 'id_sensor', FILTER_VALIDATE_INT);

$sensor = null;

if ($id_sensor) {

    $sql = "SELECT
                sensores.*,

                rotas.nome AS nome_rota,
                rotas.estacao_origem,
                rotas.estacao_destino,
                rotas.distancia_total,
                rotas.descricao AS descricao_rota,
                rotas.duracao

            FROM sensores

            LEFT JOIN rotas
                ON sensores.rota_id = rotas.id_rota

            WHERE sensores.id_sensor = ?

            LIMIT 1";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("i", $id_sensor);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $sensor = $resultado->fetch_assoc();

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Detalhes do Sensor | Info Trem</title>

</head>

<body>

<div class="pagina">

    <!-- MENU LATERAL -->

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

            <a
                href="../pagina_monitoramento.php"
                class="botao-voltar">

                <i class="bi bi-arrow-left"></i>

                Voltar ao monitoramento

            </a>

            <?php if ($sensor): ?>

                <!-- CABEÇALHO -->

                <div class="cabecalho-detalhes">

                    <h1>
                        <i class="bi bi-cpu"></i>

                        <?= esc($sensor['nome']) ?>
                    </h1>

                    <p>
                        Informações do sensor
                        #<?= (int) $sensor['id_sensor'] ?>
                    </p>

                        <div class="status_operacao">
                        <span class="bolinha_status"></span>
                        Operação normal
                        </div>
                </div>

                <!-- INFORMAÇÕES DO SENSOR -->

                <section class="painel-detalhes">

                    <h2 class="titulo-secao">

                        <i class="bi bi-broadcast-pin"></i>

                        Dados do sensor

                    </h2>

                    <div class="grade-informacoes">

                        <div class="informacao">

                            <span>ID do sensor</span>

                            <p>
                                #<?= (int) $sensor['id_sensor'] ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Nome do sensor</span>

                            <p>
                                <?= esc($sensor['nome']) ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Descrição da localização</span>

                            <p>
                                <?= esc($sensor['descricao_localizacao']) ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Dado monitorado</span>

                            <p>
                                <?= esc($sensor['dado_monitorado']) ?>
                            </p>

                        </div>

                    </div>

                </section>

                <!-- INFORMAÇÕES DA ROTA -->

                <section class="painel-detalhes">

                    <h2 class="titulo-secao">

                        <i class="bi bi-signpost-2"></i>

                        Informações da rota

                    </h2>

                    <img
            src="../../assets/image/rota_ilustrativa.png"
            alt="Imagem ilustrativa de uma ferrovia"
            class="imagem_rota"
        >

                    <div class="grade-informacoes">

                        <div class="informacao">

                            <span>Nome da rota</span>

                            <p>
                                <?= esc($sensor['nome_rota'] ?: 'Sem rota vinculada') ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Estação de origem</span>

                            <p>
                                <?= esc($sensor['estacao_origem'] ?: 'Não informada') ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Estação de destino</span>

                            <p>
                                <?= esc($sensor['estacao_destino'] ?: 'Não informada') ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Distância total</span>

                            <p>
                                <?= esc($sensor['distancia_total'] ?: 'Não informada') ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Duração</span>

                            <p>
                                <?= esc($sensor['duracao'] ?: 'Não informada') ?>
                            </p>

                        </div>

                        <div class="informacao">

                            <span>Descrição da rota</span>

                            <p>
                                <?= esc($sensor['descricao_rota'] ?: 'Não informada') ?>
                            </p>

                        </div>

                    </div>

                </section>

            <?php else: ?>

                <!-- SENSOR NÃO ENCONTRADO -->

                <div class="mensagem-erro">

                    <i class="bi bi-exclamation-circle"></i>

                    <h2>Sensor não encontrado</h2>

                    <p>
                        O sensor solicitado não existe ou o identificador
                        informado é inválido.
                    </p>

                    <a
                        href="../pagina_monitoramento.php"
                        class="botao-retornar">

                        <i class="bi bi-arrow-left"></i>

                        Voltar ao monitoramento

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
