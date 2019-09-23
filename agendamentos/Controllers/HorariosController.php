<?php
error_reporting(0);
session_start();
require_once '../Databases/Database.php';
require_once '../Databases/Debug.php';
require_once '../Databases/InformacoesDB.php';
require_once '../Models/InformacoesModel.php';
require_once '../Databases/ClientesDB.php';
require_once '../Models/ClientesModel.php';
require_once '../Databases/AgendamentoDB.php';
require_once '../Models/AgendamentoModel.php';

$informacoes = new InformacoesModel();
$cliente = new ClientesModel();
$agendamento = new AgendamentoModel();

$_SESSION['dados_horarios'] = $informacoes->consultarAgendamentos();
header('Location: ../Views/ListarHorariosView.php');

$action = filter_input(INPUT_GET, 'Action', FILTER_SANITIZE_STRING);

if ($action == 'Present') {
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->id_agendamento = $id;
    $agendamento->confirmarPresenca();
    $agendamento->id_agendamento = "";
    $_SESSION["tipo_msg"] = "primary";
    $_SESSION["msg"] = "Cliente presente no horário ID <strong>" . $id . "</strong>.";
    $_SESSION['dados_horarios'] = $informacoes->consultarAgendamentos();
    header('Location: ../Views/ListarHorariosView.php');
} else if ($action == 'Absent') {
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->id_agendamento = $id;
    $agendamento->confirmarAusencia();
    $agendamento->id_agendamento = "";
    $_SESSION["tipo_msg"] = "primary";
    $_SESSION["msg"] = "Cliente ausente no horário ID <strong>" . $id . "</strong>.";
    $_SESSION['dados_horarios'] = $informacoes->consultarAgendamentos();
    header('Location: ../Views/ListarHorariosView.php');
}

