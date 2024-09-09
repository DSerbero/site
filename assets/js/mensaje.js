function getParameterByName(name) { //Función para obtener información mediante el url
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

const datos = getParameterByName('datos'); //Se utiliza la función y se le da el atributo a llamar por medio del url

setTimeout(function () { // Se crea un timer para poder ejecutar el codigo
    if (datos) { //Se verifica que se hallan encontrado los datos
        var preloader = document.querySelectorAll("#mensaje"); //Se llama el elemento con id mensaje y es asigando a una variable
        preloader.forEach(function (element) { //Se crea el bucle foreach para dar la clase cargado a el o los elementos
            element.classList.add("cargado");
        });
        let msg = `../../models/${datos}.php`; //Se adigna la url para llamar el mensaje 
        fetch(msg) //Se realiza la solicitud HTTP al enlace
                .then(response => response.text()) //Extrae la respuesta como texto plano
                .then(data => {
                    document.getElementById('mensaje').innerHTML = data; //INserta el contenido recibido al elemento con id mensaje
                })
    }
}, 1000);


var preloader = document.querySelectorAll(".close_img"); //Se llama el elemento con clase close_img
if (preloader) { //Se verifica que exista
    window.addEventListener('click', function (event) { //Se crea el evento mediante click y se le asigna una función
        var preloader1 = document.querySelectorAll("#mensaje");  //Se llama el elemento con id mensaje y es asigando a una variable
        preloader1.forEach(function (element) { //Se crea el bucle foreach para dar la clase cargado a el o los elementos
            element.classList.remove("cargado"); //Se remueve la clase cargado al elemento
            const element1 = document.getElementById("id_01"); //Se llama el elemento con id id_01 y es asigando a una variable
            const element2 = document.getElementById("id_02"); //Se llama el elemento con id id_02 y es asigando a una variable
            const element3 = document.getElementById("close_msg"); //Se llama el elemento con id close_msg y es asigando a una variable
            element1.remove(); //Se elimina el elemento
            element2.remove(); //Se elimina el elemento
            element3.remove(); //Se elimina el elemento
        });
    });
}