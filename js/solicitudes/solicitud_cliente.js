/* VARIABLES */
const inputNombres = document.getElementById('inputNombres');
const inputEmail = document.getElementById('inputEmail');
const inputPhone = document.getElementById('inputPhone');
const inputAddress = document.getElementById('inputAddress');
const inputSolicitud = document.getElementById('inputSolicitud');
const btnSubmitCreateSolicitud = document.getElementById('btnSubmitCreateSolicitud');



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