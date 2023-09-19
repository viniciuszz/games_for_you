<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/G4u.png">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>verifica adm</title>

</head>
<body>
    
</body>
</html>
<?php
//verifica se a session
if(!isset($_SESSION)) {
    //inicia a session para o uso de sessions na pagina
    session_start();
}
//verifica se quem está acessando a pagina é o adm
if(!isset($_SESSION['id_adm'])) {
    //mostra um href que leva para o login adm
    die("<h1>Faça seu login primeiro para entrar como adm.<h1><p><a href=\"../html/loginadm.php\">Logar</a></p>");
}


?>