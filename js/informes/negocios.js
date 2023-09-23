/* VARIABLES */
const table_negocios = document.getElementById("table_negocios");
const formFiltroNegocios = document.getElementById("formFiltroNegocios");
const btnGenerarFiltro = document.getElementById("btnGenerarFiltro");
const btnResetFiltro = document.getElementById("btnResetFiltro");

document.addEventListener("DOMContentLoaded", () => {
	load_informe_negocio();
});

btnGenerarFiltro.addEventListener("click", () => {
	load_informe_negocio();
});

btnResetFiltro.addEventListener("click", () => {
	formFiltroNegocios.reset();
});

function load_informe_negocio() {
	showLoading(cargando);
	const form_filtro_informe = new FormData(formFiltroNegocios);
	fetch(`${base_url}InformesController/load_informe_negocios`, {
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
			$(`#${table_negocios.id}`).dataTable().fnDestroy();
			table_negocios.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(table_negocios.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
