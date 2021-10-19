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

       
    }
?>