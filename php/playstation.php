<?php
include('conexao.php');
//seleciona somente os produtos que na coluna console são de valor playstation
$code = "SELECT * FROM produtos WHERE console = 'playstation' AND situacao = 'ativado'  ORDER BY nome ASC";
 //conecta ao banco de dados
$conect = mysqli_query($mysqli,$code);
//conta o numero de linhas
$qtdplaystation= mysqli_num_rows($conect);
//associa o valor as linhas onde as colunas são chamadas
$linha = $conect->fetch_assoc();
?>