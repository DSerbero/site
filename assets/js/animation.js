window.addEventListener('load', function () {
    setTimeout(function () {
        var preloader = document.querySelectorAll(".preloader");
        preloader.forEach(function (element) {
            element.classList.add("loaded");
        });
    }, 300);
});
window.addEventListener('beforeunload', function (event) {
    var preloader = document.querySelectorAll(".preloader");
    preloader.forEach(function (element) {
        element.classList.remove("loaded");
    });
});