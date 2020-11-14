const webs=document.getElementById('webs');
const formWeb=document.getElementById('formWeb');
const enlaces=document.getElementsByClassName('enlaces');

if(borrar = document.getElementById('borrar')){
	borrar.addEventListener('click',()=>{
	const form = new FormData();
		form.append('borrar','si');
		fetch(`panel.php`,{
			method:'POST',
			body:form
		})
		.then( (peticion) => {
			if (peticion.ok){
				return peticion;
			}else{
				throw 'no se pudo conectar';
			}
		})
		.then( (datosJSON) => {
			return datosJSON.json();
		})
		.then( (borrar)=>{
			if(borrar==='anduvo'){
				websArray=Array.from(webs.querySelectorAll('.enlaces'));
				websArray.map(parEnlace=>webs.removeChild(parEnlace));
				alert('Sus Webs se borraron correctamente');
			}else{
				alert('Ocurrio un error');
			}
		})
		.catch( (err) => console.log(err) );
	})
}

formWeb.addEventListener('submit', (e) => {
	e.preventDefault();
	const datos = new FormData(formWeb);
	const name=datos.get('nombre');
	if ((name===null) || (name.trim().length===0)){
		alert('Ingrese el nombre para su Web');
	}else{
		
		fetch(`panel.php?name=${name.trim()}`)
			.then( (peticion) => {
				return peticion.ok ? Promise.resolve(peticion):Promise.reject(peticion)
			})
			.then( (datosJSON) => {
				return datosJSON.json();
			})
			.then( (crear) => {
				if (crear==='no'){
					alert("Esa Web ya existe");
				}else{
					const fragment = document.createDocumentFragment()
					const a = document.createElement('A');
					const b = document.createElement('A');
					a.setAttribute('href', `webs/${crear.dominio}`);
					a.setAttribute('target', '_blank');
					a.classList.add('web');
					a.textContent = crear.dominio;
					b.setAttribute('href', `webs/${crear.dominio}.zip`);
					b.setAttribute('target', '_blank');
					b.textContent = 'Descargar web';
					fragment.appendChild(a);
					fragment.appendChild(b);
					const div = document.createElement('DIV');
					div.setAttribute('class', 'enlaces');
					div.appendChild(fragment);
					webs.appendChild(div);
				}
			})
			.catch( (err) => console.log(err) )
	}
})