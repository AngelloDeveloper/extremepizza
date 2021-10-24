<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/pedido.class.php');
    require '../vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;

    //object
    $objPedido = new Pedido();
    $arrPedido = $objPedido->getPedido($_GET['idorden']);
    $totalPagar = 0;
    $css = "
        <style>
            .items {
                margin: 0px;
                padding: 0px;
            }

            h1 {
                margin: 0px;
                padding: 20px !important;
                background-color: #7E2828;
                color: white;
                width: 100%;
            }

            h3 {
                margin: 0px;
                padding: 0px;
            }
        </style>
    "; 

    $template = $css;

    $template .= '<h1>ExtremePizza</h1><br /><br />';
    $template .= '<h3>Voucher Emisión de Orden</h3>';
    $template .= '<h6>Fecha: '.$arrPedido[0]['fecha'].'</h6><br /><hr />';
    
    foreach($arrPedido as $index => $pedido) {
        $menu = $pedido['menu'];
        $menuPrecio = $pedido['menu_precio'];
        $menuDescripcion = $pedido['menu_descripcion'];
        $cantidad = $pedido['cantidad'];
        $total = $pedido['precioTotal'];
        $presentacion = $pedido['presentacion'];
        $presentacionValor = $pedido['presentacion_valor'];
        $divisa = $pedido['divisa'];
        $divisaSimbolo = $pedido['divisa_simbolo']; 

        $template .= '
            <h4>Pedidio: '.$menu.'</h4>

            <p class="items">Descripción: '.$menuDescripcion.'</p>
            <p class="items">Cantidad: '.$cantidad.'</p>
            <p class="items">Presentación: '.$presentacion.'</p>
            <p class="items">Moneda a Pagar: '.$divisa.'</p>
            <p class="items">Precio por Unidad: '.$menuPrecio.' '.$divisaSimbolo.'</p>
            <p class="items">Precio por Presentacion: '.$presentacionValor.' '.$divisaSimbolo.'</p>
            <br />
            <b><p class="items">Precio Total: '.$total.' '.$pedido['divisa_simbolo'].'</p></b>
        ';

        if($index != count($arrPedido) - 1) {
            // Este código se ejecutará para todos menos el último
            $template .= "
                <br />
                <hr />
                <br />
            ";
        }

        $totalPagar += $total;
    }
    $template .= '<br/><b><h4>Total a Pagar: '.$totalPagar.' '.$arrPedido[0]['divisa_simbolo'].'</h4></b>';

    $html2pdf = new Html2Pdf('P','A4');
    $html2pdf->writeHTML($template);
    $html2pdf->output();
?>
