<?php
//inclue o arquivo de conexao
include("../php/conexao.php");

if (isset($_POST['cadastrar'])) {
  //pega o arquivo da imagem
  $imagem = $_FILES['imagem'];
  //pega o nome da imagem
  $nomeDoArquivo = $imagem['name'];
  $nome =  $_POST['nome'];
  $valor = $_POST['valor'];
  $console = $_POST['console'];
  $descricao = $mysqli->real_escape_string($_POST['descricao']);
  $situacao = $_POST['situacao'];
  //nome da pasta
  $pasta = "img/";
  //numero aleatorio que sera o novo  nome da imagem
  $novoNomeDaImagem = uniqid();
  //pega extensão do produto
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  //varifica se a extensão e jpg ou png
  if ($extensao != "jpg" && $extensao != "png") {
    echo '<script>alert("Tipo de arquivo não aceito")</script>';
  } else {
    //caminho com o nome da pasta novo nome da imagem e a extensao png ou jpg 
    $caminho = $pasta . $novoNomeDaImagem . "." . $extensao;
    //copia a imagem para a pasta img
    $certo = move_uploaded_file($imagem["tmp_name"], $caminho);
    //insere os produtos no banco de dados
    $code = "INSERT INTO produtos (nome,valor,console,caminho,descricao,situacao) VALUE ('$nome','$valor','$console','$caminho','$descricao','$situacao')";
    //conecta com o banco de dados
    $conect = mysqli_query($mysqli, $code);
    //exibe um aviso 
    echo '<script>alert("O produto foi cadastrado")</script>';
    //redireciona o adm até o admtabelapro
    echo "<script>window.location.href = '../html/admtabelapro.php'</script>";
  }
}
