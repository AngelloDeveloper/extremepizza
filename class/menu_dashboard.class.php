<?php 
    class menu_dashboard extends Conexion {
        //properties
        private $query;
        private $result;
        private $con;
        private $sql;

        //methods
        public function __construct() {
            $this->con = $this->conexion();
        }

        public function getMenu() {
            $this->sql = "SELECT * FROM menu_dashboard";
            $this->query = mysqli_query($this->con, $this->sql);
            while($row = mysqli_fetch_assoc($this->query)) {
                $rows[] = $row;
            }
            //$this->result = mysqli_fetch_assoc($this->query);

            return $rows;
        }
    }
?>