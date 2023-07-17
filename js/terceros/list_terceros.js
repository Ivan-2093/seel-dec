const tableTerceros = document.getElementById("tableTerceros");
const formEditTercero = document.getElementById("formEditTercero");
const btnSubmitEditTercero = document.getElementById("btnSubmitEditTercero");

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

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadTerceros();
});

function loadTerceros() {
	showLoading(cargando);
	fetch(`${base_url}TercerosController/loadTerceros`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			tableTerceros.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableTerceros.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			Swal.fire({
				title: "ERROR",
				html: `Ha ocurrido un error:( <strong>${error}</strong> ), contacte con el departamento de sistemas o intentenuavamente.`,
				icon: "error",
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
				willClose: () => {
					location.reload();
				},
			});
			hiddenLoading(cargando);
		});
}

comboPais.addEventListener("change", () => {
	if (comboPais.value !== "") {
		showLoading(cargando);
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
				$("#comboDepto").val($("#comboDeptoBan").val());
				var event = new Event("change");
				comboDepto.dispatchEvent(event);
				hiddenLoading(cargando);
			})
			.catch(function (error) {
				hiddenLoading(cargando);
			});
	}
});

comboDepto.addEventListener("change", function () {
	if (comboDepto.value !== "") {
		showLoading(cargando);
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
				$("#comboMunicipio").val($("#comboMunicipioBan").val());
				hiddenLoading(cargando);
			})
			.catch(function (error) {
				Swal.fire({
					title: "ERROR",
					html: `Ha ocurrido un error:( <strong>${error}</strong> ), contacte con el departamento de sistemas o intentenuavamente.`,
					icon: "error",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						location.reload();
					},
				});
				hiddenLoading(cargando);
			});
	}
});

function editTercero(data) {
	let data_tercero = JSON.parse(data.getAttribute("data"));
	console.table(data_tercero);

	$("#inputTipoDoc").val(data_tercero[0]);
	comboPais.focus();
	$("#comboPais").val(data_tercero[11]);
	var event = new Event("change");
	comboPais.dispatchEvent(event);

	$("#comboDeptoBan").val(data_tercero[12]);
	$("#comboMunicipioBan").val(data_tercero[13]);

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

	$("#modalEditTercero").modal({
		keyboard: false,
	});

}

btnSubmitEditTercero.addEventListener("click", function () {
	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formTercero = new FormData(formEditTercero);
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

function createTercero(data_update) {
	showLoading(cargando);
	fetch(`${base_url}TercerosController/editTercero`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_update,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] === "success") {
				Swal.fire({
					title: "EXITO",
					html: `Se ha realizado el registro del tercero exitosamente`,
					icon: "success",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						location.reload();
					},
				});
			} else if (json["response"] === "error") {
				Swal.fire({
					title: "ERROR",
					html: `Ha ocurrido un error al realizar el registro, intente nuevamente.`,
					icon: "error",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {},
				});
			} else if (json["response"] === "warning") {
				Swal.fire({
					title: "ADVERTENCIA",
					html: `El tercero que esta intentando registrar, ya se encuentra registrado.`,
					icon: "warning",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {},
				});
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			Swal.fire({
				title: "ERROR",
				html: `Ha ocurrido un error:( <strong>${error}</strong> ), contacte con el departamento de sistemas o intentenuavamente.`,
				icon: "error",
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
				willClose: () => {
					location.reload();
				},
			});
			hiddenLoading(cargando);
		});
}
