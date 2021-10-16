<?php
    class Pedido extends Conexion {
        //properties
        //methods

        public function __construct($arrData='') {
            $this->data = !empty($arrData['data']) ? $arrData['data'] : '';
            $this->con  = $this->conexion();
        }

        public function setPedido() {
            foreach($this->data as $data) {
               
            
                //$this->query  = mysqli_query($this->con, $this->sql);
                //$this->result = mysqli_fetch_assoc($this->query);

                /*his->sql = "INSERT INTO 
                    pedidos (
                        fecha, 
                        domicilio, 
                        id_menu, 
                        id_presentacion, 
                        id_user, 
                        precio_total,
                        cantidad,
                        divisa
                    ) 
                    VALUES (
                        NOW(),
                        $data['']
                    )";*/

                //$this->query    = mysqli_query($this->con, $this->sql);
            }
        }

        /*public getPedidos() {
            $this->sql = "SELECT 
                *
            FROM 
                carta_menu 
                LEFT JOIN cliente ON users.id = cliente.id_user
            WHERE user = '$this->users' AND password = '$this->pass'";
        }*/
    }
?>