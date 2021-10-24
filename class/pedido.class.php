<?php
    class Pedido extends Conexion {
        //properties
        private $divisa;
        private $data;
        private $con;
        private $iduser;
        private $idmenu;
        private $id_presentacion;
        private $id_user;
        private $precio_total;
        private $cantidad;
        private $arrPedidos;
        private $arrPedidosText;
        private $idorden;
        //methods

        public function __construct($arrData='') {
            $this->data = !empty($arrData['pedidos']) ? $arrData['pedidos'] : '';
            $this->divisa = !empty($arrData['divisa']) ? $arrData['divisa'] : '';
            $this->iduser = !empty($arrData['iduser']) ? $arrData['iduser'] : '';
            $this->con  = $this->conexion();
        }

        public function setPedido($idOrden) {

            $this->idorden = $idOrden;

            foreach($this->data as $index => $pedido) {

                $this->idmenu = $pedido['idmenu'];
                $this->id_presentacion = $pedido['presentacion'];
                $this->precio_total = $pedido['total'];
                $this->cantidad = $pedido['cantidad'];
                
                $this->sql = "INSERT INTO 
                    pedidos ( 
                        id_menu, 
                        id_presentacion,  
                        precio_total, 
                        divisa,
                        cantidad,
                        id_orden
                    ) 
                VALUES (
                    '$this->idmenu',
                    '$this->id_presentacion',
                    '$this->precio_total',
                    '$this->divisa',
                    '$this->cantidad',
                    '$this->idorden'
                )";

                $this->query = mysqli_query($this->con, $this->sql);
            }

            if($this->query) {
                return [
                    'STATUS' => 'ok',
                    'RESULT' => $this->idorden
                ];
            }
        }

        public function setOrden() {
            $this->sql = "INSERT INTO 
                orden ( 
                    fecha, 
                    id_user
                ) 
            VALUES (
                NOW(),
                '$this->iduser'
            )";

            $this->query = mysqli_query($this->con, $this->sql);
            $this->idorden = mysqli_insert_id($this->con);

            return $this->idorden;
        }

        public function getPedido($idOrden='') {
            $this->sql = "SELECT 
                        pedidos.id_pedido as idPedido,
                        pedidos.cantidad as cantidad,
                        pedidos.precio_total as precioTotal,
                        orden.fecha as fecha,
                        carta_menu.menu as menu,
                        carta_menu.descripcion as menu_descripcion,
                        carta_menu.precio as menu_precio,
                        presentacion.presentacion as presentacion,
                        presentacion.descripcion as presentacion_descripcion,
                        presentacion.valor_agregado as presentacion_valor,
                        divisas.divisa as divisa,
                        divisas.simbolo as divisa_simbolo
                    FROM pedidos
                    LEFT JOIN orden ON pedidos.id_orden = orden.id_orden
                    LEFT JOIN carta_menu ON pedidos.id_menu = carta_menu.id_menu
                    LEFT JOIN presentacion ON pedidos.id_presentacion = presentacion.id_presentacion
                    LEFT JOIN divisas ON pedidos.divisa = divisas.id_divisa
                    WHERE pedidos.id_orden = {$idOrden}     
            ";

            $this->query = mysqli_query($this->con, $this->sql);
            while($row = mysqli_fetch_assoc($this->query)) {
                $rows[] = $row;
            }

            return $rows;
        }

       
    }
?>