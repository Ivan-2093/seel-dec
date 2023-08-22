
document.addEventListener("DOMContentLoaded", () => {
    //Ocultar el nav para cuando terminde de cargar
    if (screen.width < 1024) {
        sidebar.classList.remove("collapsed");
    }

    loadUsuarios();

});

/* VARIABLES */

const tableUsuarios = document.getElementById('tableUsuarios');

function loadUsuarios() {
    showLoading(cargando);
    fetch(`${base_url}UsuariosController/loadUsuarios`, {
        headers: {
            "Content-type": "application/json",
        },
        mode: "no-cors",
        method: "POST",
    })
        .then(function (response) {
            // Transforma la respuesta. En este caso lo convierte a JSON
            return response.json();
        })
        .then(function (json) {
            $(`#${tableUsuarios.id}`).dataTable().fnDestroy();
            tableUsuarios.tBodies[0].innerHTML = json['tbody'];
            loadDatatable(tableUsuarios.id);
            hiddenLoading(cargando);
        })
        .catch(function (error) {
            reportError(error);
            hiddenLoading(cargando);
        });
}
