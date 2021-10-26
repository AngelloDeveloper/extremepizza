<?php 
    class UserType extends Conexion {

        //properties
        private $con;
        private $result;

        //methods
        public function __construct($arrData='') {
            $this->con          = $this->conexion();
        }

        public function getUserType() {
            $this->sql = "SELECT * FROM tipo_users";
            $this->query = mysqli_query($this->con, $this->sql);
            while($row = mysqli_fetch_assoc($this->query)) {
                $rows[] = $row;
            }

            foreach($rows as $index => $value) {
                $this->result[$value['id_type_user']] = $value;
            }

            return $this->result;
        }

    }
?>