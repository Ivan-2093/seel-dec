/* VARIABLES */
const flujo_trabajo = document.getElementById("flujo_trabajo");
const id_negocio = document.getElementById("id_negocio");
document.addEventListener("DOMContentLoaded", () => {
	load_flujo_trabajo();
});

function load_flujo_trabajo() {
	showLoading(cargando);
	const form_flujo_trabajo = new FormData();
	form_flujo_trabajo.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/load_flujo_trabajo`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_flujo_trabajo,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			flujo_trabajo.innerHTML = json["html_flujo"];
			$('[data-toggle="tooltip"]').tooltip(); //
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function obtenerData(etapa_id, opc) {
	switch (etapa_id) {
		case 1:
			if (opc == 0) {
				$("#Información_Cliente").modal("show");
			} else {
				const id_tercero_n = document.getElementById("id_tercero_n");
				load_data_tercero(id_tercero_n.value);
				btnSubmitCreateTercero.hidden = true;
				btnSubmitReset.hidden = true;
				$("#Información_Cliente").modal("show");
			}
			break;
		case 2:
			if (opc == 0) {
				$("#Solicitud_Cliente").modal("show");
			} else {
				load_data_solicitud_cliente();
			}
			break;
		case 3:
			load_data_cotizacion();
			break;
		case 4:
			if (opc == 0) {
				validate_etapa(id_negocio.value, 1);
			} else {
				load_data_cita_agendada();
			}
			break;
		case 5:
			if (opc == 0) {
				$("#modal_terminar_negocio").modal("show");
			} else {
				load_data_terminacion_negocio();
			}
			break;

		case 6:
			if (opc == 0) {
				validateEncuesta();
			} else {
				loadEncuesta();
			}
			break;
	}
}

function verCotizacionPdf(id) {
	var mapFormD = document.createElement("form");
	mapFormD.target = "COTIZACIÓN";
	mapFormD.method = "POST";
	mapFormD.action = `${base_url}CotizacionController/verCotizacionPdf`;

	var varHn = document.createElement("input");
	varHn.type = "hidden";
	varHn.name = "id_cotizacion";
	varHn.value = id;
	mapFormD.appendChild(varHn);
	/* Cargamos el formulario en el body */
	document.body.appendChild(mapFormD);

	mapD = window.open(
		"",
		"COTIZACIÓN",
		"status=200,title=COTIZADOR,height=auto,width=100,scrollbars=1"
	);

	if (mapD) {
		mapFormD.submit();
	}
}

