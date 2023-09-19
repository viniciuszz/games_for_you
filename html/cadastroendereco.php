<?php
include('../php/verificausu.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="icon" href="icons/G4u.png">
    <link rel="stylesheet" href="../css/cadastro_login.css">
    <title>Cadastro de enrereço</title>
</head>
<body>
<!--  formulario para cadastrar os endereços do usuario.Apenas o complemento não obrigatorio -->
    <form method="post" name="formulario" id="formulario" action="../php/cadastroender.php" class="endereco">
        <h1>Cadastre seu endereço</h1>
       <input type="text" id="cep" name="cep" placeholder="CEP" maxlength="9" onblur="pesquisacep(this.value);"><!-- campo para inserir cep -->
    <input type="text" id="cidade" name="cidade" placeholder="Cidade" required><!-- campo para inserir cidade -->
    <input type="text" id="uf"  name="estado" placeholder="Estado" required><!-- campo para inserir estado -->
    <input type="text" id="bairro" name="bairro" placeholder="Bairro" required><!-- campo para inserir bairro -->
    <input type="text" id="rua" name="rua" placeholder="Rua" required><!-- campo para inserir rua -->
    <input type="text" name="numero_casa" placeholder="Numero da casa" required><!-- campo para inserir numero da casa -->
    <input type="text" name="complemento" placeholder="Complemento" ><!-- campo para inserir complemento -->
    <button type="submit" name="cadastroender">Cadastrar endereço</button><!-- botão para cadastrar os endereços -->
    </form>
    <script>
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
          
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
          
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
               

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
    <script src="../js/mask2.js"></script>
</body>
</html>
