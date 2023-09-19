const wrapper = document.getElementsByClassName("wrapper");
const sidebar_header = document.getElementsByClassName("sidebar-header");

document.addEventListener("DOMContentLoaded", () => {
	wrapper[0].classList.add("nav-collapsed", "menu-collapsed");
	sidebar_header[0].children[1].children[0].setAttribute('data-toggle','collapsed');
	sidebar_header[0].children[1].children[0].classList.remove('ik-toggle-right');
	sidebar_header[0].children[1].children[0].classList.add('ik-toggle-left');
});

{/* <i data-toggle="collapsed" class="ik toggle-icon ik-toggle-left"></i> */}

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
			if (json["response"] === "success") {
				Swal.fire({
					icon: "success",
					title: "Exito",
					html: `Gracias por contestar la encuesta, ya puedes retirar el vehículo`,
					confirmButtonText: '<i class="fa fa-thumbs-up"> OK</i>',
					willClose: () => {
						location.href = `${base_url}`;
					},
				});
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			swal.fire({
				icon: "error",
				title: "Error",
				html: `Ha ocurrido un error en la api de la intranet de postventa, intente nuevamente.`,
				confirmButtonText: "OK",
			});
			hiddenLoading(cargando);
		});
}
