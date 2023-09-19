<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="../css/styleadm.css">
    <title>Login adiministrador</title>
</head>
<body>
    <form method="post" class="formulario" >
        <h1>Login adm</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="submit" name="admlogar" value="Entrar">
    </form>
</body>
</html>
<?php
include("../php/loginadm.php");

?>