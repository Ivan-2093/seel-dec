const tabla_menu = document.getElementById("tabla_menu");
const modalEditarMenu = document.getElementById("modalEditarMenu");

const idMenuEditar = document.getElementById("idMenuEditar");
const nameMenuEditar = document.getElementById("nameMenuEditar");
const nameIconoEditar = document.getElementById("nameIconoEditar");
const iconoEditar = document.getElementById("iconoEditar");

const formEditMenu = document.getElementById("formEditMenu");
const formulario_menu = document.getElementById("formulario_menu");

const btnEditarMenu = document.getElementById("btnEditarMenu");
const btnAddNewMenu = document.getElementById("btnAddNewMenu");

const nombreMenu = document.getElementById("nombreMenu");
const nombre_icono = document.getElementById("nombre_icono");

document.addEventListener("DOMContentLoaded", function () {
	load_tabla_menu();
});

const arrayInputs = [nameMenuEditar, nameIconoEditar];
const arrayInputsCreate = [nombreMenu, nombre_icono];

function load_tabla_menu() {
	showLoading(cargando);
	fetch(`${base_url}MenuController/listMenus`, {
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
			tabla_menu.tBodies[0].innerHTML = json["tbody"];
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function editarMenu(menu) {
	idMenuEditar.value = menu.getAttribute("id_menu");
	nameMenuEditar.value = menu.getAttribute("menu");
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

btnEditarMenu.addEventListener("click", function () {
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
	fetch(`${base_url}MenuController/editMenuById`, {
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
					load_tabla_menu();
				},
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

function deleteMenu(id_menu) {
	showLoading(cargando);
	const formDeleteMenu = new FormData();
	formDeleteMenu.append("idMenuDelete", id_menu);
	fetch(`${base_url}MenuController/deleteMenuById`, {
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
					load_tabla_menu();
				},
			});

			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}

btnAddNewMenu.addEventListener("click", () => {
	const inputsVoid = arrayInputsCreate.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formMenu = new FormData(formulario_menu);
		createMenu(data_formMenu);
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
				$("#ModalCreateMenu").modal("show");
			},
		});
	}
});

function createMenu(data_formMenu){
    showLoading(cargando);
	fetch(`${base_url}MenuController/createMenu`, {
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
					load_tabla_menu();
				},
			});
			hiddenLoading(cargando);
		})
		.catch(function (error) {
			reportError(error);
			hiddenLoading(cargando);
		});
}
