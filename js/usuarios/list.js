const sidebar = document.getElementById('sidebar');
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
            tableUsuarios.tBodies[0].innerHTML = json['tbody'];
            loadDatatable(tableUsuarios.id);
        })
        .catch(function (error) {
            Swal.fire({
                title: "ERROR",
                html: `Ha ocurrido un error:( <strong>${error}</strong> ), contacte con el departamento de sistemas o intentenuavamente.`,
                icon: "error",
                confirmButtonText: "Ok",
                allowOutsideClick: false,
                showCloseButton: true,
                willClose: () => {
                    location.reload();
                },
            });
        });
}
