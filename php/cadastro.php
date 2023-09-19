
<?php
include("../php/conexao.php");
    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//verifica se o usuario clicou no cadastrar
if (isset($_POST['cadastrar'])) {
    //recebe o valor dos inputs e atribui eles a uma variavel
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $usuario = $_POST['usuario'];
            //var_dump($dados);
    
     
      //verifica se já tem um email ou cpf cadastrados
    $vericar = "SELECT * FROM usuario WHERE email = '$email' AND cpf ='$cpf'";
    //realiza uma query para fazer a conexao
    $vericarconect = mysqli_query($mysqli, $vericar);
    //conta o numero de linhas para verse se é maior que 0
        if (mysqli_num_rows($vericarconect) > 0) {
            //exibe um aviso de email ou cpf invalido
            echo '<script>alert("Email ou CPF já cadastrados");</script>';
            //redireciona o usuario para o login
            echo '<script>window.location.href=" ../html/cadastro_login.php"</script>';
        } else {
            //realiza o cadastro no banco de dados
            $code = "INSERT INTO usuario (email,nome,cpf,senha,usuario ) VALUES ('$email','$nome','$cpf','$senha','$usuario ')";
            //conecta no banco de dados
            $conexao = mysqli_query($mysqli, $code);
            //exibe um aviso de cadastro bem sucedido
            echo '<script>alert("cadastro bem sucedido");</script>';
            //redireciona o usuario até o login
            echo '<script>window.location.href=" ../html/cadastro_login.php"</script>';
        }
    
        
    
   
}
?>