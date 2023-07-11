const tableTerceros = document.getElementById('tableTerceros');

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	sidebar.classList.add("collapsed"); //Ocultar el nav para cuando terminde de cargar
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
			tableTerceros.tBodies[0].innerHTML = json['tbody'];
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


