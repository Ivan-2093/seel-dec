document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadTableProductos();
});

/* VARIABLES */
const tableProductos = document.getElementById("tableProductos");
const modal_editar_producto = document.getElementById("modal_editar_producto");

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

const btnSubmitEditarProducto = document.getElementById(
	"btnSubmitEditarProducto"
);
const inputReferenciaProducto = document.getElementById(
	"inputReferenciaProducto"
);
const inputDescripcionProducto = document.getElementById(
	"inputDescripcionProducto"
);
const isDeco = document.getElementById("isDeco");
const isSegurity = document.getElementById("isSegurity");
const id_producto_edit = document.getElementById("id_producto_edit");
const formEditProducto = document.getElementById("formEditProducto");

/* ARRAY DE INPUTS */
const arrayInputsProduct = [
	inputIdProveedor,
	inputIdCategoria,
	inputIdTipoProducto,
	inputCostoPremium,
	inputPerPrecio,
];

function loadTableProductos() {
	showLoading(cargando);
	fetch(`${base_url}ProductosController/load_productos`, {
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
			$(`#${tableProductos.id}`).dataTable().fnDestroy();
			tableProductos.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableProductos.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function editar_producto(id_producto) {
	showLoading(cargando);

	const form_producto = new FormData();
	form_producto.append("id_producto", id_producto);

	fetch(`${base_url}ProductosController/load_producto_by_id`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_producto,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["data"] != "") {
				const data_prodcuto = json["data"];
				id_producto_edit.value = data_prodcuto[0]["id_producto"];
				inputIdProveedor.value = data_prodcuto[0]["id_proveedor"];
				inputIdCategoria.value = data_prodcuto[0]["id_categoria"];
				inputCostoElite.value = data_prodcuto[0]["costo_elite"];
				inputCostoPremium.value = data_prodcuto[0]["costo_premium"];
				inputPerPrecio.value = data_prodcuto[0]["porce_precio"];
				inputAnchoTela.value = data_prodcuto[0]["anchos_tela_metro"];
				inputUndMedida.value = data_prodcuto[0]["unidad_medida"];
				inputFactorApertura.value = data_prodcuto[0]["factor_apertura"];
				inputPasadores.value = data_prodcuto[0]["pasadores"];
				inputCerradura.value = data_prodcuto[0]["cerradura"];
				inputLlaves.value = data_prodcuto[0]["llaves"];
				inputTipoSegurity.value = data_prodcuto[0]["tipo_seguridad"];
				inputReferenciaProducto.value = data_prodcuto[0]["referencia"];
				inputDescripcionProducto.value = data_prodcuto[0]["descripcion"];

				load_tipo_producto_by_categoria(
					inputIdCategoria.value,
					data_prodcuto[0]["id_tipo"]
				);

				if (inputIdCategoria.value == 1) {
					isDeco.hidden = false;
					isSegurity.hidden = true;
				} else {
					isSegurity.hidden = false;
					isDeco.hidden = true;
				}

				return json;
			} else {
				return json;
			}
		})
		.then(function (json) {
			Swal.fire({
				title: json["title"],
				icon: json["response"],
				html: json["msm"],
			});

			if (json["response"] == "success") {
				$("#modal_editar_producto").modal({});
			}

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function load_tipo_producto_by_categoria(id_categoria, id_tipo_producto) {
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
		})
		.then(function () {
			inputIdTipoProducto.value = id_tipo_producto;
			$(".js-select2-tipo-producto").select2({
				placeholder: "Seleccione un tipo",
				width: "resolve",
			});
		})
		.catch(function (error) {
			reportError(error);
		});
}

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

btnSubmitEditarProducto.addEventListener("click", function () {
	const inputsVoid = arrayInputsProduct.filter(function (input) {
			return input.value == "";
	});
	if (inputsVoid.length == 0) {
		const data_form_producto = new FormData(formEditProducto);
		editarProducto(data_form_producto);
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

inputCostoElite.addEventListener("keyup", () => {
	aplicarNuberFormat(inputCostoElite);
});

inputCostoPremium.addEventListener("keyup", () => {
	aplicarNuberFormat(inputCostoPremium);
});
inputPerPrecio.addEventListener("keypress", () => {
	isOnlyNumber();
});

function editarProducto(data_form_producto) {
	showLoading(cargando);
	fetch(`${base_url}ProductosController/editProducto`, {
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
