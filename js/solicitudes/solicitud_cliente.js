/* VARIABLES */
const inputNombres = document.getElementById("inputNombres");
const inputEmail = document.getElementById("inputEmail");
const inputPhone = document.getElementById("inputPhone");
const inputAddress = document.getElementById("inputAddress");
const inputSolicitud = document.getElementById("inputSolicitud");
const btnSubmitCreateSolicitud = document.getElementById(
	"btnSubmitCreateSolicitud"
);
const formCreateSolicitudCliente = document.getElementById(
	"formCreateSolicitudCliente"
);
const comboDepto = document.getElementById("comboDepto");
const comboMunicipio = document.getElementById("comboMunicipio");

/* ARRAY DE INPUTS FORMULARIO */
const arrayInputsSolicitud = [
	inputNombres,
	inputPhone,
	inputEmail,
	comboDepto,
	comboMunicipio,
	inputSolicitud,
];

document.addEventListener("DOMContentLoaded", () => {
	loadDeptos();
});

function loadDeptos() {
	showLoading(cargando);
	const data_pais = new FormData();
	data_pais.append("id_pais", 1);
	fetch(`${base_url}TercerosController/deptosByIdPais`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_pais,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			comboDepto.innerHTML = json["data_deptos"];
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			hiddenLoading(cargando);
			location.reload();
		});
}

inputPhone.addEventListener("keypress", () => {
	isOnlyNumber();
});
inputNombres.addEventListener("keypress", () => {
	isOnlyText();
});
inputSolicitud.addEventListener("keypress", () => {
	isAlphanumeric();
});
inputAddress.addEventListener("keypress", () => {
	isAddress();
});

inputEmail.addEventListener("blur", function () {
	validarEmail(inputEmail);
});

comboDepto.addEventListener("change", () => {
	if (comboDepto.value !== "") {
		const data_dpto = new FormData();
		data_dpto.append("id_depto", comboDepto.value);
		fetch(`${base_url}TercerosController/municipiosByIdDepto`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: data_dpto,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				comboMunicipio.innerHTML = json["data_municipios"];
			})
			.catch(function (error) {
				reportError(error);
			});
	}
});

btnSubmitCreateSolicitud.addEventListener("click", () => {
	const inputsVoid = arrayInputsSolicitud.filter(function (input) {
		return input.value == "";
	});
	if (inputsVoid.length == 0) {
		const data_formSolicitud = new FormData(formCreateSolicitudCliente);
		createSolicitud(data_formSolicitud);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.previousElementSibling.innerText;
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Para cargar la información del mantenimiento, debe completar todos los campos del formulario: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoids(inputsVoid);
			},
		});
	}
});

function createSolicitud(data_formSolicitud) {
	fetch(`${base_url}SolicitudController/createSolicitud`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_formSolicitud,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			switch (true) {
				case json["response"] === "success":
					Swal.fire({
						title: json["title"],
						html: `${json["sms"]} <br>Se cerrará en <strong></strong> segundos.<br/><br/>`,
						icon: json["response"],
						confirmButtonText: "Ok",
						allowOutsideClick: false,
						showCloseButton: true,
						timer: 3000,
						didOpen: () => {
							timerInterval = setInterval(() => {
								Swal.getHtmlContainer().querySelector("strong").textContent = (
									Swal.getTimerLeft() / 1000
								).toFixed(0);
							}, 100);
						},
						willClose: () => {
							clearInterval(timerInterval);
                            location.reload();
						},
					});
					hiddenLoading(cargando);
					break;

				default:
					Swal.fire({
						title: json["title"],
						html: `${json["sms"]}`,
						icon: json["response"],
						confirmButtonText: "Ok",
						allowOutsideClick: false,
						showCloseButton: true,
						showCancelButton: true,
						CancelButtonText: "REFRESCAR",
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */
						if (result.isCancelled) {
							location.reload();
						}
					});
					hiddenLoading(cargando);
					break;
			}
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
