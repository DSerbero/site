function getParameterByName(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

const datos = getParameterByName('datos');

setTimeout(function () {
    if (datos) {
        var preloader = document.querySelectorAll("#mensaje");
        preloader.forEach(function (element) {
            element.classList.add("cargado");
        });
        let msg = `../../models/${datos}.php`;
        fetch(msg)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('mensaje').innerHTML = data;
                })
    }
}, 1000);


var preloader = document.querySelectorAll(".close_img");
if (preloader) {
    window.addEventListener('click', function (event) {
        var preloader1 = document.querySelectorAll("#mensaje");
        preloader1.forEach(function (element) {
            element.classList.remove("cargado");
            const element1 = document.getElementById("id_01");
            const element2 = document.getElementById("id_02");
            const element3 = document.getElementById("close_msg");
            element1.remove();
            element2.remove();
            element3.remove();
        });
    });
}