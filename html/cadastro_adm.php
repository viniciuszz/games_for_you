<?php
//inclue a conexão com a pagina
include("../php/conexao.php");
//se não ouver uma session ele ira iniciar a session
if (!isset($_SESSION)) {
    //inicia a session
    session_start();
}
//somente um adm com nivel dois de acesso pode acessar essa pagina
if ($_SESSION['lv_acesso'] > 1) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="icons/G4u.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleadm.css">
        <title>Cadastro do adm</title>
    </head>
    <body>
        <!-- cria formulario para cadastrar outros adms.Todos os campos obrigatorios -->
        <form method="post" name="formulario" class="formularioadmcadastro">
            <h1>Cadastro ADM</h1>
            <input type="text" name="nomecompleto" placeholder="Nome" required><!-- campo para inserir nome -->
            <input type="email" name="email" placeholder="Email" required><!-- campo para inserir email -->
            <input type="text" name="cpf" id="cpf" onblur="return verificarCPF(this.value)" placeholder="CPF" maxlength="11" required><!-- campo para inserir cpf -->
            <input type="text" name="telefone" placeholder="Telefone" required><!-- campo para inserir telefone -->
            <input type="text" name="senha" id="senha" placeholder="Senha" required><!-- campo para inserir senha -->
            <input type="text" name="rsenha" id="rsenha" placeholder="Repita a senha" required><!-- campo para repitir a senha -->
            <label>Nivel de acesso</label>
            <select name="lv_acesso"><!-- select para selecionar o nivel de acesso do adm -->
                <option value="1">Adm Simples</option><!-- opsão nivel 1 -->
                <option value="2">Adm Geral</option><!-- opsão nivel 2 -->
            </select>
            <input type="submit" name="cadastraradm"  onclick="return validar()" value="cadastrar"><!-- botão de cadastro do adm -->
        </form>
        <!-- links do js -->
        <script src="../js/cadastroverifica.js"></script>
    </body>

    </html>
<?php
    if (isset($_POST["cadastraradm"])) {
        //cria as variaveis que recebem os valores dos campo preemchidos
        $nomecompleto = $_POST['nomecompleto'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $lv_acesso = $_POST['lv_acesso'];
        //verifica se já tem um email ou cpf cadastrados
        $vericar = "SELECT * FROM adm WHERE email = '$email' AND cpf ='$cpf'";
        //realiza uma query para fazer a conexao
        $vericarconect = mysqli_query($mysqli, $vericar);
        //conta o numero de linhas para verse se é maior que 0
        if (mysqli_num_rows($vericarconect) > 0) {
            //exibe um aviso de email ou cpf invalido
            echo '<script>alert("Email ou CPF já cadastrados");</script>';
            //redireciona o usuario para o login
            echo '<script>window.location.href=" ../html/cadastro_adm.php"</script>';
        } else {
            //realiza o cadastro no banco de dados
            $code = "INSERT INTO adm (nomecompleto,email,cpf,telefone,senha,lv_acesso) VALUES ('$nomecompleto','$email','$cpf','$telefone','$senha','$lv_acesso')";
            //conecta no banco de dados
            $conexao = mysqli_query($mysqli, $code);
            //exibe um aviso de cadastro bem sucedido
            echo '<script>alert("cadastro bem sucedido");</script>';
            //redireciona o adm até o login
            echo '<script>window.location.href=" ../html/cadastro_adm.php"</script>';
        }
    }
} else {
     //redireciona o adm até o tabela de produtos
    echo "<script>window.location.href ='admtabelapro.php';alert('nivel de acesso insuficiente');</script>";
}
?>