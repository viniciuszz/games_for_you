<?php
include('../php/conexao.php');
//inicia a session
session_start();
//pega o id do produto pelo get
$id_produto = $mysqli->real_escape_string($_GET['id_produto']);
//verifica se a um id produto
if (isset($_GET['id_produto'])) {
    //destroi a session do id produto selecionado
    unset($_SESSION['itens'][$id_produto]);
    //redireciona o usuario para o  carrinho
    header("Location: carrinho.php");
}
