/**********************************************SCRIPT ETAPA #2****************************/
const formCreateSolicitudCliente = document.getElementById(
	"formCreateSolicitudCliente"
);
const btnSubmitCreateSolicitud = document.getElementById(
	"btnSubmitCreateSolicitud"
);
const text_solicitud_cliente = document.getElementById(
	"text_solicitud_cliente"
);
const cant_caracteres = document.getElementById("cant_caracteres");
text_solicitud_cliente.addEventListener("keyup", () => {
	cant_caracteres.innerText =
		2000 - parseInt(text_solicitud_cliente.textLength);
});

btnSubmitCreateSolicitud.addEventListener("click", () => {
	if (parseInt(text_solicitud_cliente.textLength) >= 20) {
		saveSolicitud();
	} else {
		Swal.fire({
			title: "Advertencia",
			icon: "warning",
			html: "<strong>Debe agregar como minimo 20 caracteres en la solicitud!</strong>",
		});
	}
});

function saveSolicitud() {
	showLoading(cargando);
	const form_data = new FormData(formCreateSolicitudCliente);
	form_data.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/save_solicitud_cliente`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_data,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			Swal.fire({
				title: json["title"],
				html: json["html"],
				icon: json["response"],
			});
			return json;
		})
		.then(function (json) {
			if (json["response"] == "success") {
				load_flujo_trabajo();
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function load_data_solicitud_cliente() {
	showLoading(cargando);
	const form_data_soli = new FormData();
	form_data_soli.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/load_solicitud_cliente`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_data_soli,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] == "success") {
				text_solicitud_cliente.value = json["observacion"];
                btnSubmitCreateSolicitud.style.display = "none";
                text_solicitud_cliente.disabled = true;
                $("#Solicitud_Cliente").modal("show");
			}
			return json;
		})
		.then(function (json) {
			if (json["response"] == "error") {
				Swal.fire({
					title: json["title"],
					html: json["html"],
					icon: json["response"],
				});
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
