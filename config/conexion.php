<?php 
    $arrConect = [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'db'   => '0xtremepizza_db' 
    ];

    $con = mysqli_connect($arrConect['host'],$arrConect['user'],$arrConect['pass']);
    $conect = mysqli_select_db($con, $arrConect['db']);
?>