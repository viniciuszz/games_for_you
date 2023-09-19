<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/G4u.png">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    
</body>
</html>
<?php
//verifica se não a uma session
if(!isset($_SESSION)) {
    //inicia a session
    session_start();
}

//verifica se o usuario está logado
if(!isset($_SESSION['id_usu'])) {
    die("<h1>Faça seu login primeiro para cadastrar seu endereço<h1><p><a href=\"../html/cadastro_login.php\">Logar</a></p>");
}


?>