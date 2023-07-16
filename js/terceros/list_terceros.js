const tableTerceros = document.getElementById("tableTerceros");

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	loadTerceros();
});

function loadTerceros() {
	showLoading(cargando);
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
			tableTerceros.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(tableTerceros.id);
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			Swal.fire({
				title: "ERROR",
				html: `Ha ocurrido un error:( <strong>${error}</strong> ), contacte con el departamento de sistemas o intentenuavamente.`,
				icon: "error",
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
				willClose: () => {
					location.reload();
				},
			});
			hiddenLoading(cargando);
		});
}

function editTercero(data) {
	let arr = JSON.parse(data.getAttribute('data'));
	console.log(arr);
	console.log(typeof arr);
}
