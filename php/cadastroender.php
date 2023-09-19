<?php
include("conexao.php");
session_start();
//verifica se o usuario clicou no botão cadastro
if(isset($_POST['cadastroender'])){
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero_casa = $_POST['numero_casa'];
    $complemento = $_POST['complemento'];
    $id_usu = $_SESSION['id_usu'];
//inseri as informções no banco de dados 
$cod = "INSERT INTO endereco (cidade,estado,rua,bairro,numero_casa,complemento,id_usu) VALUE ('$cidade','$estado','$rua','$bairro','$numero_casa','$complemento','$id_usu')";
//conecta com o banco de dados
$conect = mysqli_query($mysqli,$cod);
//redireciona o usuario até o carrinho
header("Location: ../html/carrinho.php");
}
