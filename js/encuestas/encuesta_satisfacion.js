const wrapper = document.getElementsByClassName("wrapper");
const sidebar_header = document.getElementsByClassName("sidebar-header");

document.addEventListener("DOMContentLoaded", () => {
	wrapper[0].classList.add("nav-collapsed", "menu-collapsed");
	sidebar_header[0].children[1].children[0].setAttribute('data-toggle','collapsed');
	sidebar_header[0].children[1].children[0].classList.remove('ik-toggle-right');
	sidebar_header[0].children[1].children[0].classList.add('ik-toggle-left');
});

const btn_env_encuesta = document.getElementById("btn_env_encuesta");
const form_encuesta = document.getElementById("form_encuesta");
btn_env_encuesta.addEventListener("click", function () {
	if (form_encuesta.checkValidity()) {
		saveEncuesta();
	} else {
		btn_env_encuesta.type = "submit";
		btn_env_encuesta.click();
		setTimeout(function () {
			btn_env_encuesta.type = "button";
		}, 200);
	}
});

function saveEncuesta() {
	showLoading(cargando);

	const datos = new FormData(form_encuesta);
	fetch(`${base_url}EncuestasController/saveEncuesta`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: datos,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {

			Swal.fire({
				icon: json['response'],
				title: json['title'],
				html: json['Html'],
				confirmButtonText: '<i class="fa fa-thumbs-up"> OK</i>',
				willClose: () => {
					location.href = `https://www.instagram.com/persianas_y_puertade_seguridad/`;
				},
			});
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
