<?php
include("../php/conexao.php");

include('../php/admverificar.php');
//verifica se a um valor de id na url da pagina
if (!empty($_GET['id_produto'])) {
  $id_produto = $mysqli->real_escape_string($_GET['id_produto']);
  //faz um select onde o id do produto é igual a o numero que está na url 
  $select = "SELECT * FROM produtos WHERE id_produto='$id_produto'";
  //conecta com o banco de dados
  $conect = mysqli_query($mysqli, $select);
  //conta o numero de linhas do resultado
  $cont = mysqli_num_rows($conect);
  //verifica se o produto exite
  if ($cont > 0) {
    //pega os valores de cada coluna do produto selecionado e atribui
    while ($user_data = mysqli_fetch_assoc($conect)) {
      $id_produto = $user_data['id_produto'];
      $nome =  $user_data['nome'];
      $valor = $user_data['valor'];
      $console = $user_data['console'];
      $caminho = $user_data['caminho'];
      $descricao = $user_data['descricao'];
      $situacao = $user_data['situacao'];
      $video = $user_data['video'];
      $desconto = $user_data['desconto'];
    }
    //caso não exista esse produto
  } else {
    //redireciona o adm até a tabela adm
    header('Location: admtabelapro.php');
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="icons/G4u.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styleadm.css">
  <title>Document</title>
</head>

<body>
  <!-- formulario para editar os produtos que já foram cadastrados.Apenas o trailer não é obrigatorio -->
  <form method="post" class="formularioedit">
    <h1>Editar Produtos</h1>
    <input type="text" name="nome" placeholder="Nome Do Produto" value="<?php echo $nome ?>" required><!-- campo para nome do prduto -->
    <input type="number" name="valor" placeholder="Preço do Produto" value="<?php echo $valor ?>" required><!-- campo para inserir valor -->
    <input type="number" name="desconto" max="90" placeholder="Desconto Do Produto" value="<?php echo $desconto ?>">
    <input type="text" name="video" placeholder="Trailer Do Jogo" value="<?php echo $video ?>" ><!-- campo para inserir video -->
    <label>Situação do produto</label>
    <select name="situacao" class="select"><!-- select para selecionar a situação de cada produto -->
      <option value="ativado">Ativado</option><!-- opção 1  ativado -->
      <option value="desativado">Desativado</option><!-- opção 2 desativado -->
    </select>
    <label>Console do produto</label>
    <select name="console" class="select" required>
      <option value="<?php echo $console ?>"><?php echo $console ?></option>
      <option value="xbox">Xbox</option>
      <option value="playstation">Playstation</option>
      <option value="nintendo">Nintendo</option>
    </select><br>

    <label>Descrição</label>
    <textarea class="descricao" rows="8" name="descricao" placeholder="Descreva o produto" required><?php echo $descricao ?></textarea>;

    <input type="submit" name="editar" value="Editar" required>
    <a href="../html/admtabelapro.php">Voltar para tabela</a>
  </form>
</body>

</html>

<?php
//editar o resto dos valores
if (isset($_POST['editar'])) {
  $id_produto = $mysqli->real_escape_string($_GET['id_produto']);
  $nome =  $_POST['nome'];
  $descricao = $mysqli->real_escape_string($_POST['descricao']);
  $valor = $_POST['valor'];
  $console = $_POST['console'];
  $situacao = $_POST['situacao'];
  $video = $_POST['video'];
  $desconto = $_POST['desconto'];
  //edita os valores antigos na tabela pelos novos valores
  $cod = "UPDATE produtos SET nome ='$nome', valor ='$valor' , desconto = '$desconto', console ='$console' , descricao = '$descricao',situacao ='$situacao', video = '$video' WHERE id_produto='$id_produto'";
  //conecta com banco de dados
  $result = mysqli_query($mysqli, $cod);
  //redireciona o a amd da tabela produto
  header("Location: editarimg.php");
}
?>