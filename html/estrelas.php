<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <link rel="stylesheet" href="../css/rodape.css">
    <link rel="stylesheet" href="../css/estrelas.css">
    <title>Document</title>
</head>

<body>

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

    <div class="avaliar">
        <?php
        include("../php/conexao.php");
        $id_usu = $_SESSION['id_usu'];
        $id_produto = $mysqli->real_escape_string($_GET['id_produto']);
        //verifica se usuario já comprou o produtos

        $verifica = "SELECT * FROM vendas WHERE id_produto =  '$id_produto' AND id_usu = '$id_usu'";
        $conet = mysqli_query($mysqli, $verifica);
        //conta o numero de linhas rusultantes da consulta ao banco de dados
        $cont = mysqli_num_rows($conet);

        //se o usuario já comprou ele podera avaliar o produto
        if ($cont > 0) {
            //mostra a imagem e o nome do produto
            $code = "SELECT * FROM produtos WHERE id_produto = '$id_produto' ";
            $conect = mysqli_query($mysqli, $code);
            $linha = mysqli_fetch_assoc($conect);

        ?>
            <div class="img-avaliar">
                <img class="img-produtos" src="<?php echo $linha['caminho']; ?>">
            </div>
            <div class="estrelas">
                <div class="nome-produto">
                    <?php echo $linha['nome']; ?>
                </div>
                <form method="POST" action="../php/avaliaestrela.php?<?php echo 'id_produto=';
                                                                        echo $linha['id_produto']; ?>" enctype="multipart/form-data">
                    <input type="radio" id="vazio" name="estrela" value="" checked required>
                    <label for="1"><i class="fa"></i></label>
                    <input type="radio" name="estrela" id="1" value="1">
                    <label for="2"><i class="fa"></i></label>
                    <input type="radio" name="estrela" id="2" value="2">

                    <label for="3"><i class="fa"></i></label>
                    <input type="radio" name="estrela" id="3" value="3">

                    <label for="4"><i class="fa"></i></label>
                    <input type="radio" name="estrela" id="4" value="4">
                    <label for="5"><i class="fa"></i></label>
                    <input type="radio" name="estrela" id="5" value="5"><br><br>
                    <textarea class="textarea" name="comentario" placeholder="Escreva sobre o produto" rows="4"></textarea><br>
                    <input type="hidden" value=" <?php echo $id_da_venda['id_venda'] ?>" name="id_venda">
                    <input class="button" type="submit" value="Avaliar">

            </div>
            </form>

    </div>

    <!-- Inicio do rodape do Site -->
    <footer>
        <section class="footer col-lg-12 col-md-12 col-sm-12">
            <nav class="div-img-scs col-sm-12 col-md-3 col-lg-3">
                <img class="img-scs" src="icons/saocaetano.png" alt="">
            </nav>
            <ul class="list col-lg-6 col-md-6 col-sm-12">
                <li class="listra">
                    <a href="index.php">Home</a>
                </li>
                <li class="listra">
                    <a href="pagxbox.php">Xbox</a>
                </li>
                <li class="listra">
                    <a href="pagplaystation.php">Playstation</a>
                </li>
                <li>
                    <a href="pagnintendo.php">Nintendo</a>
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
</body>
<!-- linkes do js -->
<script src="../js/menu.js"></script>

</html>
<?php

        } else {
            echo "<script>alert('você não comprou esse produto ainda')</script>";
            //redireciona o usuario  novamente para o historico
            echo "<script>window.location.href = '../html/historico.php'</script>";
        }
        //}
?>