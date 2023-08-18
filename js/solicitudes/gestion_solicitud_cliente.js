/* VARIABLES */
const tableGestionSolicitudes = document.getElementById("tableGestionSolicitudes");

document.addEventListener("DOMContentLoaded", () => {
	load_data();
});

function load_data() {
	showLoading(cargando);

	fetch(`${base_url}SolicitudController/load_data_solicitudes`, {
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
			tableGestionSolicitudes.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableGestionSolicitudes.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			console.error(error);
			hiddenLoading(cargando);
		});
}
