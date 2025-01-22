function validarnum(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    num = "1234567890.-";

    if(num.indexOf(tecla)==-1){
        return false;
    }
}

function soloLetrasNumeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890.";

    if(letras.indexOf(tecla)==-1){
        return false;
    }
}

function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    num = "1234567890";

    if (num.indexOf(tecla) == -1) {
        return false;
    }
}

function soloLetras(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";

    if(letras.indexOf(tecla)==-1){
        return false;
    }
}