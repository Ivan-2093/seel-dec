
document.addEventListener("DOMContentLoaded", () => {

    loadUsuarios();

});

/* VARIABLES */
const tableUsuarios = document.getElementById('tableUsuarios');

const formEditUsuario = document.getElementById('formEditUsuario');
const inputIdUser = document.getElementById('inputIdUser');
const inputNameTercero = document.getElementById('inputNameTercero');
const inputNameUser = document.getElementById('inputNameUser');
const inputIdPerfil = document.getElementById('inputIdPerfil');
const inputIdEstado = document.getElementById('inputIdEstado');

/* ARRAY DE INPUTS */
const arrayInputsEdit = [
    inputIdUser,
    inputIdPerfil,
    inputIdEstado,
];

const btnSubmitEditUsuario = document.getElementById('btnSubmitEditUsuario');

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
            $('[data-toggle="tooltip"]').tooltip();
            loadDatatable(tableUsuarios.id);
            hiddenLoading(cargando);
        })
        .catch(function (error) {
            reportError(error);
            hiddenLoading(cargando);
        });
}

function editUsuario(data) {
    let data_usuario = JSON.parse(data.getAttribute("data"));
    console.table(data_usuario);

    $("#editUserModal").modal({
        keyboard: false,
    }); 
    
    inputIdUser.value= data_usuario[0];
    inputNameTercero.value= data_usuario[1];
    inputNameUser.value= data_usuario[2];
    inputIdPerfil.value= data_usuario[4];
    inputIdEstado.value= data_usuario[5];
}

btnSubmitEditUsuario.addEventListener('click', () => {
    const inputsVoid = arrayInputsEdit.filter(function (input) {
        if (input.tagName != "TEXTAREA") {
            return input.value == "";
        }
    });
    if (inputsVoid.length == 0) {
        const data_formUsuario = new FormData(formEditUsuario);
        editUsuarioById(data_formUsuario);
    } else {
        const nameInput = inputsVoid
            .map(function (input) {
                return input.previousElementSibling.innerText;
            })
            .join(", ");

        Swal.fire({
            title: "Advertencia",
            html: `Complete los siguientes campos vacios: <strong>${nameInput}</strong>`,
            icon: "warning",
            confirmButtonText: "Ok",
            willClose: () => {
                alertFieldsVoids(inputsVoid);
            },
        });
    }
});


function editUsuarioById(data_formUsuario) {
    showLoading(cargando);
    fetch(`${base_url}UsuariosController/editUsuario`, {
        headers: {
            "Content-type": "application/json",
        },
        mode: "no-cors",
        method: "POST",
        body: data_formUsuario,
    })
        .then(function (response) {
            // Transforma la respuesta. En este caso lo convierte a JSON
            return response.json();
        })
        .then(function (json) {
            if (json['response'] === 'success') {
                Swal.fire({
                    title: "EXITO",
                    html: `${json['message']}`,
                    icon: "success",
                    confirmButtonText: "Ok",
                    allowOutsideClick: false,
                    showCloseButton: true,
                    willClose: () => {
                        showLoading(cargando);
                        location.reload();
                    },
                });
            } else if (json['response'] === 'error') {
                Swal.fire({
                    title: "ERROR",
                    html: `${json['message']}`,
                    icon: "error",
                    confirmButtonText: "Ok",
                    allowOutsideClick: false,
                    showCloseButton: true,
                });
            } else if (json['response'] === 'warning') {
                Swal.fire({
                    title: "ADVERTENCIA",
                    html: `${json['message']}`,
                    icon: "warning",
                    confirmButtonText: "Ok",
                    allowOutsideClick: false,
                    showCloseButton: true,
                });
            }
            hiddenLoading(cargando);
        })
        .catch(function (error) {
            reportError(error);
            hiddenLoading(cargando);
        });
}
