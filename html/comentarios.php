<?php
include('../php/admverificar.php');
include('../php/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="../css/tabela_menu.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
</head>

<body>
    <h1>Comentarios dos usuarios</h1>
    <div class="comentarios-geral">
        <?php
        $id_produto = $_GET['id_produto'];
        //seleciona a avaliação pelo id do produto com o nome do usuario qtd de estrelas
        $select = "SELECT * FROM avaliacos,usuario WHERE avaliacos.id_produto = '$id_produto' AND avaliacos.id_usu = usuario.id_usu ";
        //faz a conexao com o banco de dados
        $conect = mysqli_query($mysqli, $select);

        //conta o numero de linhas se ele for maior que zero exite pelo menos uma avaliação
        if ($cont = mysqli_num_rows($conect) > 0) {
            //faz um laço de repeticão para mostrar todos os resultados do select 
            while ($linhac = $conect->fetch_assoc()) {
        ?>
        <!-- mostra os comentarios feitos pelo usuario -->
                <div class="div-comentarios">
                    <div class="nome">
                        <?php echo $linhac['nome'] . '<br>'; ?>
                    </div>
                    <p>&#11088; <?php echo $linhac['qtd_estrela'] . '<br>'; ?></p>
                    <div class="comentario">
                        <?php echo $linhac['comentario']; ?>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "Nenhum usuario comentou ainda";
        }
        ?>
    </div>
</body>

</html>