/* variables */
const comboPais = document.getElementById('comboPais');

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
                console.table(json);
            })
            .catch(function (error) {
               
            });
    }

});