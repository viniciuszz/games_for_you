<?php
//inicia a session
session_start();
include_once("conexao.php");
//verifica se alguma estrela foi selecionada
if (!empty($_POST['estrela'])) {
	$estrela = $_POST['estrela'];
	$comentario = $mysqli->real_escape_string($_POST['comentario']);
	$id_usu =  $_SESSION['id_usu'];
	$id_venda = $_POST['id_venda'];
	//recebe a variavel get com a prevenção do mysqli injection
	$id_produto = $mysqli->real_escape_string($_GET['id_produto']);
	//Salvar no banco de dados
	$result_avaliacos = "INSERT INTO avaliacos (id_venda,qtd_estrela,id_produto ,id_usu,comentario) VALUES ('$id_venda','$estrela','$id_produto','$id_usu','$comentario')";
	$resultado_avaliacos = mysqli_query($mysqli, $result_avaliacos);
	//verifica se ouve uma avaliação pelo auto incremento inserido na tabela do banco de dados
	if (mysqli_insert_id($mysqli)) {
		//exibe um aviso da  avaliação bem sucedida
		echo '<script>alert("avaliação bem sucedida")</script>';
		//redireciona o usuario até o historico
		echo "<script>window.location.href = '../html/historico.php'</script>";
	} else {
		//exibe um aviso de erro
		echo '<script>alert("erro na avaliação")</script>';
		//redireciona o usuario até o historico
		echo "<script>window.location.href = '../html/historico.php'</script>";
	}
} else {
	//exibe um aviso para o usuario digitar pelo menos uma estrela
	echo '<script>alert("Nessesario pelo menos uma estrela")</script>';
	//redireciona o usuario até o historico
	echo "<script>window.location.href = '../html/historico.php'</script>";
}
