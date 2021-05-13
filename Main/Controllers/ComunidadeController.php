<?php 
    namespace Main\Controllers;

    class ComunidadeController
    {
        public function index(){
            if(isset($_SESSION['login'])){
                if(isset($_GET['solicitarAmizade'])){
                    $idPara = (int) $_GET['solicitarAmizade'];
                    if(\Main\Models\UsuariosModel::solicitarAmizade($idPara)){
                        \Main\Utilidades::alerta('Amizade Solicitada com sucesso!');
                        \Main\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }else{
                        \Main\Utilidades::alerta('Ocorreu um erro ao solicitar a amizade...');
                        \Main\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }
                }

                \Main\Views\MainView::render('comunidade');
            }else{
                \Main\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>