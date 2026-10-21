<?php 

include '../../infra/conexao.php';
include '../../infra/verificar_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $estacao_origem = $_POST['estacao_origem'];
    $estacao_destino = $_POST['estacao_destino'];
    $distancia_total = $_POST['distancia_total'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $trem_id = $_POST['trem_id'];


    $sql = "INSERT INTO usuarios
        (nome, descricao, distancia, trem_vinculado, tempo, data_criacao)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssss",
    $nome,
    $descricao,
    $distancia,
    $trem_vinculado,
    $tempo,
    $data_criacao
);

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

   <h2>Editar Rota</h2>
    <form method="POST">

<label>Nome:</label>
<input type="text" name="nome" value="<?php echo $rotas['nome']; ?>" required>
<br><br>

<label>Estação Origem:</label>
<input type="text" name="estacao_origem" value="<?php echo $rotas['estacao_origem']; ?>" required>
<br><br>

<label>Estação Destino:</label>
<input type="text" name="estacao_destino" value="<?php echo $rotas['estacao_destino']; ?>" required>
<br><br>

<label>Descrição:</label>
<input type="longdescription" name="descricao" value="<?php echo $rotas['descricao']; ?>" required>
<br><br>

<label>Tempo previsto ou duração: </label>
<input type="text" name="duracao" value="<?php echo $rotas['duracao']; ?>" required>
<br><br>

<label>Selecione o Trem Vinculado:</label>
<select name="trem_id" required>
    <option value="" >Selecione o Trem</option>
    <?php
        $sql = "SELECT id, nome FROM trens";
        $trens = $conn->query($sql);
        while ($trem = $trens->fetch_assoc()) {
    ?>

    <option value="<?php echo $trem['id'];?>" <?php if ($rota['trem_id'] == $trem['id']) echo 'selected'; ?>>
        <?php echo $trem['nome'];?>
    </option>


    <?php
        } 
    ?>
</select>
<br><br>

    <button id="botaoCadastro" type="submit">Cadastrar Usuário</button>
   <button class="btn-cancelar" type="button" onclick="window.location.href='../pagina_home.php';">Cancelar</button>
   <button class="botaoVisualizar" type="button" onclick="window.location.href='listar_rotas.php';">Visualizar Rotas Cadastradas</button>
   <button type= "button"  onclick="window.location.href='../pagina.home.php';">voltar</button>
    </div>
    </form> 
    </div>
</body>
</html>