const user=document.getElementById('user');
const pass=document.getElementById('pass');
const pass2=document.getElementById('pass2');
const formRegistro=document.getElementById('formRegistro');

formRegistro.addEventListener('submit', (e) => {
	e.preventDefault();
	if ((user.value.trim().length===0) || (pass.value.trim().length===0) || (pass2.value.trim().length===0)){
		alert('Complete todos los campos');
	}else{
		if (!(pass.value===pass2.value)) {
			alert('Las contraseñas ingresadas deben ser iguales');
		}else{
			
			/*Consulta GET con XMLHttpRequest*/

			/*let xhr= new XMLHttpRequest();
			xhr.open('GET', `register.php?user=${user.value.trim()}&pass=${pass.value.trim()}`);
			xhr.addEventListener('load', (registrar) =>{
				if(registrar.target.response==='"no"'){
					alert('Ya existe un usuario con ese mail');
				}else{
					alert('Sus datos se registraron con exito');
					formRegistro.submit();
				}
			})
			xhr.send();*/


			/*Consulta POST con XMLHttpRequest*/

			/*let xhr= new XMLHttpRequest();
			xhr.open('POST', 'register.php');
			const usuario = new FormData();
			usuario.append('user', `${user.value.trim()}`)
			usuario.append('pass', `${pass.value.trim()}`)
			xhr.addEventListener('load', (registrar) =>{
				if (registrar.target.response==='"no"'){
					alert('Ya existe un usuario con ese mail');
				}else{
					alert('Sus datos se registraron con exito');
					formRegistro.submit();
				}
			})
			xhr.send(usuario);*/

			/*const data = new URLSearchParams(`user=${user.value.trim().toString()}&pass=${pass.value.trim().toString()}`);*/

			/*consula GET con fetch*/

			fetch(`register.php?user=${user.value.trim().toString()}&pass=${pass.value.trim().toString()}`)
				.then( (peticion) => {
					return peticion.ok ? Promise.resolve(peticion):Promise.reject(peticion)
				})
				.then( (datosJSON) => {
					return datosJSON.json();
				})
				.then( (registrar) => {
					/*console.log(registrar);*/
					if (registrar==='no'){
						alert('Ya existe ese mail');
					}else{
						alert('Los datos fueron registrados con exito');
						formRegistro.submit();
					}
				})
				.catch( (err) => console.log(err) )

			/*consula POST con fetch*/

			/*const data = new URLSearchParams(`user=${user.value.trim().toString()}&pass=${pass.value.trim().toString()}`);
			fetch('register.php', {
			  	method: 'POST',
			   	body: data
			})
				.then( (peticion) => {
					return peticion.ok ? Promise.resolve(peticion):Promise.reject(peticion)
				})
				.then( (datosJSON) => {
					return datosJSON.json()
				})
				.then( (registrar) => {
					console.log(registrar);
					if (registrar==='no'){
						alert('Ya existe un usuario con ese mail');
					}else{
						alert('Sus datos se registraron con exito');
						formRegistro.submit();
					}
				})
				.catch( (err) => console.log(err) )*/
		}
	}
})