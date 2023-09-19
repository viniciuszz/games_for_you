function openModal(){
    const modal = document.getElementById('modal-container')
    //cria uma classe para mostrar o modal e sobrepor o display: none pelo display: flex
    modal.classList.add('mostrar')
//cria um evento para efetur o fechamento do modal se o usuario clikar no botão de fechar ou fora do molda
    modal.addEventListener('click', (e) =>{
    //condisão para fechar o modal
        if (e.target.id == 'modal-container' || e.target.id == "fechar"){
            //remove a classs mostrar tirando o display:flex pelo display:none
            modal.classList.remove('mostrar')
            localStorage.fechaModal = 'modal-container'
        }
    })
}
