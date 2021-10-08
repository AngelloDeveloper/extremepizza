<?php 
    class Conexion {
        //properties
        private $host = 'localhost';
        private $users = 'root';
        private $password = '';
        private $db = '0xtremepizza_db';
        
        //methods
        public function conexion() {
            $con = mysqli_connect($this->host,$this->users,$this->password, $this->db);
            $conect = mysqli_select_db($con, $this->db);

            return $con;
        }
    }
?>