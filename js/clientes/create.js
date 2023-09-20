const formCliente = document.getElementById("formCreateCliente");
const inputIdTercero = document.getElementById("inputIdTercero");
const btnGenerarFiltro = document.getElementById("btnGenerarFiltro");
const tableTerceros = document.getElementById("tableTerceros");
/* ARRAY DE INPUTS */
document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadClienteByFiltro();
});

function createCliente(id_tercero) {
	showLoading(cargando);
	const data_form_cliente = new FormData();
	data_form_cliente.append('inputIdTercero', id_tercero);
	fetch(`${base_url}ClientesController/createCliente`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_form_cliente,
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
			loadClienteByFiltro();
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

btnGenerarFiltro.addEventListener('click', () => {
	loadClienteByFiltro();
});


function loadClienteByFiltro() {
	showLoading(cargando);
	const formulario = new FormData(formFiltroSolicitudes);
	fetch(`${base_url}ClientesController/loadTerceros`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: formulario,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			$(`#${tableTerceros.id}`).dataTable().fnDestroy();
			tableTerceros.tBodies[0].innerHTML = json["tbody"];
			$('[data-toggle="tooltip"]').tooltip(); //
			loadDatatable(tableTerceros.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
