<?php
include('conexao.php');
    //inicia a session
    session_start();
    //pega o id do produto pelo get
    $id_produto = $mysqli->real_escape_string($_GET['id_produto']);
    //verifica se a um id produto
if(isset($_GET['id_produto'])){
    $_SESSION['itens'][$id_produto] += 1;
    header("Location: ../html/carrinho.php");
 
}
?>