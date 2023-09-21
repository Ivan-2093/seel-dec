function validateEncuesta() {
	showLoading(cargando);
	const form_finalizacion = new FormData();
	form_finalizacion.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/loadTerminacionNegocio`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_finalizacion,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] == "success" && json["estado"] == 2) {
				sendEncuestaSatisfacion();
			} else {
				swal.fire({
					title: "Advertencia!",
					html: `<strong>La encuesta se debe enviar cuando el negocio halla finalizado como efectivo!</strong>`,
					icon: "warning",
				});
				hiddenLoading(cargando);
			}
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function sendEncuestaSatisfacion() {
	const form_finalizacion = new FormData();
	form_finalizacion.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/sendEncuestaSatisfacion`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_finalizacion,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			swal.fire({
				title: json["title"],
				html: json["html"],
				icon: json["icon"],
				willClose: () => {
					if (json["icon"] === "success") {
						load_flujo_trabajo();
					}
				},
			});
		})
		.then(function () {
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function loadEncuesta() {
	showLoading(cargando);
	const form_finalizacion = new FormData();
	form_finalizacion.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/loadEncuestaSatisfacion`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_finalizacion,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] == 'success') {
				const data = json['data'];
				
				$(`input[name="pregunta1"][id="option1"][value="${data[0].pregunta_1}"]`).prop('checked', true);
				$(`input[name="pregunta1"][id="option1"][value="${data[0].pregunta_1}"]`).click();

				$(`input[name="pregunta2"][id="option4"][value="${data[0].pregunta_2}"]`).prop('checked', true);				
				$(`input[name="pregunta2"][id="option4"][value="${data[0].pregunta_2}"]`).click();

				$(`input[name="pregunta3"][id="option5"][value="${data[0].pregunta_3}"]`).prop('checked', true);
				$(`input[name="pregunta3"][id="option5"][value="${data[0].pregunta_3}"]`).click();

				document.getElementById('opinion').value = data[0].opinion;
				document.getElementById('opinion').disabled = true;
			}

			return json;
		})
		.then(function (json) {
			swal.fire({
				title: json["title"],
				html: json["html"],
				icon: json["response"],
			});

			if(json["response"] == 'success'){
				$("#modal_data_encuesta").modal("show");
			}

		})
		.then(function () {
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
