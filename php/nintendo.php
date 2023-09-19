<?php
include('conexao.php');
//seleciona somente os produtos que na coluna console são de valor nintendo
$code = "SELECT * FROM produtos WHERE console = 'nintendo' AND situacao = 'ativado' ORDER BY nome ASC";
 //conecta ao banco de dados
$conect = mysqli_query($mysqli,$code);
//conta o numero de linhas
$qtnintendo= mysqli_num_rows($conect);
//associa o valor as linhas onde as colunas são chamadas
$linha = $conect->fetch_assoc();
?>