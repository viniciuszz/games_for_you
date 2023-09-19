'use strict'

const slideWrapper = document.querySelector('[data-slide="wrapper"]') //variável que não muda ou seja é constante; querySelector pega os elementos dentro de todo o slide
const slideList = document.querySelector('[data-slide="list"]') // váriavel que pega os elementos do slide ou seja todas as imagens do slide
const navPreviousButton = document.querySelector('[data-slide="nav-previous-button"]') // variavel que pega o botão que retorna os slides 
const navNextButton = document.querySelector('[data-slide="nav-next-button"]') // variavel que pega o botão que vai pro próximo slide 
const controlsWrapper = document.querySelector('[data-slide="controls-wrapper"]') // variavel que pega o botão que retorna os slides 
let slideItems = document.querySelectorAll('[data-slide="item"]') // variavel que pega todos os botões será usado para colocar os botões conforme o número de slides no index por enquanto manual
let controlButtons // variavel que pega todos elementos que tem data-slide="item" a pricipior o querySelector só pega o primeiro que aparece no documento mas com o ALL estamos pegando todos
let slideInterval // coloca o intervalo dos slides nesse let

const state = { 
    startingPoint: 0, //Variavel que armazena o ponto que foi clicado
    savedPosition: 0, // Variavel que armazena o ponto em que soltou o mouse no slide 
    currentPoint: 0, // Variavel que armazena o startingPoint - savedPosition para o slide começar de onde o mouse foi solto
    movement: 0, //varaivel que diminui o valor do primeiro pixel clicado pelo pixel que você arrastou
    currentSlideIndex: 0, // salva em qual slide o usuario soltou o botão direito do mouse
    autoPlay: true, // autoplay começa padronizado como verdadeiro
    timeInterval: 0
}

function translateSlide({ position }) { // função para transição entre os slides 
    state.savedPosition = position // Última posição que o botão esquerdo do mouse foi solto
    slideList.style.transform = `translateX(${position}px)` //Faz o slide se movimentar quando arrasta diminuindo o ponto de partida pelo ponto arrastado
}

function getCenterPosition({ index }) {
    const slideItem = slideItems[index] //pegando o valor do slideItems e armazenando nessa nova variavel
    const slideWidth = slideItem.clientWidth // Última posição que o botão esquerdo do mouse foi solto
    const windowWidth = document.body.clientWidth  //Faz o slide se movimentar quando arrasta diminuindo o ponto de partida pelo ponto arrastado
    const margin = (windowWidth - slideWidth) / 2  // variavel que calcular o espaço em 'branco' entre os slides
    const position = margin - (index * slideWidth)
    return position // Vai retornar o getCenterPosition com o valor do position
}

function setVisibleSlide({ index, animate }) { // Função para pegar o data-index os {} fazem ele pegar o index: e o seu valor
    if(index === 0 || index === slideItems.length - 1) { // se o index estiver indo pro último ou se ele estiver indo pro primeiro
        index = state.currentSlideIndex //irá dar uma pequena 'travada' para que caso a pessoa passe rápido de mais antes do transition end acabar 
    }
    const position = getCenterPosition({ index })
    state.currentSlideIndex = index //pegando o valor do slideItems e armazenando nessa nova variavel
    slideList.style.transition = animate === true ? 'transform .5s' : 'none' //pegando a largura da imagem de cada slide
    activeControlButton({ index })
    translateSlide({position: position}) //Atualizando a váriavel currentSlideIndex
}

function nextSlide() { // subfunção para ir pro próximo slide
    setVisibleSlide({ index: state.currentSlideIndex + 1, animate: true}) // puxa a função do setVisibleSlide e da o valor do index + 1
}

function previousSlide() {
    setVisibleSlide({ index: state.currentSlideIndex - 1, animate: true}) // puxa a função do setVisibleSlide e da o valor do index + 1
}

function createControlButtons() { // Função para criar os Botões abaixo do slide, correspondendo a quantidade de slideItems
    slideItems.forEach(function(){ // Criando uma função com o valor do slideItems
        const controlButton = document.createElement('button') //variavel para criar os botões
        controlButton.classList.add('slide-control-button') // coloca a class em todos os botões gerados
        controlButton.classList.add('fas') // coloca a class em todos os botões gerados
        controlButton.classList.add('fa-circle') // coloca a class em todos os botões gerados
        controlButton.dataset.slide = 'control-button' // pega o data-index do html
        controlsWrapper.append(controlButton) // serve para adiconar os botões no final, ou seja quando tiver mais um slide será adicionado na direita do último adicionado
    })
}

function activeControlButton({ index }) {  //Função para mesmo quando for clicado nos botões 'Setas' o active ir pro slide feito
    const slideItem = slideItems[index] // pega o index do slideItems e coloca nessa variavel
    const dataIndex = Number(slideItem.dataset.index) // pega o primeiro slide que técnicamente seria o clone do penúltimo slide e seta para ir como número para o devido o slide, por exemplo o primeiro slide tecnicamente é o clone do penúltimo então ele irá setar o dataIndex como data-index =1
    const controlButton = controlButtons[dataIndex] // pega o elemento que ewstamos chamando no caso seria o controlButton  
    controlButtons.forEach(function(controlButtonItem) { // Pega o controlButton e faz uma função para remover a class active
        controlButtonItem.classList.remove('active') //Remove a class active dos botões que não estão ativos
    })
    if(controlButton) controlButton.classList.add('active') // puxa a class active do css
}

function createSlideClones() {
    const firstSlide = slideItems[0].cloneNode(true) // clona o primeiro slide 
    firstSlide.classList.add('slide-cloned') // clona o segundo slide 
    firstSlide.dataset.index = slideItems.length // dá uma classe para o primeiro slide clonado

    const secondSlide = slideItems[1].cloneNode(true) // dá uma classe para o segundo slide clonado 
    secondSlide.classList.add('slide-cloned') // seta o data-index como 8
    secondSlide.dataset.index = slideItems.length + 1 // seta o data-index como 9

    const lastSlide = slideItems[slideItems.length - 1].cloneNode(true) // clona o último slide 
    lastSlide.classList.add('slide-cloned') // clona o penúltimo slide
    lastSlide.dataset.index = -1 // seta o data-index como -1 

    const penultimateSlide = slideItems[slideItems.length - 2].cloneNode(true) // clona o penúltimo slide 
    penultimateSlide.classList.add('slide-cloned')  // dá uma class pro penúltimo slide clonado
    penultimateSlide.dataset.index = -2 // seta o data-index como -2

    slideList.append(firstSlide) // joga o clone do primeiro slide para ficar após o último
    slideList.append(secondSlide) // joga o clone do segundo slide para ficar após o clone do primeiro, isso que dá a sensação de infinito
    slideList.prepend(lastSlide) // joga o clone do último slide para ficar antes do primeiro slide
    slideList.prepend(penultimateSlide) // joga o clone do penúltimo slide para ficar antes do clone do último, isso que dá a sensação de infinito

    slideItems = document.querySelectorAll('[data-slide="item"]') // variavel que pega todos elementos que tem data-slide="item" a pricipior o querySelector só pega o primeiro que aparece no documento mas com o ALL estamos pegando todos
}

function onMouseDown(event, index) { //Função para quando clicar no mouse
    const slideItem = event.currentTarget
    state.startingPoint = event.clientX //pega a posição do X  quando clicar
    state.currentPoint = event.clientX - state.savedPosition // EXplicado anteriormente quando criei a variavel
    state.currentSlideIndex = index // pega o número do slide pelo data-slide do html
    state.currentSlideIndex = index
    slideList.style.transition = 'none' // para o transition quando solta o botão esquerdo do mouse
    slideItem.addEventListener('mousemove', onMouseMove) //função para quando mexer o mouse enquanto está clicado
}

function onMouseMove(event) { //Função para movimentar o slide quando ele segurar o botão do mouse e arrastar 
    state.movement = event.clientX - state.startingPoint //varaivel que diminui o valor do primeiro pixel clicado pelo pixel que você arrastou
    const position = event.clientX - state.currentPoint // Variavel que diminui o valor do ponto em que clicou pela variavel que armazena o ponto que foi solto antes
    translateSlide({ position }) //Faz o slide se movimentar quando arrasta diminuindo o ponto de partida pelo ponto arrastado
}

function onMouseUp(event) { //Função para quando solta o botão direito do mouse
    const pointsToMove = event.type.includes('touch') ? 50 : 150 // Se o tipo do event tiver touch ou seja se estiver fazendo a função a qual tem touch irá mover apenas após 50 pixels se não será 150 pixels
    if(state.movement < -pointsToMove) {  // se a movimentação mover mais de 150px para direita irá passar para o próximo slide
        nextSlide() // Está pegando a subfunção do nextSlide
    } else if (state.movement > pointsToMove) { //se a movimentação mover mais de 150px para esquerda irá passar para o slide anterior
        previousSlide() // está pegando a subfunção do previousSlide
    } else { // Caso o movimento não seja nem 150 pixels para direita nem para esquerda ele irá ficar no mesmo slide
        setVisibleSlide({ index: state.currentSlideIndex, animate: true}) // puxa a função do setVisibleSlide e da o valor do index + 1
    }
    state.movement = 0 // Faz a variavel movement virar 0 para que possamos calcular novamente
    const slideItem = event.currentTarget
    slideItem.removeEventListener('mousemove', onMouseMove) // atualiza a variavel slideItems para adicionar os clones, porém no initSlide tem que vim depois de criar o botão para que ele não conte com os clones
}

function onTouchStart(event, index) { //função para quando segurar o touch
    event.clientX = event.touches[0].clientX //Pega o ClientX que seria o pixel na horizontal, como não tem na raiz do evento do Touch precisamos entrar na area de touches para depois pegar o clientX
    onMouseDown(event, index) //pega o mouse down com o seu event e index
    const slideItem = event.currentTarget
    slideItem.addEventListener('touchmove', onTouchMove)
}

function onTouchMove (event) { // função para quando mover no Touch
    event.clientX = event.touches[0].clientX //Pega o ClientX que seria o pixel na horizontal, como não tem na raiz do evento do Touch precisamos entrar na area de touches para depois pegar o clientX
    onMouseMove(event) //Pega a função onMouseMove
}

function onTouchEnd(event) { // função para quando parar de segurar o Touch
    onMouseUp(event) // Pega a função onMouseUp
    const slideItem = event.currentTarget
    slideItem.removeEventListener('touchmove', onTouchMove) // remove a função de mover o touch 
}

function onControlButtonClick(index) { // função para quando clicarmos no botão
    setVisibleSlide({ index: index + 2, animate: true }) // seta o index do botão clicado
}

function onSlideListTransitionEnd() { // função para quando termina a transição do último slide para o primeiro ou vice-versa
    const slideItem = slideItems[state.currentSlideIndex]
    
    if(slideItem.classList.contains('slide-cloned') && Number(slideItem.dataset.index) > 0) { // Se o slideItem tiver a clase de clone e o data index for maior que zero executa o if 
        setVisibleSlide({ index: 2, animate: false }) // voltará pro primeiro slide
    }
    if(slideItem.classList.contains('slide-cloned') && Number(slideItem.dataset.index) < 0) { // Se o slideItem tiver a class de clone e o data index for menor que 0 executa o if
        setVisibleSlide({ index: slideItems.length - 3, animate: false }) // irá para o último slide
    }
}

function setAutoPlay() { // function para deixar o slide aútomatico
    if(state.autoPlay) { // se puxarmos o state.autoplay
        slideInterval = setInterval(function() { //Pega a variavel slideInterval e deixa igual ao setInterval
            setVisibleSlide({index: state.currentSlideIndex + 1 , animate: true}) //Passa os slides com a animação ativada
        }, state.timeInterval)
    }
}

function setListeners() { //função que pega a maioria dos addListeners
    controlButtons = document.querySelectorAll('[data-slide="control-button"]') // variavel que pega todos os botões de baixo do slide serão para passar pra um slide expecifico respectivamente ou seja se clicar no primero irá para o primeiro slide, se clicar no último irá para o último
    controlButtons.forEach(function(controlButton, index) { // faz o botão ir pro index certo
        controlButton.addEventListener('click', function(event) { //Adicionar uma ação para quando for clicado fazer a função abaixo
            onControlButtonClick(index) //Pega a função onControlButtonClick
        })
    })

    slideItems.forEach(function(slideItem, index) { //função que pega de cada slideItem o número do data-index
        slideItem.addEventListener('dragstart', function(event) { //função para quando estiver arrastando o mouse com ele clicado
            event.preventDefault()
        })
        slideItem.addEventListener('mousedown', function(event) {
            onMouseDown(event, index) //função para quando apertamos o mouse
        })
        slideItem.addEventListener('mouseup', onMouseUp) //função para quando soltar o mouse
        slideItem.addEventListener('touchstart', function(event) { // função criada para quando clicar com o touch
            onTouchStart(event, index) //função para quando apertamos o mouse
        })
        slideItem.addEventListener('touchend', onTouchEnd) //função para quando retirar o dedo do touch
    })
    
    navNextButton.addEventListener('click', nextSlide) //Quando clicarmos no botão navNextButton irá para o proximo slide
    navPreviousButton.addEventListener('click', previousSlide) // Quando clicarmos no botão navPreviousSlide irá para o slide anterior
    slideList.addEventListener('transitionend', onSlideListTransitionEnd)  // Quando a transição terminar  irá exaecutar a função onSlideListTransitionEnd
    slideWrapper.addEventListener('mouseenter', function() { // função para Quando o mouse estiver em cima ele para o slide automatico
        clearInterval(slideInterval)
    })
    slideWrapper.addEventListener('mouseleave', function() {  //Quando retirar o mouse de cima do slide irá voltar o aútomatico
        setAutoPlay()
    })
    let resizeTimeout // Variavel para retormar o slide pro meio mesmo após diminuir a tela
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout)
        resizeTimeout = setTimeout(function() {
            setVisibleSlide({index: state.currentSlideIndex, animate: true})
        }, 1000)
    })
}

function initSlider({startAtIndex = 0, autoPlay = true, timeInterval = 3000}) { //função para chamar todos os começos de function importante de uma vez
    state.autoPlay = autoPlay //Seta o autoplay como true
    state.timeInterval = timeInterval // seta um valor fixo para o intervalo de tempo
    createControlButtons() //Começo da criação dos botões
    createSlideClones() // chama a função createSlideClone
    setListeners() //Chama as funções do setListeners
    setVisibleSlide({ index: startAtIndex + 2, animate: true }) //faz começar no meio para não deixar colcado na ponta esquerda
    setAutoPlay() // puxa a função para começar o slide automatico
}

