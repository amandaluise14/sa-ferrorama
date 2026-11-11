<?php

include '../infra/conexao.php';
include '../infra/verificar_admin.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_monitoramento.css">

    <title>Monitoramento</title>
</head>

<body>

    <div class="pagina">

        <div class="sidebar">

            <div class="logo">
                <img id="imagem_logo" src="../assets/image/logo_png_branca.png" alt="Logo Info Trem">
            </div>

            <ul>

                <?php if ($_SESSION['cargo'] === 'administrador'): ?>

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

                <a href="logout.php" class="menu-link">
                    <li>Sair</li>
                </a>

            </ul>

        </div>

        <div class="conteudo_pagina">

            <main id="conteudo_monitoramento">

                <h2 class="titulo_monitoramento">Monitoramento</h2>

                <div class="pesquisa_monitoramento">
                    <input type="text" placeholder="Procurar">
                    <button type="button" class="botao_pesquisar">⌕</button>
                    <button type="button" class="botao_ver_todos">Ver todos</button>
                </div>

                <section class="area_monitoramento">

                    <div class="informacoes_linha">

                        <h3>Linha 008</h3>

                        <div class="card_monitoramento">
                            <h4>Localização</h4>
                            <p>Km 12</p>
                            <p>Estação Guanabara</p>
                        </div>

                        <div class="card_monitoramento">
                            <h4>Velocidade</h4>
                            <p>80 km/h</p>
                        </div>

                        <div class="card_monitoramento">
                            <h4>Status operação</h4>
                            <p>Normal</p>
                        </div>

                    </div>

                    <div class="area_graficos">

                        <div class="grafico_monitoramento">

                            <h4>Status</h4>

                            <div class="grafico_barras">
                                <span style="height: 30%;"></span>
                                <span style="height: 80%;"></span>
                                <span style="height: 45%;"></span>
                                <span style="height: 65%;"></span>
                                <span style="height: 80%;"></span>
                                <span style="height: 72%;"></span>
                            </div>

                            <p>Quantidade de passageiros por horário</p>

                        </div>

                        <div class="grafico_monitoramento">

                            <h4>Status</h4>

                            <svg viewBox="0 0 220 120" class="grafico_linha">

                                <path
                                    d="M5 35 C25 55, 35 75, 55 35 S80 100, 100 45 S130 5, 150 50 S180 100, 215 110"
                                    fill="none"
                                    stroke="#a31c1c"
                                    stroke-width="1.8"
                                />

                            </svg>

                            <p>Quantidade de atrasos por dia</p>

                        </div>

                    </div>

                    <div class="area_mapa">

                        <h4>Mapa</h4>

                        <div class="mapa_monitoramento">

                            <svg viewBox="0 0 300 125" preserveAspectRatio="xMidYMid slice">

                                <rect width="300" height="125" fill="#b7c99b"/>

                                <path d="M0 15 Q60 5 90 35 T170 20 T300 30 L300 100 Q240 80 190 110 T80 95 T0 115 Z"
                                    fill="#91b47c"/>

                                <path d="M10 70 Q70 10 130 65 T290 50"
                                    fill="none" stroke="#e7dfbd" stroke-width="13"/>

                                <path d="M10 70 Q70 10 130 65 T290 50"
                                    fill="none" stroke="#ffffff" stroke-width="2"/>

                                <path d="M35 10 Q90 80 150 30 T280 110"
                                    fill="none" stroke="#d9d0ad" stroke-width="8"/>

                                <ellipse cx="225" cy="35" rx="28" ry="16" fill="#8bb9c0"/>
                                <ellipse cx="65" cy="90" rx="20" ry="10" fill="#8bb9c0"/>

                                <g fill="#557d45">
                                    <circle cx="35" cy="25" r="8"/>
                                    <circle cx="55" cy="35" r="10"/>
                                    <circle cx="100" cy="20" r="9"/>
                                    <circle cx="175" cy="90" r="10"/>
                                    <circle cx="260" cy="85" r="9"/>
                                    <circle cx="145" cy="100" r="8"/>
                                </g>

                            </svg>

                        </div>

                    </div>

                </section>

            </main>

        </div>

    </div>

</body>
</html>