/* FORMULARIO */

/* VARIABLES */
const bntLoadProducts = document.getElementById('bntLoadProducts');
const tableProductos = document.getElementById('tableProductos');
/* ARRAY DE INPUTS */
const arrayInputs = [

];

document.addEventListener('DOMContentLoaded', () => {
	load_data_products();
});


bntLoadProducts.addEventListener('click', () => {
	$('#modal_productos').modal('show');
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
			$(`#${tableProductos.id}`).dataTable().fnDestroy();
			tableProductos.tBodies[0].innerHTML = json["tbody"];
			return json;
		})
		.then(function (json) {
			loadDatatable(tableProductos.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}




