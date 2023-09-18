$(document).ready(function () {
    get_citas();
})


function load_calendar(data = null) {
    //console.log(citas);
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: data,
        select: function (arg) {
            var d = new Date();
        },
        eventClick: function (arg) {
            get_info_citas(arg.event._def.extendedProps.id_cita);
        },
        headerToolbar: {
            left: 'prev,next,today',
            center: 'title',
            right: ''
        },
        customButtons: {
            prev: {
                text: 'Prev',
                click: function () {
                    // so something before
                    // console.log("PREV button is going to be executed");
                    // do the original command
                    calendar.prev();
                    // do something after
                    var mes = calendar.getDate().getMonth() + 1;
                    var ano = calendar.getDate().getFullYear();
                }
            },
            next: {
                text: 'Next',
                click: function () {
                    // so something before
                    // console.log("NEXT button is going to be executed");
                    // do the original command
                    calendar.next();
                    // do something after
                    var mes = calendar.getDate().getMonth() + 1;
                    var ano = calendar.getDate().getFullYear();
                }
            }
        }
    });
    calendar.setOption('locale', 'Es');
    calendar.render();
    hiddenLoading(cargando);
}

function open_modal_crear() {
    let date = new Date()
    let day = `${(date.getDate())}`.padStart(2, '0');
    let month = `${(date.getMonth() + 1)}`.padStart(2, '0');
    let year = date.getFullYear();

    open_modal('modal_agenda');
    get_element('fecha_registro').value = `${year}-${month}-${day}`;
    get_element('estado').value = '1';
    get_element('negocio_id').value = get_element('id_neg').value;
    get_element('user_crea').value = get_element('user_id').value;

    get_tecnicos();
}

const get_tecnicos = async () => {
    const url = `${base_url}AgendaController/get_tecnicos`;
    await execute_fetch(url, null)
        .then(resp => {
            if (resp.status) {
                let html_select = `<option value="">Seleccine un Tecnico</option>`;
                resp.data.forEach(element => {
                    html_select += `<option value="${element.nit}">${element.primer_nombre} ${element.segundo_nombre} ${element.primer_apellido} ${element.segundo_apellido}</option>`;
                });
                insert_html(html_select, 'tecnico');
            } else {
                console.log(resp);
            }
        });
}

const get_citas = async () => {
    showLoading(cargando);
    const url = `${base_url}AgendaController/get_citas`;
    await execute_fetch(url, null)
        .then(resp => {
            if (resp.status) {
                load_calendar(resp.data);
            } else {
                console.log(resp);
                hiddenLoading(cargando);
            }
            
        });
}

const get_info_citas = async (id_cita) => {
    const url = `${base_url}AgendaController/get_info_cita`;
    const form_data = new FormData();
    form_data.append('id_cita', id_cita);
    await execute_fetch(url, form_data)
        .then(resp => {
            if (resp.status) {
                let html_select = "";
                resp.data.forEach(element => {
                    let estado = "";
                    switch (element.estado) {
                        case '1':
                            estado = "AGENDADA"
                            break;
                        case '2':
                            estado = "CANCELADA"
                            break;
                        case '3':
                            estado = "REPROGRAMADA"
                            break;
                        case '4':
                            estado = "CUMPLIDA"
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

                    insert_html(html_select,'info_agenda');
                    open_modal('modal_info_agenda');
                })
            } else {
                console.log(resp);
            }
        });
}

function crear_cita() {
    const id_neg = get_element('id_neg').value;

    const exclude = [];

    const { form_data, empty_field } = get_values_form_elements('form_agenda', exclude);

    if (!empty_field) {
        const url = `${base_url}AgendaController/crear_cita`;
        const resp_controller = execute_fetch(url, form_data)
            .then(resp => {
                if (resp.status) {
                    Swal.fire({
                        title: 'Exito!',
                        text: resp.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            get_citas();
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: resp.message,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            get_citas();
                        }
                    })
                }
            })
    } else {
        
    }
}

