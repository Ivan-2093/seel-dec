const newspaperSpinning = [{ background: "yellow" }, { background: "none" }];
const newspaperTiming = { duration: 500, iterations: 5 };
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
		}
	});
}

function alertFieldsVoidsSelect(arrayInputs) {
	arrayInputs.map(function (input) {
		if (input.value == "") {
			if (input.type == "select-one") {
				let idSelect = `select2-${input.id}-container`;
				let selectSpan = document.getElementById(idSelect);
				if(selectSpan == null) {
					input.animate(newspaperSpinning, newspaperTiming);
					input.focus();
				}else{
					selectSpan.animate(newspaperSpinning, newspaperTiming);
					selectSpan.focus();
				}
				
			} else {
				input.animate(newspaperSpinning, newspaperTiming);
				input.focus();
			}
		}
	});
}

function isAlphanumeric() {
	var e = event || window.event;
	var key = e.keyCode || e.which;

	if (
		(key >= 48 && key <= 57) ||
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

function isAddress() {
	var e = event || window.event;
	var key = e.keyCode || e.which;

	if (
		(key >= 48 && key <= 57) ||
		(key >= 97 && key <= 122) ||
		(key >= 65 && key <= 90) ||
		key === 32 ||
		key === 209 ||
		key === 241 ||
		key === 35 ||
		key === 45
	) {
	} else {
		e.preventDefault();
	}
}

function aplicarNuberFormat(elemento) {
    var id = elemento.id;
    $("#"+id).map(function(){
        return this.value = number_format(this.value.replace(/[^0-9]/g, ''));
    });
}
// necesarios para aplicar el formato
function number_format(numero) {
    var numParseado = null;
    if (numero != 0) {
        var cant = customRound(numero.length/3);
        var exp = '';
        var variables = '';
        for (let i = 1; i <= cant; i++) {
            if (i == cant) {
                variables = variables +'$'+i ;
            } else {            
                exp = '(\\d{3})' + exp;
                variables = variables + '$'+ i + '.'
            }
        }
        numParseado = numero.replace(RegExp('(\\d+)'+exp),variables);
    } else {
        numParseado = 0;
    }
    return numParseado;
}
function customRound(n) {
    var h = (n * 100) % 10;
    return h >= 1
        ? parseInt(n.toString().charAt(0)) + 1
        : parseInt(n.toString().charAt(0));
};

function borrarCeros(x) {
    if(x.value == "0"){
        x.value = '';
    }
}