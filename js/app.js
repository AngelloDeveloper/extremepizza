$(function() {

    var data = {};
    var template = '';
    var alert = '';
    var swicth = '';
    var acum = '';

    console.log('este es un test');

    
    $('#form_r1').submit((evt) => {
        prevent(evt);

        data = {
            name: $('#name').val(),
            lastname: $('#lastname').val(),
            cedula: $('#cedula').val(),
            email : $('#email').val(),
            direction: $('#direction').val(),
            codeNumber: $('#codeNumber').val(),
            number: $('#number').val(),
            puntero: 'cliente'
        };

        async_query('async/', 'async_user.php', data, 'validation_data')
            .then((response) => {
                template = `
                    <div class="card-body">
                        <form id="form_r2">
                            <div class="form-group validation">
                                <label class="mb-2">Usuario</label>
                                <input id="user" type="text" 
                                    placeholder="Usuario"
                                    class="form-control mb-2" 
                                />
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Password</label>
                                <input id="pass" type="password" 
                                    placeholder="******"
                                    class="form-control mb-2" 
                                />
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Confirmacion de Password</label>
                                <input id="passConfig" type="password" 
                                    placeholder="******"
                                    class="form-control mb-2" 
                                />
                            </div>
                            <button type="submit" class="btn btn-success mt-2" style="width: 100%;">Finalizar</button>
                        </form>
                    </div>
                `;

                $('#card-dataperson').html(template);
            })
            .fail((Error_data) => {
                console.log(Error_data);
                $(document).find($('#'+Error_data)).removeClass('style_alert');
                $(document).find('.alert').remove();
                validationInput($('#'+Error_data), 'El dato ya fue registrado');
            })
    })

     
    $(document).on('submit', '#form_r2', (evt) => {
        prevent(evt);

        data.user = $('#user').val();
        if($('#pass').val() == $('#passConfig').val()) {
            data.password = $('#pass').val();
            data.puntero = 'user';
        } else {
            //validacion
            alert('password no coincide');
        }

        async_query('async/', 'async_user.php', data, 'validation_data')
            .then((response) => {
                async_query('async/', 'async_user.php', data, 'reg_user')
                    .then((response) => {
                        var parse = $.parseJSON(response);
                        if(parse['STATUS'] == 'ok') {
                            template = `
                                <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
                                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <img src="..." class="rounded me-2" alt="...">
                                        <strong class="me-auto">ExtremePizza</strong>
                                        <small>11 mins ago</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Se ha registrado exitosamente
                                    </div>
                                    </div>
                                </div>
                            `;

                            $(document).find('#system_message').html(template);
                            $('#system_message').find('.toast').toast('show');
                            setTimeout(() => {
                                window.location.replace('index.php');
                            }, 3500);
                        }
                    })
                    .fail((Error) => {
                        console.log(Error);
                    })
            }) 
            .fail((Error_data) => {
                $(document).find($('#'+Error_data)).removeClass('style_alert');
                $(document).find('.alert').remove();
                validationInput($('#'+Error_data), 'El dato ya fue registrado');
            })
    })

    //login
    $('#formLogin').submit((evt) => {
        prevent(evt);

        data = {
            user: $('#userLogin').val(),
            pass: $('#passLogin').val()
        };

        console.log('submit lofin');

        async_query('async/', 'async_user.php', data, 'login_user')
            .then((response) => {
                var parse = $.parseJSON(response);
                if(parse['STATUS'] == 'ok') {
                    window.location.replace('dashboard.php');
                }
            })
            .fail((Error) => {
                console.log(Error);
            })
    })

    $(document).on('keyup', '.only_letters', (evt) => {
        var elm = $(document).find('.only_letters').focus()[0];
        var value = $(elm).val();
        if(validDataInput(value) == false) {
            $(elm).val('');
        } else {
            console.log(true);
        }
    })

    $(document).on('click', '.address', function(response) {
        var elm = $(this)[0];
        var address = $(elm).data('address');
        var description = $(elm).data('description');
        console.log(address);
        $('#item_menu').html(description+'/');
        $('#render_modules').load(address);
    })


    //manejadores de modal
    $(document).on('click', '.modal_despliegue', function(evt) {
        var elm = $(this)[0];
        var target = $(elm).data('target');
        var title = $(elm).data('menu');
        var descripcion = $(elm).data('descripcion');
        var img = $(elm).data('img');

        $(document).find('#title').html(title);
        $(document).find('#descripcion').html(descripcion);
        $(document).find('#img').attr('src', img);

        $('#'+target).modal('show');
    })
    $(document).on('click', '.close_modal', function(response) {
        var elm = $(this)[0];
        var close = $(elm).data('close');

        $('#'+close).modal('hide');
    })

    $(document).on('click', '.form-check-input', function(evt) {
        var elm = $(this)[0];
        if($(elm).prop('checked') == true) {
            var body = $(elm).parent().parent().parent().parent().parent().parent().parent()[0];
            $(body).css({
                'background-color' : '#0D8D1D',
                'color' :  'white'
            });
            $(body).find('.modal_despliegue').css({'color' : 'white'});

            template = `
                <center>
                    <button id="next" class="btn btn btn-success btn-lg">
                        Continuar
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </center>
            `;

            $(document).find('#aux').html(template);
        } else {
            var body = $(elm).parent().parent().parent().parent().parent().parent().parent()[0];
            $(body).css({
                'background-color' : '#fff',
                'color' :  '#000'
            });
            $(body).find('.modal_despliegue').css({'color' : '#2CD041'});

            var cheks = $('.form-check-input');
            $.each(cheks, function(index, value) {
                if($(value).prop('checked') == true) {
                    swicth = true;
                    return false;
                } else {
                    swicth = false;
                }
            });

            if(swicth == false) {
                $(document).find('#aux').html('');
            }
        }
    })

    $(document).on('click', '#next', function(evt) {
        var arrData = [];
        var cheks = $('.form-check-input');
        $.each(cheks, function(index, value) {
            if($(value).prop('checked') == true) {
                arrData.push($(value).data('idmenu'));
            }
        });

        $('#render_modules').load('modules/newOrden.php', {'orden': arrData});
    })

    $(document).on('keyup', '.cantidad', function(evt) {
        var elm = $(this)[0];
        var elm_total = $(elm).parent().parent().parent().parent().find('.total')[0]; 
        var elm_presentacion = $(elm).parent().parent().parent().next().find('.presentacion')[0];
        console.log(elm_presentacion);
        var presentacion = $(elm_presentacion).val();
        console.log(presentacion);
        var arrData = presentacion.split(',');
        const data = {
            id: arrData[0],
            valor: arrData[1]
        };
        var cantidad = $(document).find(elm).val();
        var elm_costo_cantidad = $(document).find(elm).next().find('.costo_cantidad')[0];
        var precio = $(elm_costo_cantidad).data('precio');
        template = `<b>${(cantidad * precio)}</b>`;
        $(document).find(elm_costo_cantidad).html(template);
        $(elm_total).val(((cantidad * precio)+parseInt(data.valor)));
    })

    $(document).on('change', '.presentacion', function(evt) {
        var elm = $(this)[0];
        var elm_total = $(elm).parent().parent().parent().find('.total')[0];
        var elm_cantidad = $(elm).parent().parent().prev().find('.cantidad')[0];
        var cantidad = $(elm_cantidad).val();
        var elm_costo_cantidad = $(document).find(elm_cantidad).next().find('.costo_cantidad')[0];
        var precio = $(elm_costo_cantidad).data('precio');
        var stringValue = $(elm).val();
        var arrData = stringValue.split(',');
        const data = {
            id: arrData[0],
            valor: arrData[1]
        };
        var valor_presentacion = $(elm).next().find('.valor_presentacion');
        template = `<b>${data.valor}</b>`;
        $(valor_presentacion).html(template);
        $(elm_total).val(((cantidad * precio)+parseInt(data.valor)));
    })

    $(document).on('click', '#finish', function(evt) {
       var arrForm = $('.form_pedido');
       var arrData = [];
       swicth = false;
       $.each(arrForm, function(index, value) {
         var form = arrForm[index];
         var objData = {
            cantidad : '',
            presentacion : '',
            total: ''
        };

         objData.cantidad = $(form).find('.cantidad').val();
         objData.presentacion = $(form).find('.presentacion').val().split(',')[0];
         objData.total = $(form).find('.total').val();
         objData.idmenu = $(form).find('.idmenu').val();

         if(objData.presentacion == 0) {
             $('#validation_modal').modal('show');
             swicth = true;
         } else {
            $('#validation_modal').modal('hide');
            swicth = false;
         }

         arrData.push(objData);
       });

       var data = toObject(arrData);
       console.log(data);

       if(swicth == false) {
            $('#render_modules').load('modules/divisaSelect.php', {'data': data});
       }

    })

    $(document).on('click', '.divisa', function(evt) {
        var elm = $(this)[0];
        var divisa = $(elm).data('divisa');
        var elmDataPedido = $(elm).parent().parent().parent().find('#data_pedido')[0];
        var arrDataPedido = $(elmDataPedido).val();

        const data =  {
            pedido: $.parseJSON(arrDataPedido),
            divisa: divisa
        };

        async_query('async/', 'async_pedido.php', data, 'setPedido')
            .then((response) => {
                console.log(response);
                console.log('orden creada');
            })
            .fail((Error) => {
                console.log(Error);
            })
            
    })

    
})