
<?php
include("conexao.php");
include("admverificar.php");
//pega a informação por get e filtra para ser um numero inteiro
$id_adm = $mysqli->real_escape_string($_GET['id_adm']);
//codigo para deletar a informação da tabela produtos
$sql_code = "DELETE FROM adm WHERE id_adm ='$id_adm'";
//conecta com o banco de dados
$sql_query = mysqli_query($mysqli,$sql_code);
//redireciona o adm 
header("Location: ../html/admtabela.php");



