const selectPerfil = document.getElementById("selectPerfil");
const content_permisos = document.getElementById("content_permisos");
document.addEventListener("DOMContentLoaded", () => {
	$(".js-select2-perfiles").select2({
		theme: "classic",
		placeholder: "Seleccione un perfil",
		allowClear: true,
		width: "resolve",
	});
});

$(".js-select2-perfiles").on("change", function (e) {
	if (selectPerfil.value != "") {
		showLoading(cargando);
		const form_perfil = new FormData();
		form_perfil.append("perfil_id", selectPerfil.value);
		fetch(`${base_url}PermisosController/get_permisos_perfil`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: form_perfil,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				content_permisos.innerHTML = json["html_permisos_perfil"];
				$('.toggle-one').bootstrapToggle({
                    on: "<i class='fas fa-check-circle'></i>",
                    off: "<i class='fas fa-ban'></i>"
                });
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
});

function check_menu(menu,menu_id,perfil_id,input){
	showLoading(cargando);
	const options = (input.checked === true ? 1 : 0); 
	const formulario_permisos = new FormData();
	formulario_permisos.append('menu_id',menu_id);
	formulario_permisos.append('perfil_id',perfil_id);
	formulario_permisos.append('options',options);
	fetch(`${base_url}PermisosController/update_permisos_perfil`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: formulario_permisos,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			switch (true) {
				case json['response'] === 'success':
					Swal.fire({
						title: "EXITO",
						html: `${json['mensaje']} Se cerrará en <strong></strong> segundos.<br/><br/>`,
						icon: json['response'],
						confirmButtonText: "Ok",
						allowOutsideClick: false,
						showCloseButton: true,
						timer: 5000,
						didOpen: () => {
						timerInterval = setInterval(() => {
							Swal.getHtmlContainer().querySelector('strong')
							  .textContent = (Swal.getTimerLeft() / 1000)
								.toFixed(0)
						  }, 100)
						},
						willClose: () => {
						  clearInterval(timerInterval)
						}
					});
					hiddenLoading(cargando);
					break;
			
				default:
					break;
			}
			
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
					/* location.reload(); */
				},
			});
			hiddenLoading(cargando);
		});
}
