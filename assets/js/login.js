const password = document.querySelector("#iclave"), //Se llama el elemento con id iclave y es asigando a una variable
toggle = document.querySelector("#ieye"); //Se llama el elemento con id ieye y es asigando a una variable

function showHide() { //Se crea la funcion para cambiar el tipo de dato o input 
    if (password.type == 'password') {
        password.setAttribute('type', 'text');
        toggle.style.color='#4481eb';
    } else {
        password.setAttribute('type', 'password');
        toggle.style.color='#acacac';
    }
}
