
function async_query(file, async, data, type) {
    const deferred = $.Deferred();
    const path = file+async;
    const objData = {
        data: data,
        type: type
    };

    console.log(objData);

    $.post(path, objData, function(response) {
        console.log(response);
        const parse = $.parseJSON(response);
        console.log(parse);

        if(parse['STATUS'] == 'ok' || parse['STATUS'] == 'BLOQUED' || parse['STATUS'] == 'fail') {
            console.log('aqui');
            deferred.resolve(response);
        } else {
            deferred.reject(parse['ERROR_DATA']);
        }
    })

    return deferred.promise();
}

function prevent(evt) {
    evt.preventDefault();
}

function validationInput(elm, message) {
    var clas_s = $(elm).parent();
    $(elm).addClass('style_alert_focus');
    alert = `
        <p class="alert style_alert_message" >${message}</p>
    `;

    $(clas_s).append(alert);
}


function ValidaSoloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for(var i in especiales){
         if(key == especiales[i]){
             tecla_especial = true;
             break;
         }
     }

     if(letras.indexOf(tecla)==-1 && !tecla_especial){
         return false;
     }
 }

function ValidaSoloNumeros() {
    if ((event.keyCode < 48) || (event.keyCode > 57)) {
        event.returnValue = false;
    }   
}

function toObject(arr) {
    var rv = {};
    for (var i = 0; i < arr.length; ++i) {
        rv[i] = arr[i];
    }
      
    return rv;
}