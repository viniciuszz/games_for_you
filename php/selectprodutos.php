<?php
include('conexao.php');
//seleciona todos os produtos na tabela produtos
$code = "SELECT * FROM produtos ";
 //conecta ao banco de dados
$conect = mysqli_query($mysqli,$code);
//associa o valor as linhas onde as colunas são chamadas
$linha = $conect->fetch_assoc();

?>