const formCreateProducto = document.getElementById("formCreateProducto");
const inputIdProveedor = document.getElementById("inputIdProveedor");
const inputIdCategoria = document.getElementById("inputIdCategoria");
const inputIdTipoProducto = document.getElementById("inputIdTipoProducto");
const inputCostoElite = document.getElementById("inputCostoElite");
const inputCostoPremium = document.getElementById("inputCostoPremium");
const inputPerPrecio = document.getElementById("inputPerPrecio");
const inputAnchoTela = document.getElementById("inputAnchoTela");
const inputUndMedida = document.getElementById("inputUndMedida");
const inputFactorApertura = document.getElementById("inputFactorApertura");
const inputPasadores = document.getElementById("inputPasadores");
const inputCerradura = document.getElementById("inputCerradura");
const inputLlaves = document.getElementById("inputLlaves");
const inputTipoSegurity = document.getElementById("inputTipoSegurity");
const btnSubmitCreateProducto = document.getElementById("btnSubmitCreateProducto");
const inputReferenciaProducto = document.getElementById("inputReferenciaProducto");
const inputDescripcionProducto = document.getElementById("inputDescripcionProducto");
const isDeco = document.getElementById("isDeco");
const isSegurity = document.getElementById("isSegurity");

/* ARRAY DE INPUTS */
const arrayInputsProduct = [
	inputIdProveedor,
	inputIdCategoria,
	inputIdTipoProducto,
	inputCostoPremium,
	inputPerPrecio,
];

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	$(".js-select2-tercero").select2({
		with: '100%',
		placeholder: "Seleccione un proveedor",
		width: "resolve",
	});
	$(".js-select2-categoria").select2({
		with: '100%',
		placeholder: "Seleccione una categoria",
		width: "resolve",
	});
	$(".js-select2-medida").select2({
		with: '100%',
		placeholder: "Seleccione una medida",
		width: "resolve",
	});
});

$(".js-select2-categoria").on("change", function (e) {
	load_tipo_producto_by_categoria(inputIdCategoria.value);

	if (inputIdCategoria.value == 1) {
		isDeco.hidden = false;
		isSegurity.hidden = true;
	} else {
		isSegurity.hidden = false;
		isDeco.hidden = true;
	}
});

btnSubmitCreateProducto.addEventListener("click", function () {
	const inputsVoid = arrayInputsProduct.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_form_producto = new FormData(formCreateProducto);
		createProducto(data_form_producto);
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

inputCostoElite.addEventListener("keyup", () => {
	aplicarNuberFormat(inputCostoElite);
});

inputCostoPremium.addEventListener("keyup", () => {
	aplicarNuberFormat(inputCostoPremium);
});
inputPerPrecio.addEventListener("keypress", () => {
	isOnlyNumber();
});

function createProducto(data_form_producto) {
	showLoading(cargando);
	fetch(`${base_url}ProductosController/createProducto`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_form_producto,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			Swal.fire({
				title: json["title"],
				html: `${json["sms"]}`,
				icon: json["response"],
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
			}).then((result) => {
				if(json["response"] == 'success') {
					location.reload();
				}
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
function load_tipo_producto_by_categoria(id_categoria) {
	const form_categoria = new FormData();
	form_categoria.append("id_categoria", id_categoria);
	fetch(`${base_url}ProductosController/load_tipo_producto_by_categoria`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_categoria,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			inputIdTipoProducto.innerHTML = json["html_select"];

			$(".js-select2-tipo-producto").select2({
				placeholder: "Seleccione un tipo",
				width: "resolve",
			});
		})
		.catch(function (error) {
			reportError(error);
		});
}
