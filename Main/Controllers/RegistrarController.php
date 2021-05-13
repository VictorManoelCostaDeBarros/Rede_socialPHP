<?php 
    namespace Main\Controllers;

    class RegistrarController
    {
        public function index() {

            if(isset($_POST['registrar'])){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    \Main\Utilidades::alerta('E-mail Inválido.');
                    \Main\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }else if(strlen($senha) < 6) {
                    \Main\Utilidades::alerta('Sua senha é muito curta.');
                    \Main\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }else if(\Main\Models\UsuariosModel::emailExists($email)){
                    \Main\Utilidades::alerta('E-mail Já existe.');
                    \Main\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }else{
                    // Registar o usuario.
                    $senha = \Main\Bcrypt::hash($senha);

                    $registro = \Main\MySql::connect()->prepare("INSERT INTO usuarios VALUES (null, ?, ?, ?,'')");
                    $registro->execute(array($nome, $email, $senha));

                    \Main\Utilidades::alerta('Usuário cadastrado com sucesso!');
                    \Main\Utilidades::redirect(INCLUDE_PATH);
                }
            }
            
            \Main\Views\MainView::render('registrar');

        }
    }
?>