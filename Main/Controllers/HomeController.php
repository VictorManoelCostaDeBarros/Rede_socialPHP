<?php
	
	namespace Main\Controllers;

	class HomeController{


		public function index(){

			if(isset($_GET['loggout'])){
				session_unset();
				session_destroy();

				\Main\Utilidades::redirect(INCLUDE_PATH);
			}


			if(isset($_SESSION['login'])){

				// Existe pedido de amizade.
				if(isset($_GET['recusarAmizade'])){
					$idEnviou = (int) $_GET['recusarAmizade'];
					\Main\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou, 0);
					\Main\Utilidades::alerta('Amizade recusada!');
					\Main\Utilidades::redirect(INCLUDE_PATH);
				}else if(isset($_GET['aceitarAmizade'])) {
					$idEnviou = (int) $_GET['aceitarAmizade'];
					if(\Main\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou, 1)){
						\Main\Utilidades::alerta('Amizade aceita!');
						\Main\Utilidades::redirect(INCLUDE_PATH);
					}else{
						\Main\Utilidades::alerta('Ops... um erro ocorreu!');
						\Main\Utilidades::redirect(INCLUDE_PATH);
					}	
				}

				// existe postagem no feed.
				if(isset($_POST['post_feed'])) {
					if($_POST['post_content'] == ''){
						\Main\Utilidades::alerta('Não permitimos posts vazio!');
						\Main\Utilidades::redirect(INCLUDE_PATH);
					}

					\Main\Models\HomeModel::postFeed($_POST['post_content']);
					\Main\Utilidades::alerta('Post feito com sucesso!');
					\Main\Utilidades::redirect(INCLUDE_PATH);
				}

				//Renderiza a home do usuário.
				\Main\Views\MainView::render('home');
			}else{
				//Renderizar para criar conta.

				if(isset($_POST['login'])){
					$login = $_POST['email'];
					$senha = $_POST['senha'];

					

					//Verificar no banco de dados.

					$verifica = \Main\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
					$verifica->execute(array($login));



					
					if($verifica->rowCount() == 0){
						//Não existe o usuário!
						\Main\Utilidades::alerta('Não existe nenhum usuário com este e-mail...');
						\Main\Utilidades::redirect(INCLUDE_PATH);
					}else{
						$dados = $verifica->fetch();
						$senhaBanco = $dados['senha'];
						if(\Main\Bcrypt::check($senha,$senhaBanco)){
							//Usuário logado com sucesso
							$_SESSION['login'] = $dados['email'];
							$_SESSION['id'] = $dados['id'];
							$_SESSION['nome'] = explode(' ',$dados['nome'])[0];
							$_SESSION['img'] = $dados['img'];
							\Main\Utilidades::alerta('Logado com sucesso!');
							\Main\Utilidades::redirect(INCLUDE_PATH);
						}else{
							\Main\Utilidades::alerta('Senha incorreta....');
							\Main\Utilidades::redirect(INCLUDE_PATH);
						}
					}
					

				}

				\Main\Views\MainView::render('login');
			}

		}

	}

?>