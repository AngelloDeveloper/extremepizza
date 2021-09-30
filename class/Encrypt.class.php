<?php 
    class Encrypt {

        public function encrypt($value=null) {
            return hash('sha256', "1NsT3pD3veL0p3R$" . $value);
        }

    }
?>