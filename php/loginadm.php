<?php
//inicia a session 
session_start();
//inclue a conexao
include("conexao.php");
if(isset($_POST['admlogar'])){
$email = $mysqli -> real_escape_string($_POST['email']);
$senha = $mysqli-> real_escape_string($_POST['senha']);
//seleciona onde o email e a senhas são iguais
    $codigo = "SELECT * FROM adm WHERE email = '$email' AND senha = '$senha'";
     //conecta ao banco de dados
    $conect = mysqli_query($mysqli,$codigo);
        //retorna quantas linhas foram achadas no banco de dados
    $qtd = mysqli_num_rows($conect);
//se a senha e o email estiver correto realiza o login
    if($qtd > 0){
        //cria as sessions do adm pegando o id e o nome do adm
        while($adm = mysqli_fetch_array($conect)){
            $_SESSION['id_adm'] = $adm['id_adm'];
            $_SESSION['nomecompleto'] = $adm['nomecompleto'];
            $_SESSION['lv_acesso'] = $adm['lv_acesso'];
        }
        //redireciona o adm para a tabela
header("Location: ../html/admtabelapro.php");
    }else{
        //se o login estiver incorreto exibe um alert
        echo '<script>alert("Login incorreto");</script>';
    }
}
