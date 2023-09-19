<?php
include_once("../php/verificausu.php");
include("../php/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/historico.css">
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <title>Historico de compras</title>
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
    <!-- historico para exibir todas as compra feitas por um usuario em especifico -->
    <div class="historico">
        <div class="titulo-historico">
            <h1>Historico de compras</h1>
        </div>
        <div class="produtos">
            <?php
            $id_usu = $_SESSION['id_usu'];
            //pega as informação da tabela de vendas mostrando o endereco de compra do usurio e a imagem do produto compraco pelo usuario ordenando pelas compras mais recentes
            $code = "SELECT * FROM vendas,produtos,endereco  WHERE vendas.id_usu='$id_usu' AND produtos.id_produto = vendas.id_produto AND endereco.id_endereco = vendas.id_endereco ORDER BY id_venda DESC";
            //faz a conecsão com banco de dados
            $conect = mysqli_query($mysqli, $code);
            //conta o numero de linhas
            $qtd = mysqli_num_rows($conect);
            //verifica se o usuario tem alguma compra se ele tiver elas serão exibida
            if ($qtd > 0) {
                //faz um laçõ de repetição para exibir todas as compras do usuario
                while ($linha = $conect->fetch_assoc()) {
            ?>
                    <div class="historico-linha">
                       <!-- exibe a imagem de cada item no historico  -->
                        <div class="imagem-historico">
                            <img class="img-carrinho" src="<?php echo $linha['caminho']; ?>">
                        </div>

                        <div class="conteudo-historico">
                            <div class="nome-historico"><?php echo $linha['nome'] . '<br>'; ?></div>
                            <div class="valor-historico"><?php echo "R$";
                                                            echo  number_format($linha['valor'], 2, ",", ".") . '<br>'; ?></div>
                            <div class="qtd-historico"><?php echo " x";
                                                        echo $linha['quantidade'] . '<br>'; ?></div>
                            <div class="total-historico"><?php echo "Total: ";
                                                            echo "R$ ";
                                                            echo  number_format($linha['total'], 2, ",", ".") . '<br>'; ?></div>
                            <div class="data-historico"><?php
                                                        //formata os valores para a data brasileira 
                                                        $data = explode("-", $linha['data_compra']);
                                                        //exibe a data da compra para os usuarios
                                                        echo "$data[2]/$data[1]/$data[0]"; ?></div>

                            <div class="historico-endereco">
                                <div class="avaliar">

                                    <div class="estrelas">
                                        <form method="post"><input type="hidden" name="id_venda" value="<?php $linha['id_venda'] ?>"></form>
                                        <button type="submit" class="btn" name="btn"><a class="a-btn" href="estrelas.php?<?php echo "id_produto=";
                                                                                                                            echo $linha['id_produto']; ?>">Avalie o Produto</a></button>
                                    </div>

                                </div>
                                <div class="endereco">
                                    <!-- exibe onde o produto do cliente foi entregue em cada compra -->
                                    <?php echo "Entregue em: ";
                                    echo $linha['estado'];
                                    echo "," ?>
                                    <?php echo $linha['cidade'];
                                    echo "," ?>
                                    <?php echo $linha['bairro'];
                                    echo "," ?>
                                    <?php echo $linha['rua'];
                                    echo "," ?>
                                    <?php echo  $linha['numero_casa'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }

                //se o cliente não compro nada ainda o historico vai estar vazio
            } else {
                ?>
                <div class="historico-vazio">
                    Você não comprou nada ainda
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</body>
<!-- linkes do js -->
<script src="../js/menu.js"></script>

</html>