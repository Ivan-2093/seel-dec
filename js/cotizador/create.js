/* FORMULARIO */

/* VARIABLES */
const bntLoadProducts = document.getElementById("bntLoadProducts");
const tableProductosC1 = document.getElementById("tableProductosC1");
const tableProductosC2 = document.getElementById("tableProductosC2");
const tableProductosC3 = document.getElementById("tableProductosC3");

const btnActivePersianaT = document.getElementById("btnActivePersianaT");
const btnActivePuertaT = document.getElementById("btnActivePuertaT");
const btnActiveCerraduraT = document.getElementById("btnActiveCerraduraT");

const tablaPersianas = document.getElementById("tablaPersianas");
const tablaPuertas = document.getElementById("tablaPuertas");
const tablaCerraduras = document.getElementById("tablaCerraduras");
const totalCotizacion = document.getElementById("totalCotizacion");
const tabla_cotizacion = document.getElementById("tabla_cotizacion");

const formCreateCotizacion = document.getElementById("formCreateCotizacion");
/* ARRAY DE INPUTS */
const arrayInputs = [];

document.addEventListener("DOMContentLoaded", () => {
	load_data_products();
});

bntLoadProducts.addEventListener("click", () => {
	$("#modal_productos").modal("show");
});

function load_data_products() {
	showLoading(cargando);
	fetch(`${base_url}CotizacionController/load_productos`, {
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
			$(`#${tableProductosC1.id}`).dataTable().fnDestroy();
			tableProductosC1.tBodies[0].innerHTML = json["tbodyC1"];
			$(`#${tableProductosC2.id}`).dataTable().fnDestroy();
			tableProductosC2.tBodies[0].innerHTML = json["tbodyC2"];
			$(`#${tableProductosC3.id}`).dataTable().fnDestroy();
			tableProductosC3.tBodies[0].innerHTML = json["tbodyC3"];
			return json;
		})
		.then(function (json) {
			loadDatatable(tableProductosC1.id);
			loadDatatable(tableProductosC2.id);
			loadDatatable(tableProductosC3.id);
			$('[data-toggle="tooltip"]').tooltip();
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

btnActivePersianaT.addEventListener("click", () => {
	tablaPersianas.hidden = false;
	tablaPuertas.hidden = true;
	tablaCerraduras.hidden = true;
});
btnActivePuertaT.addEventListener("click", () => {
	tablaPuertas.hidden = false;
	tablaPersianas.hidden = true;
	tablaCerraduras.hidden = true;
});
btnActiveCerraduraT.addEventListener("click", () => {
	tablaCerraduras.hidden = false;
	tablaPuertas.hidden = true;
	tablaPersianas.hidden = true;
});

function add_producto(data) {
	const data_producto = JSON.parse(data.getAttribute("data"));

	let precio_elite = currencyFormatter({
		currency: "COP",
		value: parseInt(data_producto[2]),
	});

	let precio_premium = currencyFormatter({
		currency: "COP",
		value: parseInt(data_producto[3]),
	});

	let elementHtml = null;

	switch (true) {
		case parseInt(data_producto[2]) > 0 && parseInt(data_producto[3]) > 0:
			Swal.fire({
				title: `<strong>${data_producto[1]}</strong>`,
				icon: "info",
				html: `Seleccione el tipo de valor:`,
				showCloseButton: true,
				showDenyButton: true,
				showCancelButton: true,
				focusConfirm: false,
				confirmButtonText: `Elite: ${precio_elite}`,
				denyButtonText: `Premium: ${precio_premium}`,
				cancelButtonText: `Cancelar!`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					elementHtml = `<tr id="${data_producto[0]}" class="filaCoti"><td class="d-none">${data_producto[0]}</td><td><input onchange="check_precio(this)" style="width: fit-content" type="number" class="form-control" value="1" min="1"/></td><td>${data_producto[1]}</td><td class="text-right">${precio_elite}</td><td class="text-right valorTotalTdProducts">${precio_elite}</td><td class="text-center"><button class="btn btn-danger ik ik-trash" onclick="eliminar_producto(this,\'${data_producto[1]}\')"></button></td></tr>`;
					tabla_cotizacion.tBodies[0].insertAdjacentHTML(
						"beforeend",
						elementHtml
					);
					Swal.fire("Producto agregado!", "", "success");
					sumValoresTotales();
				} else if (result.isDenied) {
					elementHtml = `<tr id="${data_producto[0]}" class="filaCoti"><td class="d-none">${data_producto[0]}</td><td><input onchange="check_precio(this)" style="width: fit-content" type="number" class="form-control" value="1" min="1"/></td><td>${data_producto[1]}</td><td class="text-right">${precio_premium}</td><td class="text-right valorTotalTdProducts">${precio_premium}</td><td class="text-center"><button class="btn btn-danger ik ik-trash" onclick="eliminar_producto(this,\'${data_producto[1]}\')"></button></td></tr>`;
					tabla_cotizacion.tBodies[0].insertAdjacentHTML(
						"beforeend",
						elementHtml
					);
					Swal.fire("Producto agregado!", "", "success");
					sumValoresTotales();
				} else {
				}
			});
			break;
		case parseInt(data_producto[2]) > 0 && parseInt(data_producto[3]) == 0:
			elementHtml = `<tr id="${data_producto[0]}" class="filaCoti"><td class="d-none">${data_producto[0]}</td><td><input onchange="check_precio(this)" style="width: fit-content" type="number" class="form-control" value="1" min="1"/></td><td>${data_producto[1]}</td><td class="text-right">${precio_elite}</td><td class="text-right valorTotalTdProducts">${precio_elite}</td><td class="text-center"><button class="btn btn-danger ik ik-trash" onclick="eliminar_producto(this,\'${data_producto[1]}\')"></button></td></tr>`;
			tabla_cotizacion.tBodies[0].insertAdjacentHTML("beforeend", elementHtml);
			Swal.fire("Producto agregado!", "", "success");
			sumValoresTotales();
			break;
		default:
			elementHtml = `<tr id="${data_producto[0]}" class="filaCoti"><td class="d-none">${data_producto[0]}</td><td><input onchange="check_precio(this)" style="width: fit-content" type="number" class="form-control" value="1" min="1"/></td><td>${data_producto[1]}</td><td class="text-right">${precio_premium}</td><td class="text-right valorTotalTdProducts">${precio_premium}</td><td class="text-center"><button class="btn btn-danger ik ik-trash" onclick="eliminar_producto(this,\'${data_producto[1]}\')"></button></td></tr>`;
			tabla_cotizacion.tBodies[0].insertAdjacentHTML("beforeend", elementHtml);
			Swal.fire("Producto agregado!", "", "success");
			sumValoresTotales();
			break;
	}
}

function sumValoresTotales() {
	let sumaValoresTotales = 0;

	const array_totales = $(".valorTotalTdProducts").map(function () {
		var montoFormat = this.innerText.replace(/[$.]/g, "");
		sumaValoresTotales = sumaValoresTotales + parseInt(montoFormat);
		return montoFormat;
	});

	let sumaValoresTotales_ = currencyFormatter({
		currency: "COP",
		value: parseInt(sumaValoresTotales),
	});

	totalCotizacion.innerHTML = sumaValoresTotales_;
}

function eliminar_producto(fila, producto) {
	Swal.fire({
		title: `¿Está suguro de eliminar el producto: ${producto} de la cotización?`,
		icon: "info",
		showCloseButton: true,
		showCancelButton: true,
		focusConfirm: false,
		confirmButtonText: `<i class="fa fa-thumbs-up"></i> SI!`,
		cancelButtonText: `'<i class="fa fa-thumbs-down"></i> NO!`,
	}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			fila.parentNode.parentNode.remove();
			sumValoresTotales();
		}
	});
}

function getDataTablaCotizacion() {
	if (tabla_cotizacion.tBodies[0].childElementCount > 0) {
		const datos = new FormData(formCreateCotizacion);
		const idTrR = Object.values(tabla_cotizacion.tBodies[0].childNodes).map(
			function (nodes) {
				if (nodes.tagName == "TR") {
					return nodes.id;
				}
			}
		);
		datos.append("cantidadFilas", idTrR.length);
		const datosProductos = [];
		for (let index = 0; index < idTrR.length; index++) {
			datosProductos.push(
				$(`#${idTrR[index]} td`)
					.map(function () {
						if (this.childElementCount > 0) {
							return this.children[0].value;
						} else {
							return parseInt(this.innerText.replace(/[$.]/g, ""));
						}
					})
					.get()
			);
			datos.append("fila" + index, datosProductos[index]);
		}

		insertCotizacion(datos);
	} else {
		Swal.fire({
			title: "Cotización vacia!",
			icon: "warning",
			html: "Agregue productos a la cotización!",
		});
	}
}

function insertCotizacion(datos) {
	showLoading(cargando);
	fetch(base_url + "CotizacionController/saveInfoCotizacion", {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: datos,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			Swal.fire({
				title: json["title"],
				icon: json["response"],
				html: json["html"],
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					if(json["response"] === 'success'){
						location.href =  base_url + 'SolicitudController/gestionSolicitud';
					}else if (json["response"] === 'error'){
						location.reload()
					}else {

					}
				}
			});
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function check_precio(data) {
	data.value = data.value > 1 ? parseInt(data.value) : 1;
	const cant_product = parseInt(data.value);
	const v_product = parseInt(
		data.parentNode.parentNode.childNodes[3].innerText.replace(/[$.]/g, "")
	);

	let v_product_cant = cant_product * v_product;

	let v_total_product = currencyFormatter({
		currency: "COP",
		value: parseInt(v_product_cant),
	});

	data.parentNode.parentNode.childNodes[4].innerText = v_total_product;
	sumValoresTotales();
}
