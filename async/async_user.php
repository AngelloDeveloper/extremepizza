<?php 

    require('../class/conexion.class.php');
    require('../class/user.class.php');

    if(!empty($_POST) && $_POST['type'] == 'validation_data') {
        $objUser = new User([
            'email'         => !empty($_POST['data']['email'])  ? $_POST['data']['email'] : '',
            'cedula'        => !empty($_POST['data']['cedula']) ? $_POST['data']['cedula'] : '',
            'users'          => !empty($_POST['data']['user']) ? $_POST['data']['user'] : ''
        ]);

        $result = $objUser->validation_data($_POST['data']['puntero']);
        die($result);
    }


    if(!empty($_POST) && $_POST['type'] == 'reg_user') {
        $objUser = new User([
            'nombre'        => $_POST['data']['name'],
            'apellido'      => $_POST['data']['lastname'],
            'email'         => $_POST['data']['email'],
            'telefono'      => $_POST['data']['codeNumber'].'-'.$_POST['data']['number'],
            'direccion'     => $_POST['data']['direction'],
            'id_user'       => '',
            'cedula'        => $_POST['data']['cedula'],
            'users'         => $_POST['data']['user'],
            'pass'          => $_POST['data']['password'],
            'imagen'        => '',
            'status'        => '1',
            'privilegios'   => '',
            'type_user'     => '3'
        ]);

        $result = $objUser->Register();
        die($result);
    }

    if(!empty($_POST) && $_POST['type'] == 'login_user') {

        $objUser = new User([
            'users' => $_POST['data']['user'],
            'pass'  => $_POST['data']['pass']
        ]);

        $result = $objUser->login();
        die(json_encode($result));
    }

    if(!empty($_REQUEST) && $_REQUEST['type'] == 'log_out') {
        $objUser->Logout();
    }

?>