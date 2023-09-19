
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="icons/G4u.png">
  <title>Login</title>
  <link rel="stylesheet" href="../css/cadastro_login.css">
  <script src="https://kit.fontawesome.com/cf6fa412bd.js" crossorigin="anonymous"></script>
</head>

<body>

  <div class="container">
    <div class="buttonsForm">
      <div class="btnColor"></div>
      <button id="btnSignin">Login</button>
      <button id="btnSignup">Cadastro</button>
    </div>

    <!-- cria um formulario para login do usuario.Todos os campos obrigatorios-->
    <form id="signin" method="post" action="../php/login.php">
      <input type="email" name="email" placeholder="Email" required><!-- campo para inserir email -->
      <input type="password" name="senha" placeholder="Senha" required><!-- campo para inserir senha -->
      <button type="submit" name="logar">Entrar</button><!-- botão para logar  --><br>
      <a class="hrefadm" href="../php/recuperar_senha.php">Esqueceu a senha?</a>
    
      <div class="divadm">
        <a class="hrefadm" href="loginadm.php">Entrar como administrador</a>
      </div>
    </form>
    <!-- cria formulario cadastro do usuario todos os campos obrigatorios -->
    <form id="signup" name="formulario" method="post" >
      <input type="email" name="email" placeholder="Email" required><!-- campo para inserir email -->
      <input type="text" name="nome" placeholder="Nome" required><!-- campo para inserir nome -->
      <input type="text" name="usuario" placeholder="Usuario" maxlength="10" required><!-- campo para inserir nome do usurio -->
      <input type="text" name="cpf" id="cpf" onblur="return verificarCPF(this.value)" placeholder="CPF" maxlength="14" required><!-- campo para inserir cpf -->
      <input type="password" name="senha" id="senha" placeholder="Senha" required><!-- campo para inserir email senha -->
      <input type="password" name="rsenha" id="rsenha" placeholder="Repita a senha" required><!-- campo para inserir o repitir a senha -->
      <button type="submit" name="cadastrar" onclick="return validar()">Cadastrar</button><!--botão para fazer o cadastro -->
       
    </form>
    <script src="../js/cadastro_login.js"></script>
    <script src="../js/cadastroverifica.js"></script>
    <!-- linkes do js -->
    
    <!-- linkes do js que são usados pelo captcha -->

   
    
</body>

</html>