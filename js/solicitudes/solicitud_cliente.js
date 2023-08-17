/* VARIABLES */
const inputNombres = document.getElementById('inputNombres');
const inputEmail = document.getElementById('inputEmail');
const inputPhone = document.getElementById('inputPhone');
const inputAddress = document.getElementById('inputAddress');
const inputSolicitud = document.getElementById('inputSolicitud');
const btnSubmitCreateSolicitud = document.getElementById('btnSubmitCreateSolicitud');
const comboDepto = document.getElementById("comboDepto");
const comboMunicipio = document.getElementById("comboMunicipio");

document.addEventListener('DOMContentLoaded', () => {
    loadDeptos();
});

function loadDeptos() {
    const data_pais = new FormData();
    data_pais.append("id_pais", 1);
    fetch(`${base_url}TercerosController/deptosByIdPais`, {
        headers: {
            "Content-type": "application/json",
        },
        mode: "no-cors",
        method: "POST",
        body: data_pais,
    })
        .then(function (response) {
            // Transforma la respuesta. En este caso lo convierte a JSON
            return response.json();
        })
        .then(function (json) {
            comboDepto.innerHTML = json["data_deptos"];
        })
        .catch(function (error) { });
}


inputPhone.addEventListener('keypress', () => {
    isOnlyNumber();
});
inputNombres.addEventListener('keypress', () => {
    isOnlyText();
});
inputSolicitud.addEventListener('keypress', () => {
    isAlphanumeric();
});
inputAddress.addEventListener('keypress', () => {
    isAddress();
});

comboDepto.addEventListener("change", () => {
	if (comboDepto.value !== "") {
		const data_dpto = new FormData();
		data_dpto.append("id_depto", comboDepto.value);
		fetch(`${base_url}TercerosController/municipiosByIdDepto`, {
			headers: {
				"Content-type": "application/json",
			},
			mode: "no-cors",
			method: "POST",
			body: data_dpto,
		})
			.then(function (response) {
				// Transforma la respuesta. En este caso lo convierte a JSON
				return response.json();
			})
			.then(function (json) {
				comboMunicipio.innerHTML = json["data_municipios"];
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
});