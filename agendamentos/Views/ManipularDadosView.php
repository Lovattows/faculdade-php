<?php
session_start();
error_reporting(0);
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set("Brazil/East");

$hoje = date('d/m/Y');
$mes = ucfirst(strftime('%B', strtotime('today')));
$ano = date('Y');
?>
<head>
    <?php include '../Views/BasicView.php'; ?>
</head>
<h2 class="text-center">Excluir dados da quadra LVTDA.</h2>
<h5 class="text-center">
    <button class="btn btn-dark btn-lg" id="agendamentos">Agendamentos</button>
</h5>
<h5 class="text-center">
    <div id="row_agendamentos" hidden>
        <a href="../Controllers/ManipulacaoController.php?Action=Now"
           onClick="return confirm('Deseja excluir os horários do dia atual?');">
            <button class="btn btn-dark btn-lg" id="hoje">Hoje (<?= $hoje; ?>)</button>
        </a>
        <a href="../Controllers/ManipulacaoController.php?Action=Month"
           onClick="return confirm('Deseja excluir os horários do mês atual?');">
            <button class="btn btn-dark btn-lg" id="mes">Mês (<?= $mes; ?>)</button>
        </a>
        <a href="../Controllers/ManipulacaoController.php?Action=Year"
           onClick="return confirm('Deseja excluir os horários deste ano?');">
            <button class="btn btn-dark btn-lg" id="ano">Ano (<?= $ano; ?>)</button>
        </a>
        <a href="../Controllers/ManipulacaoController.php?Action=Past"
           onClick="return confirm('Deseja excluir os horários passados?');">
            <button class="btn btn-dark btn-lg" id="passado">Passados</button>
        </a>
        <a href="../Controllers/ManipulacaoController.php?Action=Future"
           onClick="return confirm('Deseja excluir os horários futuros?');">
            <button class="btn btn-dark btn-lg" id="futuro">Futuros</button>
        </a>
    </div>
</h5>
<div align="center">
    <a href="../Controllers/HorariosController.php">Voltar</a>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#agendamentos').click(function () {
            $("#agendamentos").prop('disabled', true);
            $("#row_agendamentos").attr("hidden", false);
        });
    });
</script>