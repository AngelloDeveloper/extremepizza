<?php 
    session_start();
    require('../class/conexion.class.php');
    require_once '../assets/mpdf/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->Output();
?>