const btnIniciarSesion = document.getElementById("btnIniciarSesion");
const formUser = document.getElementById("formUser");
const username = document.getElementById("username");
const password = document.getElementById("password");
const verPassCheck = document.getElementById("verPassCheck");
const forgot_pass = document.getElementById("forgot_pass");
const btnRestPass = document.getElementById("btnRestPass");
const usernameRest = document.getElementById("usernameRest");


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
			reportError(error);
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

verPassCheck.addEventListener('mousedown', () => {
	if (password.getAttribute('type') === 'text') {
		password.setAttribute('type', 'password');
		verPassCheck.children[0].classList.remove('ik-eye-off');
		verPassCheck.children[0].classList.add('ik-eye');
	} else {
		password.setAttribute('type', 'text');
		verPassCheck.children[0].classList.remove('ik-eye-off');
		verPassCheck.children[0].classList.add('ik-eye');
	}
});

forgot_pass.addEventListener('click', () => {
	$('#exampleModalCenter').modal({
		keyboard: true
	  })
});


btnRestPass.addEventListener('click', () => {
	if (usernameRest.value != "") {
		showLoading(cargando);
		const formRestPass = new FormData();
		formRestPass.append('username',usernameRest.value);

		fetch(`${base_url}LoginController/restPassword`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: formRestPass,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				Swal.fire({
					title: `${json['title']}`,
					html: `<strong>${json["sms"]}</strong>`,
					icon: `${json['response']}`,
					confirmButtonText: "Ok",
				});
				hiddenLoading(cargando);
				$('#exampleModalCenter').modal('hide');
			})
			.catch(function (error) {
				reportError(error);
				hiddenLoading(cargando);
			});
	} else {
		Swal.fire({
			title: "Advertencia",
			html: `Debe ingresar un usuario!.`,
			icon: "warning",
			confirmButtonText: "Ok",
			allowOutsideClick: false,
			showCloseButton: true,
		});
		$('#exampleModalCenter').modal('show');
	}

});

function showLoading(cargando) {
	cargando.style.display = "block";
}

function hiddenLoading(cargando) {
	cargando.style.display = "none";
}


