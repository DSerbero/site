const password = document.querySelector("#iclave"),
toggle = document.querySelector("#ieye");

function showHide() {
    if (password.type == 'password') {
        password.setAttribute('type', 'text');
        toggle.style.color='#4481eb';
    } else {
        password.setAttribute('type', 'password');
        toggle.style.color='#acacac';
    }
}
