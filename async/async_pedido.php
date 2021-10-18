<?php 
    session_start();
    require('../class/conexion.class.php');
    require('../class/pedido.class.php');

    if(!empty($_POST) && $_POST['type'] == 'setPedido') {
        $objPedido = new Pedido([
            'pedidos' => $_POST['data']['pedido'],
            'divisa'  => $_POST['data']['divisa'],
            'iduser'  => $_SESSION['id']
        ]);

        $idOrden = $objPedido->setOrden();
        $result = $objPedido->setPedido($idOrden);
        die(json_encode($result));
    }
?>