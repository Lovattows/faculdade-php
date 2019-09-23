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

if ($action == 'Consult') {
    $data = filter_input(INPUT_GET, 'Data', FILTER_SANITIZE_STRING);
    $data_new = str_replace('/', '-', $data);
    $data_formatada = date("Y-m-d", strtotime($data_new));
    $agendamento->id_horario = filter_input(INPUT_GET, 'Horario', FILTER_SANITIZE_NUMBER_INT);
    $agendamento->data = $data_formatada;
    $lista = $agendamento->consultar();
    echo '<select class="js-example-basic-single" name="quadra" style="width:25%" required>
          <option value="" selected="true" disabled="disabled">--- Selecione ---</option>';
    for ($i = 0; $i < count($lista); $i++) {
        echo '<option value="' . $lista[$i]["id_quadra"] . '">' . $lista[$i]["nome"] . '</option>';
    }
    '</select>';
}
