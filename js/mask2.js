//pega valor do cep pelo id
const inputcep = document.querySelector('#cep')
//adiciona um evento caso o usuario aperte uma tecla
inputcep.addEventListener('keypress', () => {
   //pega o valor da largula do cep
    let inputLength1 = inputcep.value.length
     // MAX LENGTH 9 CEP
     //se ouver 5 caracteres ele irá adicionar -
     if (inputLength1 == 5) {
      //adicona um - no input
        inputcep.value += '-'
     }
    })