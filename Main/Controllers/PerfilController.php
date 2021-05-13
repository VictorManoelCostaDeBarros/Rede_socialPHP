<?php 
    namespace Main\Controllers;

    class PerfilController
    {
        public function index(){
            if(isset($_SESSION['login'])){
                
                if(isset($_POST['atualizar'])) {
                    $pdo = \Main\MySql::connect();
                    $nome = strip_tags($_POST['nome']);
                    $senha = $_POST['senha'];

                    if($nome == '') {
                        \Main\Utilidades::alerta('Você precisa inserir um nome para atualizar!');
                        \Main\Utilidades::redirect(INCLUDE_PATH.'perfil');
                    }

                    if($senha != '') {
                        $senha = \Main\Bcrypt::hash($senha);
                        $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?");
                        $atualizar->execute(array($nome, $senha, $_SESSION['id']));
                        $_SESSION['nome'] = $nome;
                    } else {
                        $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
                        $atualizar->execute(array($nome, $_SESSION['id']));
                        $_SESSION['nome'] = $nome;
                    }

                    if($_FILES['file']['tmp_name'] != '') {
                        $file = $_FILES['file'];
                        $fileExt = explode('.', $file['name']);
                        $fileExt = $fileExt[count($fileExt) - 1];
                        if($fileExt == 'png' || $fileExt == 'jpg' || $fileExt == 'jpeg') {
                            // formato valido
                            // validar o tamanho
                            $size = intval($file['size'] / 1024);
                            if($size <= 600) {
                                $udniqid = uniqid().'.'.$fileExt;
                                $atualizaImagem = $pdo->prepare("UPDATE usuarios SET img = ? WHERE id = ?");
                                $atualizaImagem->execute(array($udniqid, $_SESSION['id']));
                                move_uploaded_file($file['tmp_name'], 'C:\xampp\htdocs\RedeSocial/uploads/'.$udniqid);
                                $_SESSION['img'] = $udniqid;
                                \Main\Utilidades::alerta('Seu perfil foi atualizado junto com a foto!');
                                \Main\Utilidades::redirect(INCLUDE_PATH.'perfil');
                            } else {
                                \Main\Utilidades::alerta('Tamanho da imagem superior a 300kb!');
                                \Main\Utilidades::redirect(INCLUDE_PATH.'perfil');
                            }
                        }else{
                            \Main\Utilidades::alerta('Formato não compátivel!');
                            \Main\Utilidades::redirect(INCLUDE_PATH.'perfil');
                        }
                    }

                    Main\Utilidades::alerta('Seu perfil foi atualizado com sucesso!');
                    \Main\Utilidades::redirect(INCLUDE_PATH.'perfil');
                }

                \Main\Views\MainView::render('perfil');
            }else{
                \Main\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>