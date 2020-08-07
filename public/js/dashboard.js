onload = function(){

    setTimeout(welcome, 500),
    setTimeout(fadeWelcome, 5000)

    function welcome(){
        h1 = document.createElement('h1'),
        h1.innerText = 'Bienvenido',
        h1.style.fontSize = '6em',
        h1.style.className = 'mdl-grid',

        h2 = document.createElement('h2')
        if (role == 'Doctor') {
            h2.innerText = 'Dr. '+names
        } else{
            h2.innerText = names
        }
        h2.style.className = 'mdl-grid',

        div_cover = document.createElement('div'),
        div_cover.id = 'div_cover',
        div_cover.style.width = '100%',
        div_cover.style.height = '100%',
        div_cover.style.background = 'grey',
        div_cover.style.opacity = '0.8',
        div_cover.style.position = 'absolute',
        div_cover.style.animationName = 'liftup',
        div_cover.style.animationDuration = '4s',
        div_cover.style.backgroundSize = 'cover',
        div_cover.style.display = 'flex',
        div_cover.style.justifyContent = 'center',
        div_cover.style.alignItems = 'center',
        div_cover.style.zIndex = '2'; //Coloca el div de primero cubriendo el resto
        div_cover.appendChild(h1),
        div_cover.appendChild(h2),

        header = document.getElementsByTagName('header'),
        header[0].style.zIndex = '1',
        document.body.style.zIndex = '1', //Coloca las cartas de fondo
        document.body.appendChild(div_cover)
    }

    function fadeWelcome(){
        div_cover = document.getElementById('div_cover'),
        div_cover.style.animationName = 'turndown',
        setTimeout(function(){
            div_cover.parentNode.removeChild(div_cover)
        }, 4000)

    }
}