const formEmpleado = document.getElementById("formCreateEmpleado");
const inputIdTercero = document.getElementById("inputIdTercero");
const inputIdCargoEmp = document.getElementById("inputIdCargoEmp");
const inputIdSedeEmp = document.getElementById("inputIdSedeEmp");
const inputFileImgEmp = document.getElementById("inputFileImgEmp");
const inputEmailEmp = document.getElementById("inputEmailEmp");

/* ARRAY DE INPUTS */
const arrayInputs = [
	inputIdTercero,
	inputIdCargoEmp,
	inputIdSedeEmp,
	inputFileImgEmp,
];

const btnSubmitCreateEmpleado = document.getElementById(
	"btnSubmitCreateEmpleado"
);

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
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
});

btnSubmitCreateEmpleado.addEventListener("click", function () {
	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formEmpleado = new FormData(formEmpleado);
		createEmpleado(data_formEmpleado);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.previousElementSibling.innerText;
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Para cargar la información del mantenimiento, debe completar todos los campos del formulario: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoidsSelect(inputsVoid);
			},
		});
	}
});

function createEmpleado(data_formEmpleado) {
	showLoading(cargando);
	fetch(`${base_url}EmpleadosController/createEmpleado`, {
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
					html: `Se ha registrado el empleado exitosamente!`,
					icon: "success",
					confirmButtonText: "Ok",
					allowOutsideClick: false,
					showCloseButton: true,
					willClose: () => {
						location.href = base_url + "EmpleadosController";
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
			Swal.fire({
				title: "Error",
				html: `${error}`,
				icon: "error",
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
			});
			hiddenLoading(cargando);
		});
}

inputEmailEmp.addEventListener("blur", function () {
	validarEmail(inputEmailEmp);
});
