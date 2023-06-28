

document.addEventListener("DOMContentLoaded", () => {
    // codigo para ejecutar
    sidebar.classList.add("collapsed"); //Ocultar el nav para cuando terminde de cargar
    loadTableEmpleados();
});

const tableEmpleados = document.getElementById("tableEmpleados");
function loadTableEmpleados() {

    fetch(`${base_url}EmpleadosController/loadTableEmpleados`, {
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
            tableEmpleados.tBodies[0].innerHTML = json['tbody']
            loadDatatable(tableEmpleados.id);

        })
        .catch(function (error) { });
}
