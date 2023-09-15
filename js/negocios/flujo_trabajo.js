/* VARIABLES */
const flujo_trabajo = document.getElementById("flujo_trabajo");
const id_negocio = document.getElementById("id_negocio");
document.addEventListener("DOMContentLoaded", () => {
	load_flujo_trabajo();
});

function load_flujo_trabajo() {
	showLoading(cargando);
	const form_flujo_trabajo = new FormData();
	form_flujo_trabajo.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/load_flujo_trabajo`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_flujo_trabajo,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			flujo_trabajo.innerHTML += json["html_flujo"];
			$('[data-toggle="tooltip"]').tooltip(); //
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function obtenerData(etapa_id, opc) {
	switch (etapa_id) {
		case 1:
			if (opc == 0) {
				$("#Información_Cliente").modal("show");
			} else {
			}
			break;
		case 2:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
		case 3:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
		case 4:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
		case 5:
			alert(etapa_id + "\n" + id_negocio.value);
			break;

		case 6:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
	}
}
/* *****************************************SCRIPT PARA ETAPA 1 : INF CLIENTE*********************************************** */


/* FORMULARIO */
const btnSubmitCreateTercero = document.getElementById("btnSubmitCreateTercero");
const btnSubmitReset = document.getElementById('btnSubmitReset');
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
	inputEmail,
	inputTelefono_1,
	comboPais,
	comboDepto,
	comboMunicipio,
	inputDireccion,
];


btnSubmitCreateTercero.addEventListener("click", function () {

	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formTercero = new FormData(formTercero);
		data_formTercero.append('id_negocio',id_negocio.value);
		createTercero(data_formTercero);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.nextElementSibling.innerText;
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Para cargar la información, debe completar todos los campos del formulario: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoids(inputsVoid);
			},
		});
	}



});

function createTercero(data_insert) {
	showLoading(cargando);
	fetch(`${base_url}NegociosController/addCliente`, {
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
			
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
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



const inputIdTercero = document.getElementById('inputIdTercero');
const inputIdCliente = document.getElementById('inputIdCliente');
inputNumeroDoc.addEventListener("change", () => {
	if (inputNumeroDoc.value != "") {
		showLoading(cargando);
		const form_tercero_by_nit = new FormData();
		form_tercero_by_nit.append("nit", inputNumeroDoc.value);
		fetch(`${base_url}TercerosController/searchTercero`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: form_tercero_by_nit,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				if (json['response'] == 'success') {
					const data_tercero = json['data'];
					pintar_formulario(data_tercero);
					inputIdCliente.value = json['id_cliente'];
				}else{
					formTercero.reset();
				}
				setTimeout(() => {
					hiddenLoading(cargando);
				},3000);
				
			})
			.catch(function (error) {
				reportError(error);
				hiddenLoading(cargando);
			});
	}
});

function pintar_formulario(data_tercero) {

	$("#comboPais").val(data_tercero[11]);
	LoadPais(data_tercero[12], data_tercero[13]);
	$("#inputTipoDoc").val(data_tercero[0]);
	inputNumeroDoc.value = data_tercero[2];
	inputFirstName.value = data_tercero[3];
	inputSecondName.value = data_tercero[4];
	inputFirstSurName.value = data_tercero[5];
	inputSecondSurName.value = data_tercero[6];
	inputEmail.value = data_tercero[7];
	inputTelefono_1.value = data_tercero[8];
	inputTelefono_2.value = data_tercero[9];
	inputIdGenero.value = data_tercero[10];
	inputDireccion.value = data_tercero[14];
	inputBarrio.value = data_tercero[15];
	inputIdTercero.value = data_tercero[16];

}



function LoadPais(depto="", muni="") {
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
				$("#comboDepto").val(depto);
				LoadDepto(muni);
			})
			.catch(function (error) {
				reportError(error);
			});
	}
}

function LoadDepto(muni="") {
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
				$("#comboMunicipio").val(muni);
			})
			.catch(function (error) {
				reportError(error);
			});
	}
}

btnSubmitReset.addEventListener('click', () => {
	formTercero.reset();
})

