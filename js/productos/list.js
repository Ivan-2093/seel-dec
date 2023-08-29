document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadTableClientes();
});

const tableClientes = document.getElementById("tableClientes");
function loadTableClientes() {
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
			$(`#${tableClientes.id}`).dataTable().fnDestroy();
			tableClientes.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableClientes.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
