/* SCRIPT PARA LA ETAPA 3 COTIZACIONES */
function load_data_cotizacion()
{
    showLoading(cargando);
	const form_data_cotizacion = new FormData();
	form_data_cotizacion.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/load_cotizacion_cliente`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: form_data_cotizacion,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] == "success") {
                $('#htmlCotizaciones').html(json["body"]);
				$("#cotizaciones_negocio").modal("show");
				btnSubmitCreateCotizacion.hidden = true;
            }
			return json;
		})
		.then(function (json) {
			if (json["response"] == "warning") {
				$("#cotizaciones_negocio").modal("show");
				btnSubmitCreateCotizacion.hidden = false;

				Swal.fire({
					title: json["title"],
					html: json["html"],
					icon: 'warning',
				});
			}
			return json;
		})
		.then(function (json) {
			if (json["response"] == "error") {
				Swal.fire({
					title: json["title"],
					html: json["html"],
					icon: 'error',
				});
			}
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});

}

const btnSubmitCreateCotizacion = document.getElementById('btnSubmitCreateCotizacion');

btnSubmitCreateCotizacion.addEventListener('click', () =>{
    crearCotizacion(id_negocio.value);
});

function crearCotizacion(id_negocio) {
    var mapFormD = document.createElement("form");
    mapFormD.target = "COTIZADOR";
    mapFormD.method = "POST";
    mapFormD.action = `${base_url}CotizacionController/`;

    var varHn = document.createElement("input");
    varHn.type = "hidden";
    varHn.name = "id_negocio";
    varHn.value = id_negocio;
    mapFormD.appendChild(varHn);
    /* Cargamos el formulario en el body */
    document.body.appendChild(mapFormD);

    mapD = window.open("", "COTIZADOR", "status=200,title=COTIZADOR,height=auto,width=700,scrollbars=1");

    if (mapD) {
        mapFormD.submit();
    }

}