window.addEventListener("scroll", function () { //Se cre aun evento verificando un scroll de la pantalla
    var header_nav = document.querySelectorAll(".header-nav"); //Se crea la variable llamando al elemento con clase header-nav
    header_nav.forEach(function (element) { //Se crea una función con bucle foreach para llamar a todos los elementos con la clase
        element.classList.toggle("abajo", window.scrollY > 0); //Se agrega la clase abajo al elemento mediante toggle, esto para que se quite y ponga dependiendo si se cumple o no los requisitos
    });

});