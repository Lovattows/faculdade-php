<?php
error_reporting(0);
session_start();

require_once '../Databases/Database.php';
require_once '../Databases/Debug.php';
require_once '../Databases/ManipulacaoDB.php';
require_once '../Models/ManipulacaoModel.php';

$manipulacao = new ManipulacaoModel();
$action = filter_input(INPUT_GET, 'Action', FILTER_SANITIZE_STRING);

if ($action == 'Now') {
    $manipulacao->now();
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Horários excluidos com sucesso.";
    header('Location: ../Controllers/HorariosController.php');
} else if ($action == 'Month') {
    $manipulacao->month();
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Horários excluidos com sucesso.";
    header('Location: ../Controllers/HorariosController.php');
} else if ($action == 'Year') {
    $manipulacao->year();
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Horários excluidos com sucesso.";
    header('Location: ../Controllers/HorariosController.php');
} else if ($action == 'Past') {
    $manipulacao->past();
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Horários excluidos com sucesso.";
    header('Location: ../Controllers/HorariosController.php');
} else if ($action == 'Future') {
    $manipulacao->future();
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Horários excluidos com sucesso.";
    header('Location: ../Controllers/HorariosController.php');
}