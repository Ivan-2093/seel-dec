const formCreateProveedor = document.getElementById("formCreateProveedor");
const inputIdTercero = document.getElementById("inputIdTercero");

/* ARRAY DE INPUTS */
const arrayInputs = [inputIdTercero];

const btnSubmitCreateEmpleado = document.getElementById(
	"btnSubmitCreateProveedor"
);

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	$(".js-select2-tercero").select2({
		placeholder: "Seleccione un tercero",
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
		const data_form_proveedor = new FormData(formCreateProveedor);
		createCliente(data_form_proveedor);
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

function createCliente(data_form_proveedor) {
	showLoading(cargando);
	fetch(`${base_url}ProveedoresController/createProveedor`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_form_proveedor,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			Swal.fire({
				title: json["title"],
				html: `${json["html"]}`,
				icon: json["response"],
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
