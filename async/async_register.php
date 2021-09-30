<?php 

    require('../config/conexion.php');
    require('../class/Encrypt.class.php');

    $objFunction = new Encrypt();

    if(!empty($_POST) && $_POST['type'] == 'reg_user') {

        $nombre     = $_POST['data']['name'];
        $apellido   = $_POST['data']['lastname'];
        $cedula     = $_POST['data']['cedula'];
        $direccion  = $_POST['data']['direction'];
        $telefono   = $_POST['data']['codeNumber'].'-'.$_POST['data']['number'];
        $user       = $_POST['data']['user'];
        $pass       = $objFunction->encrypt($_POST['data']['password']);

        $sql    = "INSERT INTO users (nombre, apellido, cedula, direccion, telefono, user, password) VALUES ('$nombre','$apellido','$cedula','$direccion','$telefono','$user','$pass')";
        $query  = mysqli_query($con, $sql);

        if($query) {
            die(json_encode(['STATUS' => 'ok']));
        }
    }

    if(!empty($_POST) && $_POST['type'] == 'login_user') {
        $user   = $_POST['data']['user'];
        $pass   = $objFunction->encrypt($_POST['data']['pass']);

        $sql = "SELECT * FROM users WHERE user = '$user' AND password = '$pass'";
        $query  = mysqli_query($con, $sql);
        
        if($query) {
            die(json_encode(['STATUS' => 'ok', 'RESULT' => $query]));
        }
    }

    if(!empty($_POST) && $_POST['type'] == 'log_out') {
        session_destroy();
        header('Location: index.php');
    }

?>