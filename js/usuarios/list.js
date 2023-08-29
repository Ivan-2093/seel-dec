
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

function editUsuario(data) {
    let data_usuario = JSON.parse(data.getAttribute("data"));
    console.table(data_usuario);

/*     $("#inputTipoDoc").val(data_tercero[0]);
    comboPais.focus();
    $("#comboPais").val(data_tercero[11]);
    var event = new Event("change");
    comboPais.dispatchEvent(event); */

 /*    $("#comboDeptoBan").val(data_tercero[12]);
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

    $("#modalEditTercero").modal({
        keyboard: false,
    }); */
}
