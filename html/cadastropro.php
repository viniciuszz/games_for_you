<?php
include('../php/admverificar.php');
include('../php/cadastroprodutos.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="icons/G4u.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styleadm.css">
  <title>cadastro de produtos</title>
</head>

<body>
 <!-- formulario para cadastrar produto .Apenas o video não é obrigatorio -->
  <form method="post" class="formularioprodutos" enctype="multipart/form-data" action="">
    <h1>Cadastro de Produtos</h1>
    <input type="text" name="nome" placeholder="Nome do Produto"  required><!-- campo para inserir nome do produto -->
    <input type="text" name="valor" placeholder="Preço do Produto" required><!-- campo para inserir preço do produto -->
    <input type="text" name="video" placeholder="Trailer do jogo"><!-- campo para treiler do jogo -->
    <label>Imagem</label>
    <div class="fileborder">
    <input name="imagem" type="file" required><!-- campo para inserir a imagem do produto -->
    </div>
    <label>Situação do produto</label>
    <select name="situacao" class="select"><!-- select para selecionar a situação de cada produto -->
      <option value="ativado">Ativado</option><!-- opção 1  ativado -->
      <option value="desativado">Desativado</option><!-- opção 2 desativado -->
    </select>
    <label>Console</label>
    <select name="console" class="select" required><!-- select para selecionar o console do produto -->
      <option value="">selecione um console</option>
      <option value="xbox">Xbox</option><!-- opção xbox -->
      <option value="playstation">Playstation</option><!-- opção playstation -->
      <option value="nintendo">Nintendo</option><!-- opção nintendo -->
    </select><br>
    <label>Descrição</label>
    <textarea rows="8" class="descricao" name="descricao" placeholder="Descreva o produto" required></textarea><!-- campo para inserir a descrição do produto -->
    <input type="submit" name="cadastrar" value="Cadastre o Produto" required><br><!-- botão para confirmar o cadastro  -->
    <a href="admtabelapro.php">Voltar para tabela</a>
  </form>
</body>

</html>