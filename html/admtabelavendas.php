<?php
include('../php/selectvendas.php');
include('../php/admverificar.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Link para os icones do google icons, usados no footer e no menu -->
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <link rel="stylesheet" href="../css/tabela_menu.css">
    <title>Tabela de vendas</title>
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
        echo $_SESSION['nomecompleto'];
        echo "<a class='sair' href='../php/sair.php'>sair</a>";
        echo "</div>";

        ?>
    </header>
    <!-- botão de voltar para o topo -->
    <a class="topo" href="#">^</a>
    <h1>Tabela de Vendas</h1>
    <div class="toda-tabela">
        <!-- cria uma tabela para exibir  todas as vendas efetuadas no nosso site  -->
        <table class="table" border="5px">
            <!-- exibe os titulos de cada coluna -->
            <tr class="trtitulo">
                <th>ID venda</th>
                <th>ID produto</th>
                <th>ID usuario</th>
                <th>ID endereço</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Data da compra</th>
            </tr>
            <?php
            //laço de repetição para exibir todos os resultados
            do {
            ?>
                <tr>
                    <!-- exibe a informação de cada linha das vendas-->
                    <td><?php echo $linha['id_venda']; ?></td>
                    <td><?php echo $linha['id_produto']; ?></td>
                    <td><?php echo $linha['id_usu']; ?></td>
                    <td><?php echo $linha['id_endereco']; ?></td>
                    <td><?php echo "R$";
                        echo number_format($linha['valor'], 2, ",", "."); ?></td>
                    <td><?php echo $linha['quantidade']; ?></td>
                    <td><?php echo "R$";
                        echo number_format($linha['total'], 2, ",", "."); ?></td>
                    <td><?php echo $linha['data_compra']; ?></td>
                </tr>
            <?php
            } while ($linha = $conect->fetch_assoc());
            ?>
        </table>
    </div>
    <script src="../js/menu.js"></script>
</body>

</html>