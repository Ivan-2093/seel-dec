const btnFinalizarInstall = document.getElementById('btnFinalizarInstall');
const btnIniciarInstall = document.getElementById('btnIniciarInstall');

const get_estado_cita = async () => {
    const data_cita = new FormData();
    data_cita.appendChild('id_cita',document.getElementById('id_cita_t').value);
    const url = `${base_url}AgendaController/check_estado_cita`;
    await execute_fetch(url, data_cita)
        .then(resp => {
            if (resp.status) {
                
                resp.data.forEach(element => {
                });
                
            } else {
                
            }
        });
}

btnIniciarInstall.addEventListener('click',() => {
    const estado_cita = document.getElementById('estado_cita_t');
    if(estado_cita.value == 1){
        alert('Iniciar');
    }
});

btnFinalizarInstall.addEventListener('click',() => {
    
});

/* {
    "id_cita": "13",
    "primer_nombre_cliente": "SERGIO",
    "segundo_nombre_cliente": "IVAN",
    "primer_apellido_cliente": "GALVIS",
    "segundo_apellido_cliente": "ESTEBAN",
    "nit_cliente": "1097304901",
    "primer_nombre_tecnico": "JHON",
    "segundo_nombre_tecnico": "JAIRO",
    "primer_apellido_tecnico": "SILVA",
    "segundo_apellido_tecnico": "FUENTES",
    "nit_tecnico": "1098713285",
    "fecha_cita": "2023-09-20",
    "tecnico": "1098713285",
    "estado": "1",
    "detalles_cita": "Tester de cita de agendamiento para la instalación de los productos!"
} */