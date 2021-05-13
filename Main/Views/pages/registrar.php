<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Rede Social</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/style.css">
</head>
<body>
    <div class="sidebar"></div>

    <div class="form-container-login">
        <div class="logo-chamada-login">
            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/logodanki.svg" alt="Logo">
            <p>Conecte-se com seus amigos e expanda seus aprendizados com a rede social Danki Code.</p>
        </div>

        <div class="form-login">
            <h3 style="text-align:center;">Crie sua Conta!</h3>
            <form method="post" action="">
                <input type="text" name="nome" placeholder="Nome...">
                <input type="text" name="email" placeholder="E-mail...">
                <input type="password" name="senha" placeholder="Senha...">
                <input type="submit" name="acao" value="Crira Conta!">
                <input type="hidden" name="registrar" value="registrar">
            </form>
        </div>
    </div>
</body>
</html>