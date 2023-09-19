<?php
session_start();
ob_start();
include("conexao.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Atualizar senha</h1>
    <form method="post">
<input type="text" placeholder="Nova senha" name="nova_senha" required>
<input type="submit" value="Atualizar" name="atualizar">
    </form>
    <a href="../html/cadastro_login.php">Lembrou a senha?</a>
</body>
</html>
<?php
$chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
var_dump($chave);
if(isset($_POST['atualizar'])){
$nova_senha = $mysqli -> real_escape_string($_POST['nova_senha']);
$select = mysqli_query($mysqli,"SELECT * FROM usuario WHERE recuperar_senha = '$chave' LIMIT 1");
header("Location: ../html/cadastro_login.php");
if(mysqli_num_rows($select) > 0){
$select = mysqli_query($mysqli,"UPDATE usuario SET senha='$nova_senha' WHERE recuperar_senha = '$chave' LIMIT 1");
}else{
    $_SESSION['msg'] = "<p style = 'color: red'>Link invalido</p>";
    header('Location: recuperar_senha.php');
}
}
    ?>
    