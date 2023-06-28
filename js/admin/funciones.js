const sidebar = document.getElementById("sidebar");
const cargando = document.getElementById("cargando");

/* FORMULARIO */
const btnSubmitCreateTercero = document.getElementById("btnSubmitCreateTercero");
const formTercero = document.getElementById("formCreateTercero");

/* INPUTS DEL FORMULARIO */
const inputTipoDoc = document.getElementById("inputTipoDoc");
const inputNumeroDoc = document.getElementById("inputNumeroDoc");
const inputFirstName = document.getElementById("inputFirstName");
const inputSecondName = document.getElementById("inputSecondName");
const inputFirstSurName = document.getElementById("inputFirstSurName");
const inputSecondSurName = document.getElementById("inputSecondSurName");
const inputIdGenero = document.getElementById("inputIdGenero");
const inputEmail = document.getElementById("inputEmail");
const inputTelefono_1 = document.getElementById("inputTelefono_1");
const inputTelefono_2 = document.getElementById("inputTelefono_2");
const comboPais = document.getElementById("comboPais");
const comboDepto = document.getElementById("comboDepto");
const comboMunicipio = document.getElementById("comboMunicipio");
const inputDireccion = document.getElementById("inputDireccion");
const inputBarrio = document.getElementById("inputBarrio");

/* ARRAY DE INPUTS */
const arrayInputs = [
	inputTipoDoc,
	inputNumeroDoc,
	inputFirstName,
	inputFirstSurName,
	inputIdGenero,
	inputEmail,
	inputTelefono_1,
	comboPais,
	comboDepto,
	comboMunicipio,
	inputDireccion,
];

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	sidebar.classList.add("collapsed"); //Ocultar el nav para cuando terminde de cargar
});

comboPais.addEventListener("change", () => {
	if (comboPais.value !== "") {
		const data_pais = new FormData();
		data_pais.append("id_pais", comboPais.value);
		fetch(`${base_url}TercerosController/deptosByIdPais`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: data_pais,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				comboDepto.innerHTML = json["data_deptos"];
			})
			.catch(function (error) {});
	}
});

comboDepto.addEventListener("change", () => {
	if (comboDepto.value !== "") {
		const data_dpto = new FormData();
		data_dpto.append("id_depto", comboDepto.value);
		fetch(`${base_url}TercerosController/municipiosByIdDepto`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: data_dpto,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				comboMunicipio.innerHTML = json["data_municipios"];
			})
			.catch(function (error) {});
	}
});

btnSubmitCreateTercero.addEventListener("click", function () {

    const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
        const data_formTercero = new FormData(formTercero);
        createTercero(data_formTercero);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.nextElementSibling.innerText;
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Para cargar la información del mantenimiento, debe completar todos los campos del formulario: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoids(inputsVoid);
			},
		});
	}



});

function createTercero(data_insert) {
	fetch(`${base_url}TercerosController/createTercero`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_insert,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if(json['response'] === 'success'){
				Swal.fire({
					title: "EXITO",
					html: `Se ha realizado el registro del tercero exitosamente`,
					icon: "success",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						
					},
				});
			}else if (json['response'] === 'error'){
				Swal.fire({
					title: "ERROR",
					html: `Ha ocurrido un error al realizar el registro, intente nuevamente.`,
					icon: "error",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						
					},
				});
			}else if (json['response'] === 'warning'){
				Swal.fire({
					title: "ADVERTENCIA",
					html: `El tercero que esta intentando registrar, ya se encuentra registrado.`,
					icon: "warning",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						
					},
				});
			}
		})
		.catch(function (error) {

		});
}

inputFirstName.addEventListener("keypress", function () {
	isOnlyText();
});
inputSecondName.addEventListener("keypress", function () {
	isOnlyText();
});
inputFirstSurName.addEventListener("keypress", function () {
	isOnlyText();
});
inputSecondSurName.addEventListener("keypress", function () {
	isOnlyText();
});

inputNumeroDoc.addEventListener("keypress", function () {
	isOnlyNumber();
});
inputTelefono_1.addEventListener("keypress", function () {
	isOnlyNumber();
});
inputTelefono_2.addEventListener("keypress", function () {
	isOnlyNumber();
});

inputEmail.addEventListener("blur", function () {
	validarEmail(inputEmail);
});

