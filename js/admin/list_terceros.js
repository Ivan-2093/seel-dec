const tableTerceros = document.getElementById('tableTerceros');

document.addEventListener("DOMContentLoaded", () => {
	// codigo para ejecutar
	sidebar.classList.add("collapsed"); //Ocultar el nav para cuando terminde de cargar
	loadTerceros();
});

function loadTerceros() {
	fetch(`${base_url}TercerosController/loadTerceros`, {
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
			tableTerceros.tBodies[0].innerHTML = json['tbody'];
            loadDatatable(tableTerceros.id);
		})
		.catch(function (error) {});
}

function loadDatatable(id){
    $(`#${id}`).DataTable({
        "paging": true,
        "pageLength": -1,
        "lengthChange": true,
        "lengthMenu": [
        [-1, 10, 50, 100],
        ["Todos", 10, 50, 100]
        ],
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
}
