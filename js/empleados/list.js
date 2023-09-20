const formEmpleado = document.getElementById("formEditarEmpleado");
const inputIdTercero = document.getElementById("inputIdTercero");
const inputIdCargoEmp = document.getElementById("inputIdCargoEmp");
const inputIdSedeEmp = document.getElementById("inputIdSedeEmp");
const inputFileImgEmp = document.getElementById("inputFileImgEmp");
const inputEmailEmp = document.getElementById("inputEmailEmp");
const inputTelefonoEmp = document.getElementById("inputTelefonoEmp");
const btnSubmitEditEmpleado = document.getElementById("btnSubmitEditEmpleado");
const inputIdTerceroHidden = document.getElementById("inputIdTerceroHidden");

/* ARRAY DE INPUTS */
const arrayInputs = [
	inputIdTercero,
	inputIdCargoEmp,
	inputIdSedeEmp,
];

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadTableEmpleados();
});

const tableEmpleados = document.getElementById("tableEmpleados");
function loadTableEmpleados() {
	showLoading(cargando);
	fetch(`${base_url}EmpleadosController/loadTableEmpleados`, {
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
			$(`#${tableEmpleados.id}`).dataTable().fnDestroy();
			tableEmpleados.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableEmpleados.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

inputTelefonoEmp.addEventListener("keypress", function () {
	isOnlyNumber();
});

function editarEmpleado(data) {
	const data_empleado = JSON.parse(data.getAttribute("data"));
    inputIdTerceroHidden.value = data_empleado[0];
	$("#inputIdTercero").val(data_empleado[0]);
	$("#inputIdCargoEmp").val(data_empleado[1]);
	$("#inputIdSedeEmp").val(data_empleado[2]);
	imagenPrevisualizacion.src = base_url + "/media/imagenes/empleados/" + data_empleado[4];
	inputEmailEmp.value = data_empleado[3];
	inputTelefonoEmp.value = data_empleado[6];

	$(".js-select2-tercero").select2({
		placeholder: "Seleccione un tercero",
		width: "resolve",
	});
	$(".js-select2-cargo").select2({
		placeholder: "Seleccione un cargo",
		width: "resolve",
	});
	$(".js-select2-sede").select2({
		placeholder: "Seleccione una sede",
		width: "resolve",
	});

	$("#modalEditEmpleado").modal("show");
}

btnSubmitEditEmpleado.addEventListener("click", function () {
	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formEmpleado = new FormData(formEmpleado);
		editEmpleado(data_formEmpleado);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.previousElementSibling.innerText;
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Para cargar la información, debe completar todos los campos del formulario: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoidsSelect(inputsVoid);
			},
		});
	}
});

function editEmpleado(data_formEmpleado) {
	showLoading(cargando);
	fetch(`${base_url}EmpleadosController/editEmpleado`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_formEmpleado,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] === "success") {
				Swal.fire({
					title: "Exito",
					html: `Se ha actualizado el empleado exitosamente!`,
					icon: "success",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						location.reload();
					},
				});
			} else if (json["response"] === "warning") {
				Swal.fire({
					title: "Advertencia",
					html: `${json["sms"]}`,
					icon: "warning",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
				});
			} else if (json["response"] === "error") {
				Swal.fire({
					title: "Error",
					html: `${json["sms"]}`,
					icon: "error",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
				});
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

inputEmailEmp.addEventListener("blur", function () {
	validarEmail(inputEmailEmp);
});
