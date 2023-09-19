//função para verificar se as duas senhas são iguais
function validar() {
    //pega 
    var senha = formulario.senha.value;
    var rsenha = formulario.rsenha.value;
    //se as senhas forem  diferentes 
    if (rsenha != senha) {
        //exibe um aviso
        alert('senha não são  iguais');
        //caso erro o ele foca no repitir senha
        formulario.rsenha.focus();
        //retona falso
        return false;
    }
}
//arquivo funcoes_cpf.js
// validador CPF
function verificarCPF(c) {
    var i;
    s = c;
    
    //pega os 9 primeiros digitos
    var c = s.substr(0, 9);
    //pega os 2 ultimos digitos
    var dv = s.substr(9, 11);
    var d1 = 0;

    for (i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (10 - i);
    }
    //não permite que o usuario digite 0 para não danificar a logica
    if (d1 == 0) {
        //exibe um aviso
        alert("CPF Inválido");
        //apaga o valor do input do cpf
        document.getElementById("cpf").value = "";
        //retona falso
        return false;
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1) {
        //exibe um aviso
        alert("CPF Inválido");
        //apaga o valor do input do cpf
        document.getElementById("cpf").value = "";
        //retona falso
        return false;
    }

    d1 *= 2;
    for (i = 0; i < 9; i++) {
        //charat pega  pega o primeiro digito
        d1 += c.charAt(i) * (11 - i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1) {
        //exibe um aviso
        alert("CPF Inválido");
        //apaga o valor do input do cpf
        document.getElementById("cpf").value = "";
        //retona falso
        return false;
    }
    //proibe a sequencia de numeros que pasão no calculo de cpf
    if (s == "11111111111" || s == "22222222222" || s == "33333333333" || s == "44444444444" || s == "55555555555" || s == "66666666666" || s == "77777777777" || s == "88888888888" || s == "99999999999" || s == "12345678909") {
        //exibe um aviso
        alert("CPF Inválido");
        //apaga o valor do input do cpf
        document.getElementById("cpf").value = "";
        //retona falso
        return false;
    }

}
