$(function() {

    var data = {};
    var template = '';

    function prevent(evt) {
        evt.preventDefault();
    }

    $(document).on('click', '#btn-next', function(evt) {
        prevent(evt);

        data = {
            name: $('#name').val(),
            lastname: $('#lastname').val(),
            cedula: $('#cedula').val(),
            direction: $('#direction').val(),
            codeNumber: $('#codeNumber').val(),
            number: $('#number').val()
        };

        template = `
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label class="mb-2">Usuario</label>
                        <input id="user" type="text" 
                            placeholder="Usuario"
                            class="form-control" 
                        />
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Password</label>
                        <input id="pass" type="password" 
                            placeholder="******"
                            class="form-control" 
                        />
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Confirmacion de Password</label>
                        <input id="passConfig" type="password" 
                            placeholder="******"
                            class="form-control" 
                        />
                    </div>
                    <button id="btn-finish" class="btn btn-success mt-2" style="width: 100%;">Finalizar</button>
                </form>
            </div>
        `;

        $('#card-dataperson').html(template);
    })

    $(document).on('click', '#btn-finish', function(evt) {
        prevent(evt);

        data.user = $('#user').val();
        if($('#pass').val() == $('#passConfig').val()) {
            data.password = $('#pass').val();
        } else {
            //validacion
            alert('password no coincide');
        }

        console.log(data);

        async_query('async/', 'async_register.php', data, 'reg_user')
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

    //login
    $(document).submit('#formLogin', function(evt) {
        prevent(evt);

        data = {
            user: $('#userLogin').val(),
            pass: $('#passLogin').val()
        };

        console.log(data);
        async_query('async/', 'async_register.php', data, 'login_user')
            .then((response) => {
                var parse = $.parseJSON(response);
                if(parse['STATUS'] == 'ok') {
                    console.log(response);
                    window.location.replace('dashboard.php');
                }
            })
            .fail((Error) => {
                console.log(Error);
            })
    })
})