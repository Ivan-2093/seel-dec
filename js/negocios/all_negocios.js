/* VARIABLES */
const table_negocios = document.getElementById("table_negocios");
const formFiltroNegocios = document.getElementById("formFiltroNegocios");
const btnGenerarFiltro = document.getElementById("btnGenerarFiltro");
const btnResetFiltro = document.getElementById("btnResetFiltro");

document.addEventListener("DOMContentLoaded", () => {
	load_negocios_all();
});

btnGenerarFiltro.addEventListener("click", () => {
	load_negocios_all();
});

btnResetFiltro.addEventListener("click", () => {
    formFiltroNegocios.reset();
});

function load_negocios_all() {
	showLoading(cargando);
	const form_data = new FormData(formFiltroNegocios);
	fetch(`${base_url}NegociosController/load_negocios_all`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_data,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			table_negocios.tBodies[0].innerHTML = json["tbody"];
			$('[data-toggle="tooltip"]').tooltip(); //
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
