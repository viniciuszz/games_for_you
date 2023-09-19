<?php
include("conexao.php");
//seleciona todos da tabela vendas
$codigo = "SELECT * FROM vendas ORDER BY id_venda DESC ";
 //conecta ao banco de dados
$conect = mysqli_query($mysqli,$codigo);
//associa o valor as linhas onde as colunas são chamadas
$linha =  $conect->fetch_assoc();

?>