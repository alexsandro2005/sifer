const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	document: /^\d{6,10}$/, // 6 a 10 numeros.
	placa: /^[a-zA-Z0-9\_\-]{6}$/, // Letras, numeros, guion y guion_bajo
	marca: /^[a-zA-ZÀ-ÿ\s]{3,20}$/, // Letras y espacios, pueden llevar acentos.
	modelo: /^\d{4}$/, // 10 a 12 numeros.
	barcode: /^\d{10}$/, // 10 a 12 numeros.
	km: /^\d{2,6}$/ // 10 a 12 numeros.
}

const campos = {
	document: false,
    marca: false,
	surname: false,
	placa: false,
	modelo: false,
	barcode: false,
	km: false,
	email: false,

}
const validarFormulario = (e) => {
	switch (e.target.name) {
        case "marca":
            validarCampo(expresiones.marca, e.target, 'marca');
        break;

		case "modelo":
            validarCampo(expresiones.modelo, e.target, 'modelo');
        break;

		case "document":
			validarCampo(expresiones.document, e.target, 'document');
		break;

		case "placa":
			validarCampo(expresiones.placa, e.target, 'placa');
		break;
		case "km":
			validarCampo(expresiones.km, e.target, 'km');
		break;	
		case "barcode":
			validarCampo(expresiones.barcode, e.target, 'barcode');
		break;	
		case "email":
			validarCampo(expresiones.email, e.target, 'email');
		break;
		case "password":
			validarCampo(expresiones.password, e.target, 'password');
			validarPassword2();
		break;
		case "password2":
			validarPassword2();
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
