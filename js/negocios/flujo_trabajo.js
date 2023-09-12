/* VARIABLES */
const flujo_trabajo = document.getElementById('flujo_trabajo');

document.addEventListener("DOMContentLoaded", () => {
	load_flujo_trabajo();
});

function load_flujo_trabajo() {
	showLoading(cargando);
	fetch(`${base_url}NegociosController/load_flujo_trabajo`, {
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
			
			flujo_trabajo.innerHTML += json["html_flujo"];
			$('[data-toggle="tooltip"]').tooltip(); //
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
