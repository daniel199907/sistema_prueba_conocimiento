function validacionProducto() {
    let nombre = document.getElementById("name").value;
    let precio = document.getElementById("price").value;
    let descripcion = document.getElementById("description").value;
    let categoria = document.getElementById("category").value;
    let sucursal = document.getElementById("sucursal").value;
    let fecha = document.getElementById("date").value;
    let letters = /^[A-Za-z ]+$/;


    if (nombre == null || nombre.length === 0 || /^\s+$/.test(nombre)) {
        alert('Ingresa el nombre por favor.');
        return false;
    }
    if (nombre.length > 30) {
        alert('Ingresa hasta 30 caracteres únicamente en nombre.');
        return false;
    }
    if (!nombre.match(letters)) {
        alert('Ingresa solo ltras y estos caracteres (.,-).');
        return false;
    }
    if (precio == null || precio.length === 0 || /^\s+$/.test(precio)) {
        alert('Ingresa el precio por favor.');
        return false;
    }
    if (precio.length > 5) {
        alert('Ingresa hasta 5 caracteres únicamente en precio.');
        return false;
    }
    if (descripcion == null || descripcion.length === 0 || /^\s+$/.test(descripcion)) {
        alert('Ingresa una descripción por favor.');
        return false;
    }
    if (descripcion.length > 100) {
        alert('Ingresa hasta 100 caracteres únicamente en descripción.');
        return false;
    }
    if (categoria == null || categoria === 0) {
        alert('Selecciona una categoría por favor.');
        return false;
    }
    if (sucursal == null || sucursal === 0) {
        alert('Selecciona una sucursal por favor.');
        return false;
    }
    if (fecha == null || fecha.length === 0) {
        alert('Ingresa una fecha por favor.');
        return false;
    }
}

function validacionProductoEditar() {
    let comentario = document.getElementById("comentario").value;
    let estado = document.getElementById("idestado").value;
    if (comentario == null || comentario.length === 0 || /^\s+$/.test(comentario)) {
        alert('Ingresa el comentario por favor.');
        return false;
    }
    if (comentario.length > 100) {
        alert('Ingresa hasta 100 caracteres únicamente en comentario.');
        return false;
    }
    if (estado == null || estado === 0) {
        alert('Selecciona un estado por favor.');
        return false;
    }
}

function validateLogin() {
    let usuario = document.getElementById('_username').value;
    let contrasenia = document.getElementById('_password').value;
    if (usuario == null || usuario.length === 0 || /^\s+$/.test(usuario)) {
        alert('Ingresa el usuario por favor.');
        return false;
    }
    if (usuario.length > 12) {
        alert('Ingresa hasta 12 caracteres en usuario por favor.');
        return false;
    }
    if (contrasenia == null || contrasenia.length === 0 || /^\s+$/.test(contrasenia)) {
        alert('Ingresa la contraseña por favor.');
        return false;
    }
    if (contrasenia.length > 15) {
        alert('Ingresa hasta 15 caracteres en contraseña por favor.');
        return false;
    }
    if (contrasenia.length < 10) {
        alert('Ingresa de 10 a 15 caracteres en contraseña por favor.');
        return false;
    }
}
