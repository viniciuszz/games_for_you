<?php
include('../php/selectprodutos.php');
include('../php/admverificar.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Link para os icones do google icons, usados no footer e no menu -->
    <link rel="stylesheet" href="../css/tabela_menu.css">
    <link rel="stylesheet" href="../css/EstiloMenu.css">
    <title>Tabela produtos</title>
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
   <?php
 //Obter a data atual
 $data['atual'] = date('Y-m-d H:i:s');	

 //Diminuir 20 segundos 
 $data['online'] = strtotime($data['atual'] . " - 20 seconds");
 //organiza o resultado no formato date time novamente
 $data['online'] = date("Y-m-d H:i:s",$data['online']);
 
 //Pesquisar os ultimos usuarios online nos 20 segundo
 $cont_visitas = "SELECT count(id) as online FROM visitas WHERE data_final >= '" . $data['online'] . "'";

 $resultado_qnt_visitas = mysqli_query($mysqli, $cont_visitas);
 $row_qnt_visitas = mysqli_fetch_assoc($resultado_qnt_visitas);
   ?>
    <h1>Usuarios Online: <?php echo  $row_qnt_visitas['online'] ?></h1>
    <h1>Tabela de Produtos</h1>
    <div class="toda-tabela">
        <!-- cria uma tabela para exibir todos os produtos do site -->
        <table class="table" >
            <!-- cria o titulo de cada coluna -->
            <tr class="trtitulo">
                <th>ID</th>
                <th>Img</th>
                <th>Console</th>
                <th>Nome do Produto</th>
                <th>Data</th>
                <th>Preço</th>
                <th>situação</th>
                <th>Editar</th>
                <th>Editar Img</th>
                <th>Comentarios</th>

            </tr>
            <?php
            //laço de repetisão para exibir todos os resultados
            do {
            ?>
            <!-- exibe os resultados em cada linha correspondente  -->
                <tr>
                    <td><?php echo $linha['id_produto']; ?></td>
                    <div class="imagemhover">
                        <div class="imagem">
                            <td><a target="_blank" href="<?php echo $linha['caminho'] ?>"><img height="80px" width="auto" src="<?php echo $linha['caminho']; ?>"></a></td>
                        </div>
                    </div>
                    <td><?php echo $linha['console'] ?></td>
                    <td> <?php echo $linha['nome'] ?></td>
                    <td><?php echo $linha['data']; ?></td>
                    <td><?php echo "R$";
                        echo number_format($linha['valor'], 2, ",", "."); ?></td>
                    <td><?php echo $linha['situacao']; ?></td>


                    <td><a class="cor-letra-menu" href="editar.php?<?php echo 'id_produto=';
                                                                    echo $linha['id_produto'] ?>">Editar</a></td>
                    <td><a class="cor-letra-menu" href="editarimg.php?<?php echo 'id_produto=';
                                                                        echo $linha['id_produto'] ?>">EditarImg</a></td>
                    <td><a class="cor-letra-menu" href="comentarios.php?<?php echo 'id_produto=';
                                                                        echo $linha['id_produto'] ?>">Comentarios</a></td>

                </tr>
            <?php

            } while ($linha = $conect->fetch_assoc());

            ?>
        </table>
    </div>
</body>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    //Executar a cada 10 segundos, para atualizar a qunatidade de usuários online
		setInterval(function(){
			//Incluir e enviar o POST para o arquivo responsável em fazer contagem
			$.post("../php/visitantes.php", {contar: '',}, function(data){
				$('#online').text(data);
			});
		}, 10000);
</script>
</html>
