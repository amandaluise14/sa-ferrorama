<?php
session_start();
include '../infra/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

 $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
 echo "senhaHash". $senhaHash;

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param("s", $email);

    if (!$stmt->execute()) {
        die("Erro no execute: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['cargo'] = $usuario['cargo'];

            header("Location: pagina_monitoramento.php");
            exit;
        } else {
            $erro = "Senha incorreta! Tente novamente.";
        }
    } else {
        $erro = "E-mail não encontrado!";
         echo "senhaHash". $senhaHash;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login InfoTrem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3"
             role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">
            <strong>Ops!</strong>
            <?= htmlspecialchars($erro) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>

    <section id="pagina_login">

       
        <div id="lado_imagem">
            <div class="conteudo_imagem">
                <h1>InfoTrem</h1>
                <p>Tecnologia e monitoramento ferroviário.</p>
            </div>
        </div>

        <div id="lado_login">
            <div class="box_login">
                <h2>Bem-vindo ao InfoTrem!</h2>
                <p class="subtitulo">Preencha os dados abaixo para realizar login no site.</p>

                <form action="login.php" method="POST">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                    <input type="submit" class="button_login" value="Entrar">
                </form>
            </div>
        </div>

    </section>

     <!-- LANDING PAGE -->
    <main id="landing_page">

        <!-- APRESENTAÇÃO -->
        <section class="landing_inicio">
            <div class="landing_conteudo">
                <span class="landing_etiqueta">SISTEMA DE GERENCIAMENTO FERROVIÁRIO</span>

                <h1>Mais controle e tecnologia para o transporte ferroviário</h1>

                <p>
                    Uma plataforma desenvolvida para organizar, gerenciar e monitorar
                    informações ferroviárias, integrando tecnologia e Internet das Coisas (IoT).
                </p>

                <a href="#sobre_sistema" class="landing_botao">Conheça o sistema</a>
            </div>
        </section>

        <!-- SOBRE O SISTEMA -->
        <section id="sobre_sistema" class="landing_secao">
            <div class="landing_texto">
                <span class="landing_etiqueta">SOBRE O PROJETO</span>

                <h2>Por que o InfoTrem?</h2>

                <p>
                    O gerenciamento ferroviário envolve diversas informações,
                    como trens, linhas, rotas e sensores. Quando esses dados ficam
                    desorganizados, acompanhar a operação pode se tornar mais difícil.
                </p>

                <p>
                    O InfoTrem foi desenvolvido para centralizar essas informações
                    em uma única plataforma, facilitando o acompanhamento dos dados
                    e auxiliando na organização da operação ferroviária.
                </p>
            </div>
        </section>

        <!-- FUNCIONALIDADES -->
        <section class="landing_funcionalidades">

            <div class="landing_titulo">
                <span class="landing_etiqueta">FUNCIONALIDADES</span>

                <h2>O que o sistema oferece?</h2>

                <p>Recursos para facilitar o gerenciamento e o monitoramento ferroviário.</p>
            </div>

            <div class="landing_cards">

                <div class="landing_card">
                    <div class="landing_icone">🚆</div>
                    <h3>Gerenciamento de trens</h3>
                    <p>
                        Cadastro, consulta, atualização e organização das informações
                        dos trens cadastrados.
                    </p>
                </div>

                <div class="landing_card">
                    <div class="landing_icone">🛤️</div>
                    <h3>Controle de rotas</h3>
                    <p>
                        Organização das rotas ferroviárias, com informações sobre
                        origem, destino e distância.
                    </p>
                </div>

                <div class="landing_card">
                    <div class="landing_icone">📡</div>
                    <h3>Monitoramento IoT</h3>
                    <p>
                        Acompanhamento de informações coletadas por sensores,
                        como velocidade, localização e possíveis falhas.
                    </p>
                </div>

                <div class="landing_card">
                    <div class="landing_icone">📊</div>
                    <h3>Relatórios e gráficos</h3>
                    <p>
                        Visualização de dados e relatórios para auxiliar na análise
                        do funcionamento ferroviário.
                    </p>
                </div>

            </div>
        </section>

        <!-- MONITORAMENTO -->
        <section class="landing_monitoramento">

            <div class="landing_monitoramento_texto">
                <span class="landing_etiqueta">TECNOLOGIA IOT</span>

                <h2>Monitoramento mais inteligente</h2>

                <p>
                    Com o uso de sensores, o sistema busca acompanhar informações
                    importantes sobre o funcionamento dos trens, como velocidade,
                    localização, desempenho e possíveis situações anormais.
                </p>

                <p>
                    Essas informações podem auxiliar na identificação de problemas,
                    no acompanhamento da operação e na tomada de decisões.
                </p>
            </div>

            <div class="landing_monitoramento_itens">
                <div>
                    <strong>01</strong>
                    <span>Velocidade dos trens</span>
                </div>

                <div>
                    <strong>02</strong>
                    <span>Localização ferroviária</span>
                </div>

                <div>
                    <strong>03</strong>
                    <span>Identificação de falhas</span>
                </div>

                <div>
                    <strong>04</strong>
                    <span>Desempenho operacional</span>
                </div>
            </div>

        </section>

        <!-- BENEFÍCIOS -->
        <section class="landing_beneficios">

            <div class="landing_titulo">
                <span class="landing_etiqueta">BENEFÍCIOS</span>
                <h2>Uma operação mais organizada</h2>
            </div>

            <div class="landing_beneficios_lista">

                <div>
                    <h3>Mais organização</h3>
                    <p>Centralização das informações ferroviárias em um só sistema.</p>
                </div>

                <div>
                    <h3>Mais acompanhamento</h3>
                    <p>Visualização dos dados relacionados aos trens, rotas e sensores.</p>
                </div>

                <div>
                    <h3>Mais segurança</h3>
                    <p>Apoio na identificação de situações anormais e possíveis falhas.</p>
                </div>

                <div>
                    <h3>Melhor análise</h3>
                    <p>Relatórios e gráficos para auxiliar na tomada de decisões.</p>
                </div>

            </div>
        </section>

        <!-- FINAL -->
        <section class="landing_final">

            <h2>Conheça o InfoTrem</h2>

            <p>
                A tecnologia como aliada no gerenciamento e monitoramento ferroviário.
            </p>

            <a href="#pagina_login" class="landing_botao">Acessar o sistema</a>

        </section>

        <footer class="landing_rodape">
            <p>InfoTrem — Sistema de Gerenciamento Ferroviário</p>
        </footer>

    </main>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
