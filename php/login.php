<?php
include("conexao.php");
//inicia a session 
session_start();
//verifica se o usuario clicou no logar
if (isset($_POST['logar'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    //seleciona o usuario onde  o email e a senha são iguais
    $codigo = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    //conecta ao banco de dados
    $conect = mysqli_query($mysqli, $codigo);
    //retorna quantas linhas foram achadas no banco de dados
    $qtd = mysqli_num_rows($conect);
    //retorna quantas linhas foram achadas no banco de dados
    if ($qtd > 0) {
        //faz um laço de repetisão para fazer as sessions nessesarias
        while ($usuario = mysqli_fetch_array($conect)) {
            $_SESSION['id_usu'] = $usuario['id_usu'];
            $_SESSION['usuario'] = $usuario['usuario'];
            //redireciona o usuario para home
            header("Location: ../html/index.php");
        }
    } else {
        //exibe um aviso 
        echo "<script>alert('Email ou senha incorretos')</script>";
        //redireciona o usuario para o cadastro
        echo "<script>window.location.href = '../html/cadastro_login.php'</script>";
    }
}
