const hamburguer= document.querySelector('.hamburguer') //Se crea la variable llamando al elemento con clase hamburguer
const menu= document.querySelector('.menu-navegacion') //Se crea la variable llamando al elemento con clase menu-navegacion

// console.log(menu)
// console.log(hamburguer)

hamburguer.addEventListener('click', ()=>{ //Se crea el evento verificando mediante click
  menu.classList.toggle("spread") //Se agregar la clase spread al elemento menu
})

window.addEventListener('click', e=>{  //Se crea el evento verificando mediante click
  if(menu.classList.contains('spread') 
    && e.target !=menu && e.target != hamburguer  ){ //Se verifica si la clase ya fue asiganda o existe, y si fue en el lugar que corresponde
      menu.classList.toggle("spread") //Se elimina la clase del elemento
    }
})