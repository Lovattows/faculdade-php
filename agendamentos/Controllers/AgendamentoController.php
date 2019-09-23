<?php
error_reporting(0);
session_start();

require_once '../Databases/Database.php';
require_once '../Databases/Debug.php';
require_once '../Databases/AgendamentoDB.php';
require_once '../Models/AgendamentoModel.php';
require_once '../Databases/InformacoesDB.php';
require_once '../Models/InformacoesModel.php';

$agendamento = new AgendamentoModel();
$informacoes = new InformacoesModel();

$action = filter_input(INPUT_GET, 'Action', FILTER_SANITIZE_STRING);

if ($action == 'Add') {
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
    $data_new = str_replace('/', '-', $data);
    $data_formatada = date("Y-m-d", strtotime($data_new));
    $agendamento->id_cli = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->id_esporte = filter_input(INPUT_POST, 'esporte', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->id_horario = filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->id_quadra = filter_input(INPUT_POST, 'quadra', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->data = $data_formatada;
    $agendamento->valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);
    if ($agendamento->salvar()) {
        $_SESSION["msg"] = "Horário marcado com sucesso.";
        $_SESSION["tipo_msg"] = "success";
        $_SESSION['dados_horarios'] = $informacoes->consultarAgendamentos();
        header('Location: ../Views/ListarHorariosView.php');
    }
} else if ($action == 'Delete') {
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->id_agendamento = $id;
    $agendamento->excluir();
    $agendamento->id_agendamento = "";
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Horário ID <strong>" . $id . "</strong> excluido com sucesso.";
    $_SESSION['dados_horarios'] = $informacoes->consultarAgendamentos();
    header('Location: ../Views/ListarHorariosView.php');
} 

