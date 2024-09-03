window.addEventListener("scroll", function () {
    var header_nav = document.querySelectorAll(".header-nav");
    header_nav.forEach(function (element) {
        element.classList.toggle("abajo", window.scrollY > 0);
    });

});