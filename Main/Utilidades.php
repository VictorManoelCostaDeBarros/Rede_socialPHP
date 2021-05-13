<?php 
    namespace Main;

    class Utilidades {

        public static function redirect($url) {
            echo '<script>window.location.href="'.$url.'"</script>';
            die();
        }

        public static function alerta($messagem) {
            echo '<script>alert("'.$messagem.'")</script>';
        }

    }
?>