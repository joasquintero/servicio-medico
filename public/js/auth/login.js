/* File to mix login and register in one page */

onload = function(e) {
	/* Variables */
	register_container = document.getElementById('register_container'),
	login_container = document.getElementById('login_container'),
	btn_register = document.getElementById('btn_register'),
	btn_login = document.getElementById('btn_login'),

	/* FUNCTIONS */

	//This function calls register form card
	btn_register.onclick = function(e){
		e.preventDefault(),
		login_container.classList.remove('bounceInRight'),
		login_container.style.display = 'none',
		register_container.style.display = 'block',
		register_container.classList.toggle('bounceInLeft')
	}

	//This function calls login form card
	btn_login.onclick = function(e){
		e.preventDefault(),
		register_container.classList.remove('bounceInLeft'),
		register_container.style.display = 'none',
		login_container.style.display = 'block',
		login_container.classList.toggle('bounceInRight')
	}

}

