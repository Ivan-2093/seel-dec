const wrapper = document.getElementsByClassName("wrapper");
const sidebar_header = document.getElementsByClassName("sidebar-header");
const cargando = document.getElementById("cargando");
const btnChangePass = document.getElementById("btnChangePass");
const form_change_pass = document.getElementById("form_change_pass");
const new_pass = document.getElementById("new_pass");
const new_pass_check = document.getElementById("new_pass_check");

/* ARRAY DE INPUTS */
const arrayInputs = [new_pass, new_pass_check];

document.addEventListener("DOMContentLoaded", () => {
	//Ocultar el menu para cuando terminde de cargar
	/* 	wrapper[0].classList.add("nav-collapsed");
		wrapper[0].classList.add("menu-collapsed"); 
		sidebar_header[0].children[1].children[0].classList.remove('ik-toggle-right');
		sidebar_header[0].children[1].children[0].classList.add('ik-toggle-left');
		sidebar_header[0].children[1].children[0].setAttribute('data-toggle','collapsed')  
	*/
});

document.addEventListener("DOMContentLoaded", function () {
	if (change_password == 1) {
		$("#modal_change_pass").modal({
			backdrop: false,
			keyboard: false,
			focus: true,
		});
	}
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

btnChangePass.addEventListener("click", function () {
	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const formPass = new FormData(form_change_pass);
		fn_change_password(formPass);
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
				alertFieldsVoidsSelect(inputsVoid);
			},
		});
	}
});

$("#modal_change_pass").on("hidden.bs.modal", function (e) {
	console.info("Cambio de contraseña realizado");
});

function fn_change_password(formPass)
{
	showLoading(cargando);
    fetch(`${base_url}HomeController/changePassword`, {
        headers: {
            "Content-type": "application/json",
        },
        mode: "no-cors",
        method: "POST",
        body: formPass,
    })
        .then(function (response) {
            // Transforma la respuesta. En este caso lo convierte a JSON
            return response.json();
        })
        .then(function (json) {
            
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