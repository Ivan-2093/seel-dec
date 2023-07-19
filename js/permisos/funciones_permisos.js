const TablaPermisos = document.getElementById("tabla_permisos");

function loadTableEmpleados() {
	showLoading(cargando);
	fetch(`${base_url}PermisosController/loadTablePerfiles`, {
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
			TablaPermisos.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(TablaPermisos.id);
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

document.addEventListener("DOMContentLoaded", function () {
	loadTableEmpleados();
});

function verpermisos(idperfil) {
	showLoading(cargando);
	const formulario = new FormData();
	formulario.append("idperfil", idperfil);
	fetch(`${base_url}PermisosController/loadTableMenu`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: formulario,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			TablaPermisos.tBodies[0].innerHTML = json["tbody"];
			loadDatatable(TablaPermisos.id);
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
