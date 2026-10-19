<?php 

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao= $_POST['Descricao'];
    $distancia = $_POST['Dista ncia'];
    $trem_vinculado = $_POST ['distancia_total'];
    $tempo= $_POST ['sensores_vinculados'];
    $data_criacao= $_POST ['data_criacao'];


    $sql = "INSERT INTO usuarios (nome, descricao , distancia , trem_vinculado ,tempo, data_criacao) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nome, $descricao , $distancia, $trem_vinculado , $tempo, $data_criacao );
     if ($stmt->execute() === TRUE) {
        echo "Nova Rota cadastrada com sucesso";
 } else {
    echo "erro: " . $sql . "<br>" . $conn->error;
 }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Rota</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <div class="pagina">
    <div class="sidebar">

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

            <a href="../pagina_monitoramento.php" class="menu-link">
                <li>Monitoramento</li>
            </a>

            <a href="../logout.php" class="menu-link">
                <li>Sair</li>
            </a>



    </ul>
    </div>

    <title>Cadastar Rota  </title>
      <div class="formulario-container">
        <form method="POST" class="forms_sensores">
            <h2 id="titulo-admin">Cadastrar Rota</h2>
            <div class="conteudo">

    <label for="nome">Nome da rota:</label>
     <input type="text" id="nome" name="nome" placeholder="Ex: rota " required>
     <br><br> 
    <label for="descricao">Descrição da rota :</label>
    <input type="descricao" id="descricao" name="descricaol" placeholder="Ex: Ela " required>
     <br><br>
    <label for= "senha">Senha:</label>
    <input type="password" id="senha" name="senha" placeholder="Ex: 12345" required>
     <br><br>
     <label for= "telefone">Telefone:</label>
    <input type="number" id="telefone" name="telefone" placeholder="Ex: (11) 91234-5678" required>
     <br><br>
    <label for="endereco">Endereço:</label>
     <input type="text" id="endereco" name="endereco" placeholder="Ex: Bairo guanabara rua guanabara numero 7" required>
     <br><br> 
    <label for="data_nascimento">Data de nascimento:</label>
     <input type="date" id="data_nascimento" name="data_nascimento" placeholder="Ex: 21/02/09" required>
     <br><br> 
    <label for="cpf">CPF:</label>
     <input type="text" id="cpf" name="cpf" placeholder="Ex: 123.456.789.1011" required>
     <br><br> 
    <label for="cargo">Cargo:</label>
        <select id="cargo" name="cargo">
        <option>Selecione</option>
        <option>Administrador</option>
        <option>Usuário</option>
</select>
 <br><br> 
    <label for="status_usuario">Status:</label>
        <select id="status_usuario" name="status_usuario">
        <option>Selecione</option>
        <option>Ativo</option>
        <option>Inativo</option>
         </select>

    <button id="botaoCadastro" type="submit">Cadastrar Usuário</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
   <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';">Visualizar Rotas Cadastradas</button>
    </div>
    </form> 
    </div>
</body>
</html>