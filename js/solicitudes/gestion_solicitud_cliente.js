/* VARIABLES */
const tableGestionSolicitudes = document.getElementById(
	"tableGestionSolicitudes"
);

const date_start = document.getElementById("date_start");
const date_end = document.getElementById("date_end");
const inputNames = document.getElementById("inputNames");
const inputPhone = document.getElementById("inputPhone");
const inputEmail = document.getElementById("inputEmail");
const btnGenerarFiltro = document.getElementById("btnGenerarFiltro");
const formFiltroSolicitudes = document.getElementById("formFiltroSolicitudes");

document.addEventListener("DOMContentLoaded", () => {
	load_data();
});

function load_data() {
	showLoading(cargando);
	const formulario = new FormData(formFiltroSolicitudes);
	fetch(`${base_url}SolicitudController/load_data_solicitudes`, {
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
			$(`#${tableGestionSolicitudes.id}`).dataTable().fnDestroy();
			tableGestionSolicitudes.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableGestionSolicitudes.id);
			hiddenLoading(cargando);
			$('[data-toggle="tooltip"]').tooltip(); //
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function createCotizacion(id_solicitud) {
	showLoading(cargando);
	const formCotizacon = new FormData();
	formCotizacon.append('id_solicitud',id_solicitud);
	fetch(`${base_url}CotizacionController/`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: formCotizacon,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] === "error") {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: "La solicitud del cliente no se encontro!",
					confirmButtonText: "Ok",
				});
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

btnGenerarFiltro.addEventListener("click", () => {
	load_data();
});
