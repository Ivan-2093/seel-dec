/* *****************************************SCRIPT PARA ETAPA 1 : INF CLIENTE*********************************************** */

/* FORMULARIO */
const btnSubmitCreateTercero = document.getElementById(
	"btnSubmitCreateTercero"
);
const btnSubmitReset = document.getElementById("btnSubmitReset");
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

const inputIdTercero = document.getElementById("inputIdTercero");
const inputIdCliente = document.getElementById("inputIdCliente");

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
		data_formTercero.append("id_negocio", id_negocio.value);
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

inputNumeroDoc.addEventListener("change", () => {
	load_data_tercero();
});

function load_data_tercero(id_ter = "") {
	if (inputNumeroDoc.value != "" || id_ter != "") {
		showLoading(cargando);
		const form_tercero_by_nit = new FormData();
		form_tercero_by_nit.append("nit", inputNumeroDoc.value);
		form_tercero_by_nit.append("id_tercero", id_ter);
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
				if (json["response"] == "success") {
					const data_tercero = json["data"];
					pintar_formulario(data_tercero);
					inputIdCliente.value = json["id_cliente"];
				} else {
					formTercero.reset();
					disabledFormulario("false");
				}
				setTimeout(() => {
					hiddenLoading(cargando);
				}, 3000);
			})
			.catch(function (error) {
				reportError(error);
				hiddenLoading(cargando);
			});
	}
}

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

	disabledFormulario("true");
}

function disabledFormulario(opcion) {
	inputNumeroDoc.disabled = opcion;
	inputFirstName.disabled = opcion;
	inputSecondName.disabled = opcion;
	inputFirstSurName.disabled = opcion;
	inputSecondSurName.disabled = opcion;
	inputEmail.disabled = opcion;
	inputTelefono_1.disabled = opcion;
	inputTelefono_2.disabled = opcion;
	inputIdGenero.disabled = opcion;
	inputDireccion.disabled = opcion;
	inputBarrio.disabled = opcion;
	inputIdTercero.disabled = opcion;
	inputTipoDoc.disabled = opcion;
	comboPais.disabled = opcion;
	comboDepto.disabled = opcion;
	comboMunicipio.disabled = opcion;
}

function LoadPais(depto = "", muni = "") {
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

function LoadDepto(muni = "") {
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

btnSubmitReset.addEventListener("click", () => {
	formTercero.reset();
});
