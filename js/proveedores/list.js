document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadTableProveedores();
});

const tableProveedores = document.getElementById("tableProveedores");
function loadTableProveedores() {
	showLoading(cargando);
	fetch(`${base_url}ProveedoresController/load_proveedores`, {
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
			$(`#${tableProveedores.id}`).dataTable().fnDestroy();
			tableProveedores.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableProveedores.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
