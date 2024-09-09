window.addEventListener('load', function () { //Se añade el evento al momento de cargar la pagina
    setTimeout(function () { //Se crea un contador para dar un tiempo de espera
        var preloader = document.querySelectorAll(".preloader"); //Se llama el elemento con clase preloader
        preloader.forEach(function (element) {
            element.classList.add("loaded"); //Se añade la clase loaded al elemnto
        });
    }, 300);
});
window.addEventListener('beforeunload', function (event) { //Se crea el evento oara cuando se sale de la pagina
    var preloader = document.querySelectorAll(".preloader"); //Se llama el elemento con clase preloader
    preloader.forEach(function (element) {
        element.classList.remove("loaded"); //Se elimina la clase loaded al elemnto
    });
});