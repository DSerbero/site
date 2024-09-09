const form = document.getElementById("form"); //Se llama el formulario con ID form

form.addEventListener("submit", function (event) { //Se crea un evento al momento de intentar enviar el formulario
    var autoriz = document.getElementById("confir"); //Se llama el formulario con ID confir
    var tratami = document.getElementById("trata"); //Se llama el formulario con ID trata

    if (!autoriz.checked && !tratami.checked) { //Se vericia que ambos no esten marcados
        alert("Debes de estar seguro de enviar los datos y aceptar el tratamiento de los datos.") //Se muestra la alerta con el error
        event.preventDefault(); //Se activa el evento para prevenir el envio o que se salga de la página
    } else if(!autoriz.checked) {
        alert("Debes de estar seguro de enviar los datos.")
        event.preventDefault();
    } else if(!tratami.checked) {
        alert("Debes de aceptar el tratamiento de los datos.")
        event.preventDefault();
    }
});
