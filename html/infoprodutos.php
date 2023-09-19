<?php
include("../php/conexao.php");
//inicia a session
session_start();
$id_produto = $mysqli->real_escape_string($_GET['id_produto']);
//seleciona na tabela produtos onde o id do produto é igual a o da barra de pesquisa e tambem se ele está ativado
$code = "SELECT * FROM produtos WHERE id_produto ='$id_produto' AND situacao = 'ativado'";
//faz a conexao com o banco de dados
$conect = mysqli_query($mysqli, $code);
//conta o numero de resultados
$row = mysqli_num_rows($conect);
//associa o valor as linhas onde as colunas são chamadas
$linha = mysqli_fetch_assoc($conect);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Link para os icones do google icons, usados no footer e no menu -->
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <link rel="stylesheet" href="../css/rodape.css">
    <link rel="stylesheet" href="../css/infoprodutos.css">
    <title><?php echo $linha['nome']; ?></title>
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

    //executa o codigo se ouver o get id_produto
    if (isset($_GET['id_produto'])) {

        if ($row > 0) {
    ?>
            <div class="total-conteudo">
                <?php
                //seleciona na tabela de avaliação onde o id é igual a variavel do produtos
                $contar = "SELECT * FROM avaliacos WHERE id_produto = '$id_produto'";
                //faz a conexão com o banco de dados
                $contar_conect = mysqli_query($mysqli, $contar);
                //conta a quntidade de resultados
                $cont_votos = mysqli_num_rows($contar_conect);
                //soma a quantidade de estrelas selecionando pelo id_produto
                $code = "SELECT SUM(qtd_estrela) AS soma FROM avaliacos WHERE id_produto ='$id_produto'";
                $conect = mysqli_query($mysqli, $code);
                $estrelas = mysqli_fetch_assoc($conect);
                //verifica se a contagem é zero pois não é possivel dividir um numero pelo outro quando ele é igual  a zero
                if ($cont_votos == 0) {
                    $media = 0;
                } else {
                    $media = $estrelas['soma'] / $cont_votos;
                }
                ?>
                <div class="div_img"></div>
                <img class="img-produtos" src="<?php echo $linha['caminho']; ?>"><br>


                <div class="conteudo">
                    <div class="nome">
                        <?php echo $linha['nome']; ?><br>
                    </div>

                    <div class="estrelas">
                        <h1><?php echo $media;
                            echo " "; ?> <label for="5"><i class="fa"></i></label>
                            <input type="radio" name="estrela" id="5">
                        </h1>

                        <?php echo "(";
                        echo $cont_votos;
                        echo "  Avaliaçãoes)"; ?>
                    </div>

                    <div class="valor">

                        <?php
                        if ($linha['desconto'] > 0) {
                            ?>
                            <div class="desconto"><?php  echo "R$";echo $linha['valor']; ?></div>
                            <div class="valor-porcentagem">
                            <?php
                            echo "R$";
                            $ttotal = $linha['valor'] * $linha['desconto'] / 100;
                            echo number_format($linha['valor'] - $ttotal, 2, ",", ".");
                            ?>
                            <div class="porcentagem"><?php  echo "%"; echo $linha['desconto'] ;?> </div>
                            </div>
                            <?php
                        } else {
                            echo "R$";
                            echo number_format($linha['valor'], 2, ",", ".");
                        }
                        ?><br>
                    </div>

                    <div class="descricao">

                        <?php echo $linha['descricao']; ?><br>
                    </div>
                    <div class="btns-infoproduto">
                        <div class="comprar">
                            <button onclick="openModal()">Trailer</button>
                        </div>
                        <div id="modal-container" class="modal-container">
                            <div class="modal">
                                <button class="fechar" id="fechar">X</button>
                                <iframe id="video" width="100%" height="315" src="<?php echo $linha['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="comprar">
                            <button type="submit" name="confirmar"><a href="carrinho.php?<?php echo 'id_produto=';
                                                                                            echo $linha["id_produto"]; ?>"><span class="material-symbols-outlined">
                                        add_shopping_cart
                                    </span>Comprar</a></button>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else {
            //se o produto não existir redireciona o usuario até a home
            echo '<script>alert("o produto não exite ou esta desativado no momento");</script>';
            //redireciona o usuario até a index
            echo '<script>window.location.href=" ../html/index.php"</script>';
        }
        ?>
    <?php
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
    <script src="../js/menu.js"></script>
    <script src="../js/modal.js"></script>

</body>

</html>