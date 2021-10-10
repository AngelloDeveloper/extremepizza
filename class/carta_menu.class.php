<?php 
    class carta_menu extends Conexion {
        //propesties
        private $con;
        private $sql;
        private $query;
        private $result;

        //methods
        public function __construct() {
            $this->con = $this->conexion();
        }

        public function getAllCartaMenu() {
            $this->sql = "SELECT * FROM carta_menu WHERE status = 'Y'";
            $this->query = mysqli_query($this->con, $this->sql);
            while($row = mysqli_fetch_assoc($this->query)) {
                $rows[] = $row;
            }

            return $rows;
        }

        public function getCartaMenu($id) {
            $this->sql = "SELECT * FROM carta_menu WHERE id_menu = '$id' AND status = 'Y'";
            $this->query = mysqli_query($this->con, $this->sql);
            $row =mysqli_fetch_assoc($this->query);
            
            return $row;
        }
    }
?>