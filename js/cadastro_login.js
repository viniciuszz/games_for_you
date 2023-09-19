

//recebe o formulario login
var formSignin = document.querySelector('#signin')
//recebe o formulario cadastrar
var formSignup = document.querySelector('#signup')
//recebe o botão
var btnColor = document.querySelector('.btnColor')
//logar
document.querySelector('#btnSignin')
  .addEventListener('click', () => {
    //move o formulario de login 25px para esquerda
    formSignin.style.left = "25px"
    //move o formulario cadastro 450px para esquerda
    formSignup.style.left = "450px"
    //mantem a cor do botão no mesmo
    btnColor.style.left = "0px"
  })
//estabelece
document.querySelector('#btnSignup')
  .addEventListener('click', () => {
    //move o formulario -450px para a esquerda direcinado o formulario até seu lugar de origem
    formSignin.style.left = "-450px"
    //move o formulario 25px para esquerda  
    formSignup.style.left = "25px"
    //move a cor do botão
    btnColor.style.left = "110px"

  })

