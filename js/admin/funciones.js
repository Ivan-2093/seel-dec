/* variables */
const comboPais = document.getElementById('comboPais');
const comboDepto = document.getElementById('comboDepto');
const comboMunicipio = document.getElementById('comboMunicipio');

document.addEventListener("DOMContentLoaded", () => {

    // codigo para ejecutar
    console.info("DOMContentLoaded");

});

comboPais.addEventListener("change", () => {

    if (comboPais.value !== "") {
        const data_pais = new FormData();
        data_pais.append('id_pais', comboPais.value);
        fetch(`${base_url}UsuariosController/deptosByIdPais`, {
            headers: {
                "Content-type": "application/json",
            },
            mode: 'no-cors',
            method: "POST",
            body: data_pais,
        })
            .then(function (response) {
                // Transforma la respuesta. En este caso lo convierte a JSON
                return response.json();
            })
            .then(function (json) {
                comboDepto.innerHTML = json['data_deptos'];
            })
            .catch(function (error) {
               
            });
    }

});

comboDepto.addEventListener("change", () => {

    if (comboDepto.value !== "") {
        const data_dpto = new FormData();
        data_dpto.append('id_depto', comboDepto.value);
        fetch(`${base_url}UsuariosController/municipiosByIdDepto`, {
            headers: {
                "Content-type": "application/json",
            },
            mode: 'no-cors',
            method: "POST",
            body: data_dpto,
        })
            .then(function (response) {
                // Transforma la respuesta. En este caso lo convierte a JSON
                return response.json();
            })
            .then(function (json) {
                comboMunicipio.innerHTML = json['data_municipios'];
            })
            .catch(function (error) {
               
            });
    }

});