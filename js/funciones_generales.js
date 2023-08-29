const sidebar_header = document.getElementsByClassName("sidebar-header");
const cargando = document.getElementById("cargando");
const btnChangePass = document.getElementById("btnChangePass");
const form_change_pass = document.getElementById("form_change_pass");
const new_pass = document.getElementById("new_pass");
const new_pass_check = document.getElementById("new_pass_check");

const verPassNew = document.getElementById("verPassNew");
const verPassCheck = document.getElementById("verPassCheck");

/* ARRAY DE INPUTS */
const arrayInputsPass = [new_pass, new_pass_check];

document.addEventListener("DOMContentLoaded", function () {
	//Ocultar el menu para cuando terminde de cargar
	/* 	wrapper[0].classList.add("nav-collapsed");
		wrapper[0].classList.add("menu-collapsed"); 
		sidebar_header[0].children[1].children[0].classList.remove('ik-toggle-right');
		sidebar_header[0].children[1].children[0].classList.add('ik-toggle-left');
		sidebar_header[0].children[1].children[0].setAttribute('data-toggle','collapsed')  
	*/

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
		pageLength: 5,
		lengthChange: true,
		lengthMenu: [
			[-1, 10, 50, 100],
			["Todos", 10, 50, 100],
		],
		searching: true,
		ordering: false,
		info: true,
		autoWidth: false,
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
	const inputsVoid = arrayInputsPass.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		if (new_pass.value === new_pass_check.value) {
			const formPass = new FormData(form_change_pass);
			fn_change_password(formPass);
		} else {
			Swal.fire({
				title: "Advertencia",
				html: `Las contraseñas no coinciden!`,
				icon: "warning",
				confirmButtonText: "Ok",
			});
		}
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

function fn_change_password(formPass) {
	showLoading(cargando);
	fetch(`${base_url}UsuariosController/changePassword`, {
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
			Swal.fire({
				title: `${json["title"]}`,
				html: `${json["message"]}`,
				icon: `${json["response"]}`,
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
				willClose: () => {
					$("#modal_change_pass").modal("hide");
				},
			});
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

new_pass.addEventListener("keyup", () => {
	if (
		new_pass.value != "" &&
		new_pass.value.length >= 8 &&
		new_pass.value.length <= 16 &&
		(new_pass.value.match(/[A-Z]/) || new_pass.value.match(/[a-z]/)) &&
		new_pass.value.match(/[0-9]/)
	) {
		new_pass_check.removeAttribute("disabled");
		new_pass.style.boxShadow = "0px 0px 5px 1px green";
	} else {
		new_pass_check.setAttribute("disabled", "");
		new_pass.style.boxShadow = "0px 0px 5px 1px red";
	}
});
new_pass_check.addEventListener("keyup", () => {
	if (new_pass.value != "" && new_pass_check.value != "") {
		if (new_pass.value === new_pass_check.value) {
			new_pass_check.style.boxShadow = "0px 0px 5px 1px green";
		} else {
			new_pass_check.style.boxShadow = "0px 0px 5px 1px red";
		}
	}
});

verPassNew.addEventListener("mousedown", () => {
	if (new_pass.getAttribute("type") === "text") {
		new_pass.setAttribute("type", "password");
		verPassNew.children[0].classList.remove("ik-eye");
		verPassNew.children[0].classList.add("ik-eye-off");
	} else {
		new_pass.setAttribute("type", "text");
		verPassNew.children[0].classList.remove("ik-eye-off");
		verPassNew.children[0].classList.add("ik-eye");
	}
});
verPassCheck.addEventListener("mousedown", () => {
	if (new_pass_check.getAttribute("type") === "text") {
		new_pass_check.setAttribute("type", "password");
	} else {
		new_pass_check.setAttribute("type", "text");
	}
});

function reportError(error) {
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
}
