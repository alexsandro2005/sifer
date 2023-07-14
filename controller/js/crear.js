const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	id: /^\d{3,5}$/, // 5 numeros.
	costo: /^\d{4,7}$/, // 5 numeros.
    modelos: /^\d{4}$/, // 4 numeros.
	cilindraje: /^\d{2,4}$/, //2 a 4 numeros.
	marca: /^[a-zA-ZÀ-ÿ\s]{4,20}$/, // Permite solo letras y espacios.
    categoria: /^[a-zA-ZÀ-ÿ\s]{4,20}$/, // Letras y espacios, pueden llevar acentos.

}
const campos = {
    id: false,
    modelo: false,
    categoria: false,
	id_marca: false,
	costo: false,
	marca: false,
	cilindraje: false

}
const validarFormulario = (e) => {
	switch (e.target.id) {

		case "id":
			validarCampo(expresiones.id, e.target, 'id');
		break;
        case "modelos":
			validarCampo(expresiones.modelos, e.target, 'modelos');
		break;

        case "categoria":
			validarCampo(expresiones.categoria, e.target, 'categoria');
		break;
		case "cilindraje":
			validarCampo(expresiones.cilindraje, e.target, 'cilindraje');
		break;
		case "costo":
			validarCampo(expresiones.costo, e.target, 'costo');
		break;
		case "marca":
			validarCampo(expresiones.marca, e.target, 'marca');
		break;

		case "servicios":
			validarCampo(expresiones.servicios, e.target, 'servicios');
		break;


	}
}



const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

const validarPassword2 = () => {
	const inputPassword1 = document.getElementById('password');
	const inputPassword2 = document.getElementById('password2');

	if(inputPassword1.value !== inputPassword2.value){
		document.getElementById(`grupo__password2`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__password2 i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__password2 i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['password'] = false;
	} else {
		document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__password2`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__password2 i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__password2 i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__password2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['password'] = true;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
