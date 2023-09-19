<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/pagprodutos.css">
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <link rel="stylesheet" href="../css/rodape.css">
    <title>Pagina playstation</title>
</head>

<body>
    <!--Inicio do cabeçalho do site/menu -->
    <header id="header-playstation" class="gradient col-lg-12 col-md-12 col-sm-12">

        <div class="cxlogo col-lg-1 col-md-1 col-sm-1">
            <a href="index.php">
                <img class="logo" src="icons/G4u.png">
            </a>
        </div>
        <!-- Barra de pesquisa -->
        <div class="barra-pesquisa col-lg-9 col-md-9 col-sm-9">
            <form method="get" action="pesquisa.php">
                <span class="icon-search-p material-symbols-outlined">
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
                <li><a id="a-playstation" href="index.php">Home</a></li>
                <li><a id="a-playstation" href="pagxbox.php">Xbox</a></li>
                <li><a id="a-playstation" href="pagplaystation.php">Playstation</a></li>
                <li><a id="a-playstation" class="borda-nintendo" href="pagnintendo.php">Nintendo</a></li>
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
                    <button type="image" class="btn"><span class="material-symbols-outlined login-playstation">
                            account_circle
                        </span></button>
                </a>
            <?php
            } else {
            ?>
                <a href="historico.php">
                    <button type="image" class="btn"><span class="material-symbols-outlined login-playstation">
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
                <button type="image" class="btn"><span class="material-symbols-outlined login-playstation">
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

    <div class="nav-header shadow-p">
        <nav id="nav" class="col-lg-9 col-md-9 col-sm-9">
            <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
                <span id="hamburger"></span>
            </button>
            <ul id="menu" role="menu">
                <li><a id="a-playstation" href="index.php">Home</a></li>
                <li><a id="a-playstation" href="pagxbox.php">Xbox</a></li>
                <li><a id="a-playstation" href="pagplaystation.php">Playstation</a></li>
                <li><a id="a-playstation" class="borda-nintendo" href="pagnintendo.php">Nintendo</a></li>
            </ul>
        </nav>
    </div>
    <!-- Fim do cabeçalho do site/menu -->
    <?php
    include('../php/playstation.php');
    //verifica se existe algum produto no banco de dados
    if ($qtdplaystation > 0) {

        do {
    ?>
            <a href="infoprodutos.php?<?php echo 'id_produto=';
                                        echo $linha["id_produto"]; ?>">
                <div class="divprincipal col-sm-12 col-md-3 col-lg-2">
                    <div class="jogop">
                        <div class="imgoverflow">
                            <div class="imgzoom">
                                <img class="img-produtos" src="<?php echo $linha['caminho']; ?>"><br>
                            </div>
                        </div>

                        <?php
                        echo $linha['nome']; ?><br>
                        <?php echo "R$";
                        echo  number_format($linha['valor'], 2, ",", "."); ?><br>
                    </div>
                </div>
            </a>

    <?php
        }
        //mostra todos os valores da pagina playstation
        while ($linha = $conect->fetch_assoc());
    } else {
        echo "<div class='vazio'>";
        echo "Ainda não existe nenhum jogo desse console";
        echo "</div>";
    }
    ?>


    <!-- Inicio do rodape do Site -->
    <footer>
        <section class="footer col-lg-12 col-md-12 col-sm-12">
            <nav class="div-img-scs col-sm-12 col-md-3 col-lg-3">
                <img class="img-scs" src="icons/saocaetano.png" alt="">
            </nav>
            <ul class="list col-lg-6 col-md-6 col-sm-12">
                <li class="listra">
                    <a class="footer-playstation" href="index.php">Home</a>
                </li>
                <li class="listra">
                    <a class="footer-playstation" href="pagxbox.php">Xbox</a>
                </li>
                <li class="listra">
                    <a class="footer-playstation" href="pagplaystation.php">Playstation</a>
                </li>
                <li>
                    <a class="footer-playstation" href="pagnintendo.php">Nintendo</a>
                </li>
            </ul>

            <div class="contatos col-lg-3 col-md-3 col-sm-12">
                <p> Contatos: (11)98454-0148 ou através do nosso e-mail G4m3sForYou@gmail.com
                    <br> <br>

            </div>

        </section>
    </footer>
    <div class="copyright col-sm-12 col-lg-12 col-md-12">
        <span class="material-symbols-outlined copy">
            copyright
        </span>
        <p> Atenção é importante informar que esse site é apenas para fins educacionais e sem fins lucrativos</p>
        </p>
    </div>
    <!--Fim do Rodape do Site-->
    <script src="../js/menu.js"></script>
</body>

</html>