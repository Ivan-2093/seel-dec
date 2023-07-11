document.addEventListener("DOMContentLoaded", () => {
    // codigo para ejecutar
    //Ocultar el nav para cuando terminde de cargar
    if (screen.width < 1024) {
        sidebar.classList.remove("collapsed");
    }
    $('.js-select2-tercero').select2({
        placeholder: 'Seleccione un tercero',
        width: '100%',
        clear: true
    });
    $('.js-select2-perfil').select2({
        placeholder: 'Seleccione un perfil',
        width: '100%',
        clear: true
    });
});

/* window.addEventListener('resize', start);

function start() {
    location.reload();
} */

/* VARIABLES */

const inputIdEmpleado = document.getElementById('inputIdEmpleado');
const inputIdPerfil = document.getElementById('inputIdPerfil');

/* ARRAY DE INPUTS */
const arrayInputs = [
    inputIdEmpleado,
    inputIdPerfil,
];



const formCreateUsuario = document.getElementById('formCreateUsuario');
const btnSubmitCreateUsuario = document.getElementById('btnSubmitCreateUsuario');

btnSubmitCreateUsuario.addEventListener('click', function () {
    const inputsVoid = arrayInputs.filter(function (input) {
        if (input.tagName != "TEXTAREA") {
            return input.value == "";
        }
    });
    if (inputsVoid.length == 0) {
        const data_formUsuario = new FormData(formCreateUsuario);
        createUsuario(data_formUsuario);
    } else {
        const nameInput = inputsVoid
            .map(function (input) {
                return input.nextElementSibling.innerText;
            })
            .join(", ");

        Swal.fire({
            title: "Advertencia",
            html: `Complete los siguientes campos vacios: <strong>${nameInput}</strong>`,
            icon: "warning",
            confirmButtonText: "Ok",
            willClose: () => {
                alertFieldsVoidsSelect(inputsVoid);
            },
        });
    }
});

function createUsuario(data_insert) {
    showLoading(cargando);
    fetch(`${base_url}UsuariosController/createUsuario`, {
        headers: {
            "Content-type": "application/json",
        },
        mode: "no-cors",
        method: "POST",
        body: data_insert,
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
                    willClose: () => {

                    },
                });
            } else if (json['response'] === 'warning') {
                Swal.fire({
                    title: "ADVERTENCIA",
                    html: `${json['message']}`,
                    icon: "warning",
                    confirmButtonText: "Ok",
                    allowOutsideClick: false,
                    showCloseButton: true,
                    willClose: () => {

                    },
                });
            }
            hiddenLoading(cargando);
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
            hiddenLoading(cargando);
        });
}

