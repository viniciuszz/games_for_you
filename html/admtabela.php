<?php
//inclui a conexão
include("../php/conexao.php");
//verifica se a uma session
if (!isset($_SESSION)) {
    //inicia a session
    session_start();
}
//verifica o nivel de acesso do adm
if ($_SESSION['lv_acesso'] > 1) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="icons/G4u.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Link para os icones do google icons, usados no footer e no menu -->
        <link rel="stylesheet" href="../css/tabela_menu.css">
        <link rel="stylesheet" href="../css/EstiloMenu.css">
        <title>Document</title>
    </head>

    <body>
        <!--Inicio do cabeçalho do site/menu -->
        <header id="header" class="gradient col-lg-12 col-md-12 col-sm-12">
            <div class="cxlogo col-lg-1 col-md-1 col-sm-1">
                <img class="logo" src="icons/G4u.png">
            </div>
            <nav id="nav-adm" class="col-lg-9 col-md-9 col-sm-8">
                <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
                    <span id="hamburger"></span>
                </button>
                <ul id="menu" role="menu">
                    <li><a href="admtabelavendas.php">Vendas</a></li>
                    <li><a href="admtabelapro.php">Podutos</a></li>
                    <li><a href="cadastropro.php">Cadastro de produtos</a></li>
                </ul>
            </nav>
            <a href="admtabela.php">
                <button type="image" class="btn"><span class="material-symbols-outlined login">
                        account_circle
                    </span></button>
            </a>
            <?php
            echo  "<div class='eee'>";
            //mostra o nome do adm
            echo $_SESSION['nomecompleto'];
            echo "<a class='sair' href='../php/sair.php'>sair</a>";
            echo "</div>";

            ?>
        </header>
        <a href="cadastro_adm.php">Cadastro</a>
        <!-- botão de voltar para o topo -->
        <a class="topo" href="#">^</a>
        <h1>Tabela dos Adms</h1>
        <div class="toda-tabela">
            <!-- cria uma tabela para mostrar todos os adms cadastrados no site -->
        <table class="table" border="5px">
            <tr class="trtitulo">
                <!-- cria os titulos de cada coluna -->
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Nivel de Acesso</th>
                <th>Excluir</th>
            </tr>
            <?php
            //seleciona todas as colunas da tabela adm
            $select = "SELECT * FROM adm ";
            //faz uma conexão com o banco de dados
            $query = mysqli_query($mysqli, $select);
            //faz laço de repetição para exibir as informações do adm
            while ($adm = mysqli_fetch_array($query)) {
            ?>
              <!--exibe os resultados em cada linha correspondente -->
                <tr>
                    <td><?php echo $adm['id_adm'] ?></td>
                    <td><?php echo $adm['nomecompleto'] ?></td>
                    <td><?php echo $adm['email'] ?></td>
                    <td><?php echo $adm['cpf'] ?></td>
                    <td><?php echo $adm['telefone'] ?></td>
                    <td><?php echo $adm['lv_acesso'] ?></td>
                    <td><a href="../php/deletar.php?<?php echo 'id_adm=';
                                                    echo $adm['id_adm'] ?>">Deletar</a></td>
                </tr>

            <?php

            }
            ?>
        </table>
        </div>
    <?php
} else {
    echo "<script>window.location.href ='admtabelapro.php';alert('nivel de acesso insuficiente');</script>";
}

    ?>
    </body>

    </html>