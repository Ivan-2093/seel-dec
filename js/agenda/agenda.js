$(document).ready(function () {
	get_citas();
});

function load_calendar(data = null) {
	showLoading(cargando);
	var calendarEl = document.getElementById("calendar");
	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: "dayGridMonth",
		selectable: true,
		events: data,
		select: function (arg) {
			var d = new Date();
		},
		eventClick: function (arg) {
			get_info_citas(arg.event._def.extendedProps.id_cita);
		},
		headerToolbar: {
			left: "prev,next,today",
			center: "title",
			right: "",
		},
		customButtons: {
			prev: {
				text: "Prev",
				click: function () {
					// so something before
					// console.log("PREV button is going to be executed");
					// do the original command
					calendar.prev();
					// do something after
					var mes = calendar.getDate().getMonth() + 1;
					var ano = calendar.getDate().getFullYear();
				},
			},
			next: {
				text: "Next",
				click: function () {
					// so something before
					// console.log("NEXT button is going to be executed");
					// do the original command
					calendar.next();
					// do something after
					var mes = calendar.getDate().getMonth() + 1;
					var ano = calendar.getDate().getFullYear();
				},
			},
		},
	});
	calendar.setOption("locale", "Es");
	calendar.render();
	hiddenLoading(cargando);
}

function open_modal_crear() {
	let date = new Date();
	let day = `${date.getDate()}`.padStart(2, "0");
	let month = `${date.getMonth() + 1}`.padStart(2, "0");
	let year = date.getFullYear();

	open_modal("modal_agenda");
	get_element("fecha_registro").value = `${year}-${month}-${day}`;
	get_element("estado").value = "1";
	get_element("negocio_id").value = get_element("id_neg").value;
	get_element("user_crea").value = get_element("user_id").value;

	get_tecnicos();
}

const get_tecnicos = async () => {
	const url = `${base_url}AgendaController/get_tecnicos`;
	await execute_fetch(url, null).then((resp) => {
		if (resp.status) {
			let html_select = `<option value="">Seleccine un Tecnico</option>`;
			resp.data.forEach((element) => {
				html_select += `<option value="${element.nit}">${element.primer_nombre} ${element.segundo_nombre} ${element.primer_apellido} ${element.segundo_apellido}</option>`;
			});
			insert_html(html_select, "tecnico");
		} else {
			console.log(resp);
		}
	});
};

const get_citas = async () => {
	showLoading(cargando);
	const url = `${base_url}AgendaController/get_citas_tecnicos`;
	await execute_fetch(url, null).then((resp) => {
		if (resp.status) {
			load_calendar(resp.data);
		} else {
			console.log(resp);
		}
		hiddenLoading(cargando);
	});
};

const get_info_citas = async (id_cita) => {
	showLoading(cargando);
	const url = `${base_url}AgendaController/get_info_cita`;
	const form_data = new FormData();
	form_data.append("id_cita", id_cita);
	await execute_fetch(url, form_data).then((resp) => {
		if (resp.status) {
			let html_select = "";
			resp.data.forEach((element) => {
				let estado = "";
				let btnReprogramar = "";
				let btnCancelar = "";
				switch (element.estado) {
					case "1":
						estado = "AGENDADA";
						btnReprogramar = `<button onclick="reprogramarInstalacion(${element.id_cita},'${element.fecha_cita}');" type="button" class="btn btn-warning">REPROGRAMAR</button>`;
						btnCancelar = `<button onclick="cancelarInstalacion(${element.id_cita});" type="button" class="btn btn-danger">CANCELAR</button>`;
						break;
					case "2":
						estado = "EN PROCESO";
						break;
					case "3":
						estado = "CANCELADA";
						break;
					case "4":
						estado = "REPROGRAMADA";
						break;
					case "5":
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
                                    <th>ID Negocio</th>
                                    <td>${element.id_negocio}</td>
                                </tr>
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
                        <input type="hidden" id="id_cita_t" name="id_cita_t" value="${element.id_cita}"/>
                        <input type="hidden" id="estado_cita_t" name="estado_cita_t" value="${element.estado}"/>
                    </div>
                    `;
				html_footer = `${btnReprogramar}${btnCancelar}`;

				insert_html(html_select, "info_agenda");
				insert_html(html_footer, "info_agenda_footer");
				open_modal("modal_info_agenda");
				hiddenLoading(cargando);
			});
		} else {
			console.log(resp);
			hiddenLoading(cargando);
		}
	});
};

const id_cita_re = document.getElementById("id_cita_repro");
const new_date = document.getElementById("new_date_cita");
const fec_cita_repro = document.getElementById("fec_cita_repro");

const reprogramarInstalacion = async (id_cita,fec) => {
	id_cita_re.value = id_cita;
	fec_cita_repro.value = fec;
	close_modal("modal_info_agenda");
	open_modal("modal_reprogamar_agenda");
};

const cancelarInstalacion = async (id_cita) => {
	Swal.fire({
		icon: "info",
		title: `¿Está seguro de cancelar la cita #${id_cita}?`,
		showDenyButton: true,
		showCancelButton: false,
		confirmButtonText: "SI",
		denyButtonText: `NO`,
		allowOutsideClick: false,
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
			cancelarInstalacionSave(id_cita);
		} else if (result.isDenied) {
			close_modal("modal_info_agenda");
		}
	});
};

const cancelarInstalacionSave = async (id_cita) => {
	showLoading(cargando);
	const url = `${base_url}AgendaController/cancel_cita_agendada`;
	const cancel_cita = new FormData();
	cancel_cita.append("id_cita", id_cita);
	await execute_fetch(url, cancel_cita).then((resp) => {
		if (resp.response) {
			Swal.fire({
				title: resp.title,
				html: resp.html,
				icon: resp.response,
			});

			if (resp.response == "success") {
				close_modal("modal_info_agenda");
				get_citas();
			}

			hiddenLoading(cargando);
		} else {
			console.log(resp);
			hiddenLoading(cargando);
		}
	});
};


const reprogamarCita = async () => {
	if (id_cita_re.value != "" && new_date.value != "" && new_date.value > fec_cita_repro.value) {
		showLoading(cargando);
		const url = `${base_url}AgendaController/reprogramar_cita_agendada`;
		const repro_cita = new FormData();
		repro_cita.append("id_cita", id_cita_re.value);
		repro_cita.append("fecha_cita", new_date.value);
		await execute_fetch(url, repro_cita).then((resp) => {
			if (resp.response) {
				Swal.fire({
					title: resp.title,
					html: resp.html,
					icon: resp.response,
				});

				if (resp.response == "success") {
					close_modal("modal_info_agenda");
					get_citas();
				}

				hiddenLoading(cargando);
			} else {
				console.log(resp);
				hiddenLoading(cargando);
			}
		});
	} else {
		Swal.fire({
            title: 'Advertencia!',
            html: `<strong>Debe agregar una nueva fecha para reprogramar la instalación!<br>Nota: La nueva fecha debe ser mayor a la antigua.</strong>`,
            icon: 'warning',
        });
	}
};
