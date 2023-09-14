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
			flujo_trabajo.innerHTML += json["html_flujo"];
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
			}
			break;
		case 2:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
		case 3:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
		case 4:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
		case 5:
			alert(etapa_id + "\n" + id_negocio.value);
			break;

		case 6:
			alert(etapa_id + "\n" + id_negocio.value);
			break;
	}
}
/* *****************************************SCRIPT PARA ETAPA 1 : INF CLIENTE*********************************************** */
const inputIdTercero = document.getElementById('inputIdTercero');
inputNumeroDoc.addEventListener("change", () => {
	if (inputNumeroDoc.value != "") {
		showLoading(cargando);
		const form_tercero_by_nit = new FormData();
		form_tercero_by_nit.append("nit", inputNumeroDoc.value);
		fetch(`${base_url}TercerosController/searchTercero`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: form_tercero_by_nit,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				const data_tercero = json['data'];
				$("#inputTipoDoc").val(data_tercero[0]);
				comboPais.focus();
				$("#comboPais").val(data_tercero[11]);
				var event = new Event("change");
				comboPais.dispatchEvent(event);

				$("#comboDeptoBan").val(data_tercero[12]);
				$("#comboMunicipioBan").val(data_tercero[13]);

				inputNumeroDoc.value = data_tercero[2];
				inputFirstName.value = data_tercero[3];
				inputSecondName.value = data_tercero[4];
				inputFirstSurName.value = data_tercero[5];
				inputSecondSurName.value = data_tercero[6];
				inputEmail.value = data_tercero[7];
				inputTelefono_1.value = data_tercero[8];
				inputTelefono_2.value = data_tercero[9];
				inputIdGenero.value = data_tercero[10];
				inputDireccion.value = data_tercero[14];
				inputBarrio.value = data_tercero[15];
				inputIdTercero.value = data_tercero[16];
				hiddenLoading(cargando);
			})
			.catch(function (error) {
				reportError(error);
				hiddenLoading(cargando);
			});
	}
});
