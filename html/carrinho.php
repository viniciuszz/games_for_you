<?php


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Link para os icones do google icons, usados no footer e no menu -->
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <link rel="stylesheet" href="../css/carrinho.css">

    <title>Carrinho de compras</title>
</head>

<body onload="return continuar()">


    <!--Inicio do cabeçalho do site/menu -->
    <header id="header" class="gradient col-lg-12 col-md-12 col-sm-12">

        <div class="cxlogo col-lg-1 col-md-1 col-sm-1">
            <a href="index.php">
                <img class="logo" src="icons/G4u.png">
            </a>
        </div>
        <!-- Barra de pesquisa -->
        <div class="barra-pesquisa col-lg-9 col-md-9 col-sm-9">
            <form method="get" action="pesquisa.php">
                <span class="icon-search material-symbols-outlined">
                    search
                </span>
                <input class="procurar" type="search" name="pesquisa" placeholder="Pesquisar...">
            </form>
        </div>

        <nav id="nav" class="col-lg-9 col-md-9 col-sm-9">
            <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
                <span id="hamburger"></span>
            </button>
            <ul id="menu" role="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="pagxbox.php">Xbox</a></li>
                <li><a href="pagplaystation.php">Playstation</a></li>
                <li><a class="borda-nintendo" href="pagnintendo.php">Nintendo</a></li>
            </ul>
        </nav>
        </div>
        <div class="cxlogin col-sm-4 col-md-2 col-lg-1">
            <?php
            //mostra o ususario no menu
            session_start();
            if (!isset($_SESSION['usuario'])) {
                echo "";
            ?>
                <a href="cadastro_login.php">
                    <button type="image" class="btn"><span class="material-symbols-outlined login">
                            account_circle
                        </span></button>
                </a>
            <?php
            } else {
            ?>
                <a href="historico.php">
                    <button type="image" class="btn"><span class="material-symbols-outlined login">
                            account_circle
                        </span></button>
                </a>
            <?php
                echo  "<div class='eee'>";
                echo $_SESSION['usuario'];
                echo "<a class='sair' href='../php/sair.php'>sair</a>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1">
            <a href="carrinho.php">
                <button type="image" class="btn"><span class="material-symbols-outlined login">
                        shopping_cart
                    </span></button>
                <div class="numero-carrinho">
                    <?php
                    //mostra quantos produtos tem no carrinho de compras se não exitir nenhum item ele exibe o numero 0
                    if (!isset($_SESSION['itens'])) {
                        echo "0";
                        //mostra a quantidade de itens que estão no carrinho de compras
                    } else {
                        //conta  a quntidade de itens
                        $contar = count($_SESSION['itens']);
                        //mostra a quntidade de itens
                        echo $contar;
                    }
                    ?>
                </div>
            </a>
        </div>
    </header>

    <div class="nav-header shadow-i">
        <nav id="nav" class="col-lg-9 col-md-9 col-sm-9">
            <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
                <span id="hamburger"></span>
            </button>
            <ul id="menu" role="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="pagxbox.php">Xbox</a></li>
                <li><a href="pagplaystation.php">Playstation</a></li>
                <li><a class="borda-nintendo" href="pagnintendo.php">Nintendo</a></li>
            </ul>
        </nav>
    </div>
    <!-- Fim do cabeçalho do site/menu -->


    <?php
    //inclui a conexao
    include("../php/conexao.php");
    //se não existir nada no carrnho prepara a array

    if (!isset($_SESSION['itens'])) {
        $_SESSION['itens'] = array();
    }
    //verifica se o usuario está logado caso não esteja ele será redirecionado para o login
    if (!isset($_SESSION['usuario'])) {
        //redireciona o usuario para o login
        header("Location: cadastro_login.php");
    }

    //verifica se o id do produto existe
    if (!empty($_GET['id_produto'])) {
        $id_produto = $mysqli->real_escape_string($_GET['id_produto']);
        //se ouver o id o site pergunta se o usuario deseja continuar a compra
        if (isset($_GET['id_produto'])) {
            echo "<script> 
            var confirma = confirm('Deseja continuar comprando?');
            if (confirma === true) {
                //volta duas paginas
                history.go(-2)
            }
            </script>";
        }
        //verifica se o produto exite no banco de dados
        $verifica = mysqli_query($mysqli, "SELECT * FROM produtos WHERE id_produto='$id_produto'");
        //conta as linhas do resultado 
        if (mysqli_num_rows($verifica) > 0) {
            //cria uma session do produto que sera comprado,adicionando o primeiro produto ao carrinho
            if (!isset($_SESSION['itens'][$id_produto])) {
                $_SESSION['itens'][$id_produto] = 1;
                //redireciona o usuario novamente para o carrinho para que o numero de produtos aumente
                echo "<script>window.location.href ='carrinho.php';</script>";
                //adicina outro produto adicionando +1 a quantidade
            } else {
                //redireciona o usuario novamente para o carrinho caso a qantidade do produto aumente
                echo "<script>window.location.href ='carrinho.php';</script>";
                //adiciona mais um para a quantidade 
                $_SESSION['itens'][$id_produto] += 1;
            }
        } else {
            echo "<script>alert('Produto inexistente');</script>";
        }
    }
    //exibir os itens no carrinho
    ?>
    <div class="geral">
        <?php
        //verifica se o carrinho de compras esta vazio
        if (count($_SESSION['itens']) == 0) {
            //exibe uma mensagem de carrinho vazio
            echo '<div class="carrinho_vazio">Seu carrinho está vazio!! Adicione um produto<br><a href="pagxbox.php"><span class="material-symbols-outlined">
    add_shopping_cart
    </span></a></div>';
            //se tiver pelo menos um produto no carrinho ele exibe o carrinho completo
        } else {
            //cria a variavel total atribuindo o valor 0
            $total = 0;
            //para cada session ele cria uma nova session com quantidade
            foreach ($_SESSION['itens'] as $id_produto => $quantidade) {
                //verifica se a quantidade é maior ou igual a zero
                if ($quantidade <= 0) {
                    unset($_SESSION['itens'][$id_produto]);
                    header("Location: carrinho.php ");
                } else {
                    //seleciona da tabela produtos onde o id do produto igual ao id e recebido pela url
                    $code = "SELECT * FROM produtos WHERE id_produto='$id_produto'";
                    //faz a conexão com o banco de dados
                    $conect = mysqli_query($mysqli, $code);
                    //associa cada linha selecionada com nome,valor e a imagem
                    $linhaa = $conect->fetch_assoc();
                    //faz o valor da porcentagem do desconto que sera aplicado
                    $ttotal = $linhaa['valor'] * $linhaa['desconto'] / 100;
                    //o valor original do produto menos o valor do desconto
                    $totaldesc = $linhaa['valor'] -  $ttotal;
                    //subtotal de cada produto fazendo a quantidade vezes o valor 
                    $subtotal = $totaldesc * $quantidade;
                    //o total é o valor de cada produto vezes a quantidade somando cada subtotal
                    $total += $totaldesc * $quantidade;
                }

        ?>
                <div class="linha-produto col-sm-12 col-md-12 col-lg-9">
                    <img class="img-carrinho col-sm-12 col-md-4 col-lg-3" src="<?php echo $linhaa['caminho']; ?>">
                    <div class="nome-carrinho col-sm-12 col-md-2 col-lg-3"><?php echo   $linhaa["nome"] . '<br/>'; ?></div>
                    <div class="valor-carrinho col-sm-12 col-md-2 col-lg-2">    <?php
                            ?>
                            <div class="valor-porcentagem">
                            <?php
                            echo "R$";
                            
                            echo number_format($linhaa['valor'] - $ttotal, 2, ",", ".");
                            ?>
                            </div>
                            <?php
                        ?><br></div>
                    <div class="qtd-produto-carrinho col-sm-12 col-md-1 col-lg-1"><a class="mais_menos" href="../php/mais.php?<?php echo 'id_produto=';
                                                                                                                        echo $linhaa["id_produto"]; ?>">+</a><?php echo  $quantidade . '<br/>'; ?><a class="mais_menos" href="../php/menos.php?<?php echo "id_produto=";
                                                                                                                                                                                                                                            echo "$id_produto" ?>">-</a></div>
                    <div class="subtotal-carrinho col-sm-12 col-md-2 col-lg-2"><?php echo "R$";
                                                                                echo number_format($subtotal, 2, ",", ".") . '<br/>'; ?></div>
                    <div class="remover-carrinho col-sm-12 col-md-1 col-lg-1"><a href="remover.php?<?php echo 'id_produto=';
                                                                                                    echo $linhaa["id_produto"]; ?>">Remover</a></div>

                </div>
            <?php
            }
            ?>
            <div class="divtotal">
                <!-- div que irá conter o total da compra -->
                <h1>Total da compra</h1>
                <br>
                <?php echo "R$";
                echo number_format($total, 2, ",", ".") . '<br/>'; ?>
                <?php
                //endereço do usuario
                $id_usu = $_SESSION['id_usu'];
                //seleciona os endereços na linha onde esviver o id do usurio 
                $code = "SELECT * FROM endereco WHERE id_usu = '$id_usu'";
                //faz a conexao com o banco de dados
                $conect = mysqli_query($mysqli, $code);
                //verifica se tem algum endereco cadastrado
                if ($cont = mysqli_num_rows($conect) > 0) {
                ?>
                    <!-- cria formulario para exibir as imformções do endereço do usuario -->
                    <form method="post" enctype="multipart/form-data">
                        <?php
                        echo
                        '
    <div class="comprar">
         <button  class="btncompra" name="comprar" >Comprar</button><br>
       </div>';
                        ?>
                        <?php
                        //faz um laço de repetição para exibir os endereços
                        while ($linhaender = mysqli_fetch_assoc($conect)) {
                        ?>
                            <!-- cria um input radio para cada endereço -->
                            <input type="radio" name="radio" value="<?php echo $linhaender['id_endereco']; ?>" required>
                            <?php echo "Estado: ";
                            echo $linhaender['estado'] . '<br>'; ?>
                            <?php echo "Cidade: ";
                            echo $linhaender['cidade'] . '<br>'; ?>
                            <?php echo "Bairro: ";
                            echo $linhaender['bairro'] . '<br>'; ?>
                            <?php echo "Numero da casa: ";
                            echo $linhaender['numero_casa'] . '<br>'; ?>
                            <?php echo "Rua: ";
                            echo $linhaender['rua'] . '<br>' . '<br>'; ?>
                    <?php
                        }
                        //se o usuario já tiver um endereço ele podera cadastrar outro
                        echo '<button class="btncompra"><a class="acomprar" href="cadastroendereco.php">Cadastre outro endereço</a></button>';
                    } else {
                        //se o usuario não cadastrou nenhum endereço ainda é exibido um botão para redirecionalo
                        echo  '<button  class="btncompra"><a class="acomprar" href="cadastroendereco.php">Cadastre seu endereço</a></button>';
                    }

                    ?>
            </div>
    </div>
    </form>
<?php
        }
?>
<!-- linkes do js -->
<script src="../js/menu.js"></script>


</body>

</html>
<?php

//registra a compra no banco de dados caso o usuario clique no botão comprar
if (isset($_POST['comprar'])) {
    
    $id_usu = $_SESSION['id_usu'];
    $id_endereco = $_POST['radio'];
    //para cada  item no carrinho ele realiza um insert com a quntidade dos produtos
    foreach ($_SESSION['itens'] as $id_produto => $quantidade) :
        $select = "SELECT * FROM produtos WHERE id_produto='$id_produto'";
        $conect = mysqli_query($mysqli, $select);
        while ($produtos_vendas = mysqli_fetch_assoc($conect)) {
            $soma_das_vendas = $produtos_vendas['num_vendas'] + $quantidade;
            $insertvendas = mysqli_query($mysqli, "UPDATE produtos SET num_vendas='$soma_das_vendas' WHERE id_produto='$id_produto'");
        }
        $subtotal = $totaldesc * $quantidade;
        $valor =  $subtotal;
        //inseri os valores nas colunas da tabela
        $SqlInserirItens = mysqli_query($mysqli, "INSERT INTO vendas (id_produto,id_usu,id_endereco,subtotal,quantidade,total) VALUES ('$id_produto','$id_usu','$id_endereco','$valor','$quantidade','$total')");
        //quando o usuario comcluir a compra as sessions dos produtos serão deletadas
        unset($_SESSION['itens']);
    //termina o foreach
    endforeach;
    //redireciona o usuario novamente para o carrinho e moxtra um alerta de compra bem sucedida
    echo "<script>window.location.href ='carrinho.php';alert('A compra foi bem sucedida, o boleto sera enviado no seu email');</script>";
}
//reseta a url sem resetar a pagina
//window.history.pushState('Object', 'new url', 'http://localhost:8080/expo3/html/carrinho.php');
?>