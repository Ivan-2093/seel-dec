/* SCRIPT PARA EVITAR QUE SE AGREGUEN CARACTERES ESPECIALES */
function isOnlyText() {
	var e = event || window.event;
	var key = e.keyCode || e.which;

	if (
		(key >= 97 && key <= 122) ||
		(key >= 65 && key <= 90) ||
		key === 32 ||
		key === 209 ||
		key === 241
	) {
	} else {
		e.preventDefault();
	}
}
/* SCRIPT PARA EVITAR QUE SE AGREGUEN SOLO NUMEROS */
function isOnlyNumber() {
	var e = event || window.event;
	var key = e.keyCode || e.which;

	if (!(key >= 48 && key <= 57)) {
		e.preventDefault();
	}
}

function validarEmail(email) {
	if (email.value !== "") {
		expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!expr.test(email.value)) {
			Swal.fire({
				title: "Advertencia",
				html: `Error: La dirección de correo <strong>${email.value}</strong> es incorrecta.`,
				icon: "warning",
				confirmButtonText: "Ok",
				allowOutsideClick: false,
				showCloseButton: true,
				willClose: () => {
					email.animate(newspaperSpinning, newspaperTiming);
					email.focus();
					email.value = "";
				},
			});
		}
	}
}

function alertFieldsVoids(arrayInputs) {
	arrayInputs.map(function (input) {
		if (input.value == "") {
			input.animate(newspaperSpinning, newspaperTiming);
			input.focus();
			input.value = "";
		}
	});
}
