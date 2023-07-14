const btnIniciarSesion = document.getElementById("btnIniciarSesion");
const formUser = document.getElementById("formUser");
const username = document.getElementById("username");
const password = document.getElementById("password");


const arrayInputs = [username, password];

btnIniciarSesion.addEventListener("click", function () {
	const inputsVoid = arrayInputs.filter(function (input) {
		if (input.tagName != "TEXTAREA") {
			return input.value == "";
		}
	});
	if (inputsVoid.length == 0) {
		const data_formUser = new FormData(formUser);
		login(data_formUser);
	} else {
		const nameInput = inputsVoid
			.map(function (input) {
				return input.previousElementSibling.innerText;
			})
			.join(", ");

		Swal.fire({
			title: "Advertencia",
			html: `Debe completar todos los campos del formulario: <strong>${nameInput}</strong>`,
			icon: "warning",
			confirmButtonText: "Ok",
			willClose: () => {
				alertFieldsVoids(inputsVoid);
			},
		});
	}
});

function login(data_formUser) {
	fetch(`${base_url}LoginController/login`, {
		headers: {
			"Content-type": "application/json",
		},
		mode: "no-cors",
		method: "POST",
		body: data_formUser,
	})
		.then(function (response) {
			// Transforma la respuesta. En este caso lo convierte a JSON
			return response.json();
		})
		.then(function (json) {
			if (json["response"] === "warning") {
				Swal.fire({
					title: "Advertencia",
					html: `<strong>${json["sms"]}</strong>`,
					icon: "warning",
					confirmButtonText: "Ok",
				});
			} else if (json["response"] === "success") {
				location.href = `${base_url}${json["url"]}`;
			}
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
		});
}

username.addEventListener("input", function (event) {
	username.value = username.value.toUpperCase();
});
btnIniciarSesion.addEventListener("keypress", function (event) {
	var keycode = event.keyCode;
	if (keycode == 13) {
		btnIniciarSesion.click();
	}
});
username.focus();
