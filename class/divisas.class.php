<?php 
    class Divisas extends Conexion {
        //properties
        private $query;
        private $result;
        private $sql;
        private $con;
        //methods

        public function __construct() {
            $this->con = $this->conexion(); 
        }

        public function getAllDivisas() {
            $this->sql = "SELECT * FROM divisas";
            $this->query = mysqli_query($this->con, $this->sql);
            while($row = mysqli_fetch_assoc($this->query)) {
                $rows[] = $row;
            }

            return $rows;
        }
    }
?>