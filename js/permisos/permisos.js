const selectPerfil = document.getElementById('selectPerfil');
const content_permisos = document.getElementById('content_permisos');
document.addEventListener("DOMContentLoaded", () => {
	$(".js-select2-perfiles").select2({
		theme: "classic",
		placeholder: "Seleccione un perfil",
		allowClear: true,
		width: 'resolve',
	});
});

$(".js-select2-perfiles").on("change", function (e) {
	showLoading(cargando);
	
	fetch(`${base_url}PermisosController/get_permisos_perfil`, {
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
			content_permisos.innerHTML = json["html_permisos_perfil"];
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
});


