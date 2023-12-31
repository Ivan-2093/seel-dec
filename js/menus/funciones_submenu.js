const tabla_submenu = document.getElementById("tabla_submenu");

const idSubMenuEditar = document.getElementById("idSubMenuEditar");
const nameSubMenuEditar = document.getElementById("nameSubMenuEditar");
const rutaSubMenuEditar = document.getElementById("rutaSubMenuEditar");
const nameIconoEditar = document.getElementById("nameIconoEditar");
const iconoEditar = document.getElementById("iconoEditar");

const formEditMenu = document.getElementById("formEditMenu");
const formulario_submenu = document.getElementById("formulario_submenu");

const btnEditarSubMenu = document.getElementById("btnEditarSubMenu");
const btnAddNewSubmenu = document.getElementById("btnAddNewSubmenu");

const nombreSubmenu = document.getElementById("nombreSubmenu");
const ruta_submenu = document.getElementById("ruta_submenu");
const nombre_icono = document.getElementById("nombre_icono");

const id_menuSelect = document.getElementById("id_menuSelect");


document.addEventListener("DOMContentLoaded", function () {
	load_tabla_submenu();
	load_options_select_menus();
});

const arrayInputs = [nameSubMenuEditar, nameIconoEditar,rutaSubMenuEditar];
const arrayInputsCreate = [id_menuSelect,nombreSubmenu,ruta_submenu,nombre_icono];

function load_tabla_submenu() {
	showLoading(cargando);
	fetch(`${base_url}MenuController/listSubmenus`, {
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
			tabla_submenu.tBodies[0].innerHTML = json["tbody"];
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function editarSubMenu(menu) {
	idSubMenuEditar.value = menu.getAttribute("id_menu");
	nameSubMenuEditar.value = menu.getAttribute("menu");
	rutaSubMenuEditar.value = menu.getAttribute("ruta");
	nameIconoEditar.value = menu.getAttribute("icono");
	const clases = menu.getAttribute("icono").split(" ");
	iconoEditar.classList.add(clases[0]);
	iconoEditar.classList.add(clases[1]);

	$("#modalEditarMenu").modal("show");
}

nameIconoEditar.addEventListener("blur", function () {
	iconoEditar.removeAttribute("class");
	iconoEditar.setAttribute("class", nameIconoEditar.value);
});

btnEditarSubMenu.addEventListener("click", function () {
	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formUsuario = new FormData(formEditMenu);
		editarMenuById(data_formUsuario);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.getAttribute("cajaTexto");
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Complete los siguientes campos vacios: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoidsSelect(inputsVoid);
				$("#modalEditarMenu").modal("show");
			},
		});
	}
});

function editarMenuById(formEditMenu) {
	showLoading(cargando);
	fetch(`${base_url}MenuController/editSubMenuById`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: formEditMenu,
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
					load_tabla_submenu();
				},
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function deleteSubMenu(id_menu) {
	showLoading(cargando);
	const formDeleteMenu = new FormData();
	formDeleteMenu.append("idMenuDelete", id_menu);
	fetch(`${base_url}MenuController/deleteSubmenuById`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: formDeleteMenu,
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
					load_tabla_submenu();
				},
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

btnAddNewSubmenu.addEventListener("click", () => {
	const inputsVoid = arrayInputsCreate.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formSubmenu = new FormData(formulario_submenu);
		createSubmenu(data_formSubmenu);
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
				$("#ModalCreateSubmenu").modal("show");
			},
		});
	}
});

function createSubmenu(data_formMenu) {
	showLoading(cargando);
	fetch(`${base_url}MenuController/createSubmenu`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_formMenu,
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
					load_tabla_submenu();
				},
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function load_options_select_menus()
{
	fetch(`${base_url}MenuController/htmlSelectMenus`, {
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
			id_menuSelect.innerHTML = json['OptionSelectMenu'];
			$('.js-select2-id-menus').select2({
				placeholder: 'Seleccione un menu',
				width: '100%',
			});
		})
		.catch(function (error) {
			reportError(error);
		});
}
