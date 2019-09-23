<head>
    <?php
    error_reporting(0);
    session_start();
    if ($_SESSION["usuario_logado"]) {
        header('Location: Controllers/HorariosController.php');
    }

    include 'Views/BasicView.php';
    $error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_NUMBER_INT);

    ?>
</head>
<style>
    body, html {
        background-image: url('Images/Login.jpg');
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
    }

    .card-container.card {
        max-width: 350px;
        padding: 40px 40px 20px;
    }

    .btn {
        font-weight: 700;
        height: 36px;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
    }

    .card {
        background-color: #F7F7F7;
        padding: 20px 25px 30px;
        margin: 0 auto 25px;
        margin-top: 50px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .profile-img-card {
        width: 96px;
        height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    .form-signin input[type=password],
    .form-signin input[type=text],
    .form-signin button {
        width: 100%;
        display: block;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        border-color: rgb(104, 145, 162);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
    }

    .btn.btn-login {
        background-color: rgb(104, 145, 162);
        padding: 0px;
        font-weight: 700;
        font-size: 14px;
        height: 36px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        -o-transition: all 0.218s;
        -moz-transition: all 0.218s;
        -webkit-transition: all 0.218s;
        transition: all 0.218s;
    }

    .btn.btn-login:hover,
    .btn.btn-login:active,
    .btn.btn-login:focus {
        background-color: rgb(12, 97, 33);
    }
</style>
<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="Images/AgendamentoIcon.png"/>
        <p>
        <form class="form-signin" action="Controllers/LoginController.php" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" name="login" id="login" class="form-control" placeholder="Login" required autofocus>
            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
            <?php if (isset($_SESSION["erro_logado"])) { ?>
                <div class="alert alert-danger" role="alert" align="center">
                    Login ou Senha inválidos
                </div>
            <?php } ?>
            <button class="btn btn-lg btn-primary btn-block btn-login" type="submit">Conectar-se</button>
        </form>
    </div>
</div>