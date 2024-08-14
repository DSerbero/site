const form = document.getElementById("form");

form.addEventListener("submit", function (event) {
    var autoriz = document.getElementById("confir");
    var tratami = document.getElementById("trata");

    if (!autoriz.checked && !tratami.checked) {
        alert("Debes de estar seguro de enviar los datos y aceptar el tratamiento de los datos.")
        event.preventDefault();
    } else if(!autoriz.checked) {
        alert("Debes de estar seguro de enviar los datos.")
        event.preventDefault();
    } else if(!tratami.checked) {
        alert("Debes de aceptar el tratamiento de los datos.")
        event.preventDefault();
    }
});
