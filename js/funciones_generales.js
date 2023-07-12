const wrapper = document.getElementsByClassName("wrapper");
const sidebar_header = document.getElementsByClassName("sidebar-header");
const cargando = document.getElementById("cargando");


document.addEventListener("DOMContentLoaded", () => {
	//Ocultar el menu para cuando terminde de cargar
	
	/* 	wrapper[0].classList.add("nav-collapsed");
		wrapper[0].classList.add("menu-collapsed"); 
		sidebar_header[0].children[1].children[0].classList.remove('ik-toggle-right');
		sidebar_header[0].children[1].children[0].classList.add('ik-toggle-left');
		sidebar_header[0].children[1].children[0].setAttribute('data-toggle','collapsed')  */
    

});

function loadDatatable(id) {
	$(`#${id}`).DataTable({
		paging: true,
		pageLength: -1,
		lengthChange: true,
		lengthMenu: [
			[-1, 10, 50, 100],
			["Todos", 10, 50, 100],
		],
		searching: true,
		ordering: false,
		info: true,
		autoWidth: true,
		language: {
			sProcessing: "Procesando...",
			sLengthMenu: "Mostrar _MENU_ registros",
			sZeroRecords: "No se encontraron resultados",
			sEmptyTable: "Ningún dato disponible en esta tabla =(",
			sInfo:
				"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
			sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
			sInfoPostFix: "",
			sSearch: "Buscar:",
			sUrl: "",
			sInfoThousands: ",",
			sLoadingRecords: "Cargando...",
			oPaginate: {
				sFirst: "Primero",
				sLast: "Último",
				sNext: "Siguiente",
				sPrevious: "Anterior",
			},
			oAria: {
				sSortAscending:
					": Activar para ordenar la columna de manera ascendente",
				sSortDescending:
					": Activar para ordenar la columna de manera descendente",
			},
			buttons: {
				copy: "Copiar",
				colvis: "Visibilidad",
			},
		},
	});
}

function showLoading(cargando) {
	cargando.style.display = "block";
}

function hiddenLoading(cargando) {
	cargando.style.display = "none";
}


