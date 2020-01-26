
//Valida el singup

function valida() {
    var salida = '';
    // Comprobamos el nombre (Mínimo 2 palabras)
    var expr = /^[a-zA-Z0-9_-]{5,16}$/;
    if (!expr.test(document.getElementById('usuario').value)) {
        salida += 'El nombre de usuario debe ser de caracteres o números y debe ser de una longitud entre 5 y 16\n';
    }
    expr = /^[a-zA-Z0-9_-]{7,20}$/;
    if (!expr.test(document.getElementById('pass').value)) {
        salida += 'La contraseña debe ser de caracteres o números no podrá ser menor de 7 caracteres y deberá ser menor de 20\n';
    }
    if (document.getElementById('pass').value != document.getElementById('pass2').value) {
        salida += 'La contraseña debe coincidir';
    }
    if (salida != '') {
        alert(salida);
        return false;
    } else {
        return true;
    }
}

//valida el login

function valida2() {
    var salida = '';
    // Comprobamos el nombre (Mínimo 2 palabras)
    var expr = /^[a-zA-Z0-9_-]{5,16}$/;
    if (!expr.test(document.getElementById('lusuario').value)) {
        salida += 'El nombre de usuario debe ser de caracteres o números y debe ser de una longitud entre 5 y 16\n';
    }
    expr = /^[a-zA-Z0-9_-]{7,20}$/;
    if (!expr.test(document.getElementById('lpass').value)) {
        salida += 'La contraseña debe ser de caracteres o números no podrá ser menor de 7 caracteres y deberá ser menor de 20\n';
    }

    if (salida != '') {
        alert(salida);
        return false;
    } else {
        return true;
    }
}