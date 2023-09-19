<?php
include('../php/admverificar.php');
include("../php/conexao.php");
if(isset($_GET['id_produto'])){
  $id_produto = $_GET['id_produto'];
  $select = mysqli_query($mysqli,"SELECT caminho FROM produtos WHERE id_produto = '$id_produto'");
  if(mysqli_num_rows($select) > 0){
    $consulta = mysqli_fetch_assoc($select);
  }
  
   
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadm.css">
    <title>Document</title>
</head>
<body>

<form method="post" class="formularioimg" id="uploadForm" enctype="multipart/form-data">
<h1>Editar imagem</h1>
<div class="fileborder">
<input  name="imagem" type="file" id="arquivo" onchange="previewImagem()"  required>
</div>

<span class="img_previw" id="preview-img">
            <img src="<?php echo $consulta['caminho']; ?>" alt="Imagem" style="width: 95px; height: 115px; margin: 10px;">
        </span><br><br>
<input type="submit" name="editimg" id="uploadBtn" value="Editar imagem"> 
</form>
</body>
<script>


        // Função para apresentar o preview da imagem
        function previewImagem(arquivo) {

            // Receber o seletor do campo
            var arquivo = document.querySelector("#arquivo");

            // Receber o arquivo
            var valorArquivo = arquivo.value;
            // Verificar se existe arquivo
            if ((arquivo.files) && (arquivo.files[0])) {

                // FileReader() - ler o conteúdo dos arquivos
                var reader = new FileReader();

                // onload - disparar um evento quando qualquer elemento tenha sido carregado
                reader.onload = function(e) {

                    // Enviar a imagem para o HTML
                    document.getElementById('preview-img').innerHTML = "<img src='" + e.target.result + "' alt='Imagem' style='width: 100px; height: 100px;'>";
                }
            }

            // readAsDataURL - Retorna os dados do formato blob como uma URL de dados - Blob representa um arquivo
            reader.readAsDataURL(arquivo.files[0]);

        }

 

    </script>

</html>
<?php

//editar a imagem
if(isset($_POST['editimg'])){
  $id_produto = $_GET['id_produto'];
  //pega o arquivo da imagem
  $imagem = $_FILES['imagem'];
  //pega o nome da imagem
  $nomeDoArquivo = $imagem['name'];
   //nome da pasta
   $pasta = "img/";
   //numero aleatorio que sera o novo  nome da imagem
   $novoNomeDaImagem = uniqid();
   //pega extensão do produto
   $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
   //varifica se a extensão e jpg ou png
   if($extensao != "jpg" && $extensao != "png"){
   //exibe um aviso 
 echo '<script>alert("Tipo de arquivo não aceito")</script>';
 
}else{
  //caminho com o nome da pasta novo nome da imagem e a extensao png ou jpg 
 $caminho = $pasta . $novoNomeDaImagem . "." . $extensao;
//copia a imagem para a pasta img
$certo = move_uploaded_file($imagem["tmp_name"], $caminho);
//insere os produtos no banco de dados
$code = "UPDATE produtos SET caminho ='$caminho' WHERE id_produto='$id_produto'";
//conecta com o banco de dados
$conect = mysqli_query($mysqli,$code);
//exibe um aviso 
echo '<script>alert("O produto foi editado com sucesso")</script>';
//redireciona o adm até o admtabelapro
}
}

?>
