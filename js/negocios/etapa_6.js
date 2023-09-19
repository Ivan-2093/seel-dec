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
				
			} else {
				swal.fire({
					title: "Advertencia!",
					html: `<strong>La encuesta se debe enviar cuando el negocio halla finalizado como efectivo!</strong>`,
					icon: "warning",
				});
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
