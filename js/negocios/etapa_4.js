function load_data_cita_agendada() {
	showLoading(cargando);
	const form_flujo_trabajo = new FormData();
	form_flujo_trabajo.append("id_negocio", id_negocio.value);
	fetch(`${base_url}NegociosController/load_cita_agendada`, {
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
			if (json["id_cita"] != "") {
				get_info_citas(json["id_cita"]);
			}else {
                hiddenLoading(cargando);
            }
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

const get_info_citas = async (id_cita) => {
	const url = `${base_url}AgendaController/get_info_cita`;
	const form_data = new FormData();
	form_data.append("id_cita", id_cita);
	await execute_fetch(url, form_data).then((resp) => {
		if (resp.status) {
			let html_select = "";
			resp.data.forEach((element) => {
				let estado = "";
				switch (element.estado) {
					case "1":
						estado = "AGENDADA";
						break;
					case "2":
						estado = "CANCELADA";
						break;
					case "3":
						estado = "REPROGRAMADA";
						break;
					case "4":
						estado = "CUMPLIDA";
						break;

					default:
						break;
				}
				html_select = `
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Fecha cita</td>
                                    <td>${element.fecha_cita}</td>
                                </tr>
                                <tr>
                                    <th>Nombre Cliente</th>
                                    <td>${element.primer_nombre_cliente} ${element.segundo_nombre_cliente} ${element.primer_apellido_cliente} ${element.segundo_apellido_cliente}</td>
                                </tr>
                                <tr>
                                    <td>Nit cliente</td>
                                    <td>${element.nit_cliente}</td>
                                </tr>
                                <tr>
                                    <td>Nombre Tecnico</td>
                                    <td>${element.primer_nombre_tecnico} ${element.segundo_nombre_tecnico} ${element.primer_apellido_tecnico} ${element.segundo_apellido_tecnico}</td>
                                </tr>
                                <tr>
                                    <td>Estado cita</td>
                                    <td>${estado}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    `;

				insert_html(html_select, "info_agenda");
				open_modal("modal_info_agenda");
                hiddenLoading(cargando);
			});
		} else {
			console.log(resp);
            hiddenLoading(cargando);
		}
	});
};
