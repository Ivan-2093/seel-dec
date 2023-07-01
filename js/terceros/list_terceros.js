const tableTerceros = document.getElementById('tableTerceros');

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	sidebar.classList.add("collapsed"); //Ocultar el nav para cuando terminde de cargar
	loadTerceros();
});

function loadTerceros() {
	fetch(`${base_url}TercerosController/loadTerceros`, {
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
			tableTerceros.tBodies[0].innerHTML = json['tbody'];
            loadDatatable(tableTerceros.id);
		})
		.catch(function (error) {});
}


