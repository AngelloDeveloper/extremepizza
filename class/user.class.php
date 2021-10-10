<?php 
    class User extends Conexion {
        
        //properties
        private $nombre;
        private $apellido;
        private $email;
        private $telefono;
        private $direccion;
        private $id_user;
        private $cedula;
        private $users;
        private $pass;
        private $imagen;
        private $status;
        private $privilegios;
        private $type_user;
        private $sql;
        private $query; 
        private $con;

        public function __construct($arrData='') {
            $this->nombre       = !empty($arrData['nombre']) ? $arrData['nombre'] : '';
            $this->apellido     = !empty($arrData['apellido']) ? $arrData['apellido'] : '';
            $this->email        = !empty($arrData['email']) ? $arrData['email'] : '';
            $this->telefono     = !empty($arrData['telefono']) ? $arrData['telefono'] : '';
            $this->direccion    = !empty($arrData['direccion']) ? $arrData['direccion'] : '';
            $this->id_user      = !empty($arrData['id_user']) ? $arrData['id_user'] : '';
            $this->cedula       = !empty($arrData['cedula']) ? $arrData['cedula'] : '';
            $this->users        = !empty($arrData['users']) ? $arrData['users'] : '';
            $this->pass         = !empty($arrData['pass']) ? $this->encrypt($arrData['pass']) : '';
            $this->imagen       = !empty($arrData['imagen']) ? $arrData['imagen'] : '';
            $this->status       = !empty($arrData['status']) ? $arrData['status'] : '';
            $this->privilegios  = !empty($arrData['privilegios']) ? $arrData['privilegios'] : '';
            $this->type_user    = !empty($arrData['type_user']) ? $arrData['type_user'] : '';
            $this->con          = $this->conexion();
        }

        //methods

        public function validation_data($puntero='') {
            $indicator = '';
            switch ($puntero) {
                case 'cliente':
                    $indicator = 'cedula';

                    $this->sql = "SELECT 
                            *
                        FROM
                            cliente
                        WHERE
                            cedula = '$this->cedula'
                    ";

                    $this->query = mysqli_query($this->con, $this->sql);
                    $this->result = mysqli_fetch_assoc($this->query);
                    if($this->result) {
                        return json_encode([
                            'STATUS' => 'EXIST',
                            'ERROR_DATA' => $indicator
                        ]);
                    } else {
                        $indicator = 'email';

                        $this->sql = "SELECT 
                                *
                            FROM
                                cliente
                            WHERE
                                email = '$this->email'
                        ";

                        $this->query = mysqli_query($this->con, $this->sql);
                        $this->result = mysqli_fetch_assoc($this->query);
                        if($this->result) {
                            return json_encode([
                                'STATUS' => 'EXIST',
                                'ERROR_DATA' => $indicator
                            ]);
                        } else {
                            return json_encode(['STATUS' => 'ok']);
                        }
                    }
                break;
                case 'user':
                    $indicator = 'user';
                    $this->sql = "SELECT 
                            *
                        FROM
                            users
                        WHERE
                            user = '$this->users'
                    ";

                    $this->query = mysqli_query($this->con, $this->sql);
                    $this->result = mysqli_fetch_assoc($this->query);
                    if($this->result) {
                        return json_encode([
                            'STATUS' => 'EXIST',
                            'ERROR_DATA' => $indicator
                        ]);
                    } else {
                        return json_encode(['STATUS' => 'ok']);
                    }
                break;
            }
        }

        public function Register() {
            $this->sql = "INSERT INTO 
                users (
                    user, 
                    password, 
                    imagen, 
                    status, 
                    privilegios, 
                    id_type_user
                ) 
            VALUES (
                '$this->users',
                '$this->pass',
                '$this->imagen',
                '$this->status',
                '$this->privilegios',
                '$this->type_user'
            )";

            $this->query    = mysqli_query($this->con, $this->sql);
            $this->id_user  = mysqli_insert_id($this->con);

            if($this->query) {
                $this->sql  = "INSERT INTO 
                    cliente (nombre, apellido, email, telefono, direccion, id_user, cedula) 
                VALUES ('$this->nombre','$this->apellido','$this->email','$this->telefono','$this->direccion','$this->id_user','$this->cedula')";
                
                $this->query  = mysqli_query($this->con, $this->sql);
                if($this->query) {
                    return json_encode(['STATUS' => 'ok']);
                }
            }
        }

        public function Login() {

            $this->sql = "SELECT 
                cliente.nombre as nombre,
                cliente.apellido as apellido, 
                cliente.email as email, 
                cliente.telefono as telefono, 
                cliente.direccion as direccion, 
                cliente.cedula as cedula,
                users.id as id,
                users.user as user,
                users.imagen as imagen,
                users.privilegios as privilegios,
                users.status as status,
                users.id_type_user as userType
            FROM 
                users 
                LEFT JOIN cliente ON users.id = cliente.id_user
            WHERE user = '$this->users' AND password = '$this->pass'";
            
            $this->query  = mysqli_query($this->con, $this->sql);
            $this->result = mysqli_fetch_assoc($this->query);
        
            if($this->result) {
                $this->session($this->result);
                return ['STATUS' => 'ok'];
            }       
        }

        public function Logout() {
            $this->sessionDestroy();
        }

        public function session($result=null) {
            session_start();
            
            foreach($result as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }

        public function sessionDestroy() {
            session_start();
            session_destroy();
            header('Location: ../index.php');
        }

        public function encrypt($value=null) {
            return hash('sha256', "1NsT3pD3veL0p3R$" . $value);
        }
    }
?>