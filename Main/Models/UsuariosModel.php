<?php 
    namespace Main\Models;

    class UsuariosModel
    {
        public static function emailExists($email) {
            $pdo = \Main\MySql::connect();
            $verifica = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
            $verifica->execute(array($email));

            if($verifica->rowCount() == 1) {
                return true;
            }else{
                return false;
            }
        }

        public static function listarComunidade() {
            $pdo = \Main\MySql::connect();

            $comunidade = $pdo->prepare("SELECT * FROM usuarios");

            $comunidade->execute();

            return $comunidade->fetchAll();
        }

        public static function solicitarAmizade($idPara) {
            $pdo = \Main\MySql::connect();

            $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

            $verificaAmizade->execute(array($_SESSION['id'], $idPara, $idPara, $_SESSION['id']));

            if($verificaAmizade->rowCount() == 1) {
                return false;
            }else{
                $insertAmizade = $pdo->prepare("INSERT INTO amizades VALUES (null, ?,?,0)");
                if($insertAmizade->execute(array($_SESSION['id'], $idPara))){
                    return true;
                }
            }

            return true;
        }

        public static function listarAmizadesPendentes() {
            $pdo = \Main\MySql::connect();

            $listarAmizadesPendentes = $pdo->prepare("SELECT * FROM amizades WHERE recebeu = ? AND status = 0");
            $listarAmizadesPendentes->execute(array($_SESSION['id']));
            return $listarAmizadesPendentes->fetchAll();
        }

        public static function getUsuarioById($id) {
            $pdo = \Main\MySql::connect();

            $usuario = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");

            $usuario->execute(array($id));

            return $usuario->fetch();
        }

        public static function existePedidoAmizade($idPara) {
            $pdo = \Main\MySql::connect();

            $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

            $verificaAmizade->execute(array($_SESSION['id'], $idPara, $idPara, $_SESSION['id']));

            if($verificaAmizade->rowCount() == 1) {
                return false;
            }else{
                return true;
            }
        }

        public static function atualizarPedidoAmizade($enviou, $status) {
            $pdo = \Main\MySql::connect();
            if($status == 0) {
                // Recusou o pedido
                $del = $pdo->prepare("DELETE FROM amizades WHERE enviou = ? AND recebeu = ? AND status = 0");
                $del->execute(array($enviou, $_SESSION['id']));

            }else if($status == 1){
                $aceitar = $pdo->prepare("UPDATE amizades SET status = 1 WHERE enviou = ? AND recebeu = ?");
                $aceitar->execute(array($enviou, $_SESSION['id']));

                if($aceitar->rowCount() == 1){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public static function listarAmigos() {
            $pdo = \Main\MySql::connect();

            $amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
            $amizades->execute(array($_SESSION['id'], $_SESSION['id']));

            $amizades = $amizades->fetchAll();
            $amigosConfirmados = array();
            foreach ($amizades as $key => $value) {
                if($value['enviou'] == $_SESSION['id']){
                    $amigosConfirmados[] = $value['recebeu'];
                }else{
                    $amigosConfirmados[] = $value['enviou'];
                }
            }

            $listaAmigos = array();
            
            foreach ($amigosConfirmados as $key => $value) {
                $listaAmigos[$key]['nome'] = self::getUsuarioById($value)['nome'];
                $listaAmigos[$key]['email'] = self::getUsuarioById($value)['email'];
                $listaAmigos[$key]['img'] = self::getUsuarioById($value)['img'];
            }

            return $listaAmigos;
        }
    }
?>