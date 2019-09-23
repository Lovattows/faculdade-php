<?php
error_reporting(0);
session_start();

require_once '../Databases/Database.php';
require_once '../Databases/Debug.php';
require_once '../Databases/UsuarioDB.php';
require_once '../Models/UsuarioModel.php';

$usuario = new UsuarioModel();

$usuario->login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$usuario->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$logout = filter_input(INPUT_GET, 'Logout', FILTER_SANITIZE_NUMBER_INT);

if ($usuario->consultar()) {
    $_SESSION["usuario_logado"] = $usuario->login;
    require_once '../Controllers/HorariosController.php';
} else {
    $_SESSION["erro_logado"] = true;
    header('Location: ../index.php');
}
if ($logout) {
    session_destroy();
    header('Location: ../index.php');
}
