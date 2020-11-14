const user=document.getElementById('user');
const pass=document.getElementById('pass');
const formInicio=document.getElementById('formInicio');

formInicio.addEventListener('submit', (e) => {
	e.preventDefault();
	if ((user.value.trim().length===0) || (pass.value.trim().length===0)){
		alert('Complete todos los campos');
	}else{
		

		fetch(`login.php?user=${user.value.trim()}&pass=${pass.value.trim()}`)
			.then( (peticion) => {
				return peticion.ok ? Promise.resolve(peticion):Promise.reject(peticion)
			})
			.then( (datosJSON) => {
				return datosJSON.json();
			})
			.then( (iniciar) => {
				/*console.log(iniciar);*/
				if (iniciar==='no'){
					alert("Esos datos no se encuentran");
				}else{
					formInicio.submit();
				}
			})
			.catch( (err) => console.log(err) )


		
	}

})