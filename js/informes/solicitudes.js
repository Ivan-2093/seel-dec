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
const btnResetFiltro = document.getElementById("btnResetFiltro");
const formFiltroSolicitudes = document.getElementById("formFiltroSolicitudes");

document.addEventListener("DOMContentLoaded", () => {
	load_data();
});

function load_data() {
	showLoading(cargando);
	const formulario = new FormData(formFiltroSolicitudes);
	fetch(`${base_url}InformesController/load_informe_solicitudes`, {
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
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}


btnGenerarFiltro.addEventListener("click", () => {
	load_data();
});
btnResetFiltro.addEventListener("click", () => {
	formFiltroSolicitudes.reset();
});