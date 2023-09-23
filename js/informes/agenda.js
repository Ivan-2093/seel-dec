/* VARIABLES */
const table_agenda = document.getElementById("table_agenda");
const formFiltroInformes = document.getElementById("formFiltroInformes");
const btnGenerarFiltro = document.getElementById("btnGenerarFiltro");
const btnResetFiltro = document.getElementById("btnResetFiltro");

document.addEventListener("DOMContentLoaded", () => {
	load_informe_agenda();
});

btnGenerarFiltro.addEventListener("click", () => {
	load_informe_agenda();
});

btnResetFiltro.addEventListener("click", () => {
	formFiltroInformes.reset();
});

function load_informe_agenda() {
	showLoading(cargando);
	const form_filtro_informe = new FormData(formFiltroInformes);
	fetch(`${base_url}InformesController/load_informe_agenda`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_filtro_informe,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			$(`#${table_agenda.id}`).dataTable().fnDestroy();
			table_agenda.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(table_agenda.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
