$(function() {

    var data = {};
    var template = '';
    var alert = '';

    
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

        console.log(data);
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
                console.log(Error_data);
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
                console.log(parse);
                if(parse['STATUS'] == 'ok') {
                    console.log(response);
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
})