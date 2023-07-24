const selectPerfil = document.getElementById('selectPerfil');

document.addEventListener("DOMContentLoaded", () => {
	$(".js-select2-perfiles").select2({
        theme: "classic",
		placeholder: "Seleccione un perfil",
		allowClear: true,
        width: 'resolve',
	});
});


selectPerfil.nextElementSibling.addEventListener('change', function(e) {
    console.log(e.target);
});




