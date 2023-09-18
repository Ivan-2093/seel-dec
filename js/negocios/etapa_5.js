const btnSaveTerminacion = document.getElementById('btnSaveTerminacion');
const form_terminacion = document.getElementById('form_terminacion');

btnSaveTerminacion.addEventListener('click', () => {

    if (form_terminacion.checkValidity()) {

        saveTipoTerminacion();

    } else {
        btnSaveTerminacion.type = 'submit';
        btnSaveTerminacion.click();
        setTimeout(function () {
            btnSaveTerminacion.type = 'button';
        }, 200);

    }
});


function saveTipoTerminacion() {
    showLoading(cargando);

    const form_solicitud = new FormData(form_terminacion);
    form_solicitud.append("id_negocio", id_negocio.value);
    fetch(`${base_url}NegociosController/saveTerminacionNegocio`, {
        headers: {
            "Content-type": "application/json",
        },
        mode: "no-cors",
        method: "POST",
        body: form_solicitud,
    })
        .then(function (response) {
            // Transforma la respuesta. En este caso lo convierte a JSON
            return response.json();
        })
        .then(function (json) {
            swal.fire({
                title: json['title'],
                html: json['html'],
                icon: json['response'],
                willClose: () => {
                    if (json['response'] == 'success') {
                        load_flujo_trabajo();
                    }
                }
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




function load_data_terminacion_negocio() {
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

            if (json['response'] == 'success') {
                $('#id_tipo_terminancion').val(json['estado']);
                $('#obs_termina').val(json['observacion']);
                $("#id_tipo_terminancion").attr("disabled", true);
                $("#obs_termina").attr("disabled", true);
                $("#modal_terminar_negocio").modal("show");
                btnSaveTerminacion.disabled=true;
            } else {
                swal.fire({
                    title: json['title'],
                    html: json['html'],
                    icon: json['response']
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