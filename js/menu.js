
const btnMobile = document.getElementById('btn-mobile');//pega o botão pelo id para exibir o slide
function toggleMenu(event) {//função para exibisão do menu
    if (event.type === 'touchstart') event.preventDefault();
    const nav = document.getElementById('nav');//pega a nav para exibir as opsões no menu
    nav.classList.toggle('active');//caso ele ative mostar o menu
    const active = nav.classList.contains('active');
    event.currentTarget.setAttribute('aria-expanded', active);
    if (active) {//caso estiver ativado o menu irá aparecer
        event.currentTarget.setAttribute('aria-label', 'Fechar Menu');//ativa o fechar menu
    } else {//caso não esteja ativado
        event.currentTarget.setAttribute('aria-label', 'Abrir Menu');//ativa o abir menu
    }
}
btnMobile.addEventListener('click', toggleMenu);//adiciona o evendo caso o usuario click
btnMobile.addEventListener('touchstart', toggleMenu);//adiciona o evendo caso o usuario toque no menu