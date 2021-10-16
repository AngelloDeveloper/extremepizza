<?php 
    require('../class/conexion.class.php');
    require('../class/pedido.class.php');

    if(!empty($_POST) && $_POST['type'] == 'setPedido') {
        $objPedido = new Pedido([
            'data' => $_POST['data'],
        ]);

        $objPedido->setPedido();
    }
?>