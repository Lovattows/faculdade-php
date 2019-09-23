<?php
session_start();
error_reporting(0);
require_once '../Databases/Debug.php';
require_once '../Databases/Database.php';
require_once '../Databases/RankingDB.php';
require_once '../Models/RankingModel.php';

$ranking = new RankingModel();

?>
<head>
    <?php include '../Views/BasicView.php'; ?>
</head>
<h2 class="text-center">Rankings da quadra LVTDA.</h2>
<h5 class="text-center">
    <button class="btn btn-dark btn-lg" id="quadras">Quadras</button>
    <button class="btn btn-dark btn-lg" id="esportes">Esportes</button>
    <button class="btn btn-dark btn-lg" id="clientes">Clientes</button>
    <button class="btn btn-dark btn-lg" id="horarios">Horários</button>
    <button class="btn btn-dark btn-lg" id="turnos">Turnos</button>
    <button class="btn btn-dark btn-lg" id="agendamentos">Agendamentos</button>
</h5>
<div class="container" id="div_quadras">
    <div class="table-responsive">
        <table class="cell-border datatable">
            <thead>
            <tr>
                <th style="width: 200px;">Quantidade Agendados</th>
                <th>Nome da Quadra</th>
                <th style="width: 120px;">Valor Total</th>
                <th style="width: 120px;">Média de Valor</th>
                <th style="width: 150px;">Total de presenças</th>
                <th style="width: 150px;">Total de ausências</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ranking->listarQuadras() as $rankings_quadras) { ?>
            <tr class="table-light">
                <td><?= $rankings_quadras['vezes']; ?></td>
                <td><?= $rankings_quadras['nome']; ?></td>
                <td><?= number_format($rankings_quadras['valor_total'], 2); ?></td>
                <td><?= number_format($rankings_quadras['media_valor'], 2); ?></td>
                <td><?= $rankings_quadras['presente']; ?></td>
                <td><?= $rankings_quadras['ausente']; ?></td>

            </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>
</div>
<div class="container" id="div_esportes">
    <div class="table-responsive">
        <table class="cell-border datatable">
            <thead>
            <tr>
                <th style="width: 200px;">Quantidade Agendados</th>
                <th>Nome do Esporte</th>
                <th style="width: 120px;">Valor Total</th>
                <th style="width: 120px;">Média de Valor</th>
                <th style="width: 150px;">Total de presenças</th>
                <th style="width: 150px;">Total de ausências</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ranking->listarEsportes() as $rankings_esportes) { ?>
            <tr class="table-light">
                <td><?= $rankings_esportes['vezes']; ?></td>
                <td><?= $rankings_esportes['nome']; ?></td>
                <td><?= number_format($rankings_esportes['valor_total'], 2); ?></td>
                <td><?= number_format($rankings_esportes['media_valor'], 2); ?></td>
                <td><?= $rankings_esportes['presente']; ?></td>
                <td><?= $rankings_esportes['ausente']; ?></td>

            </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>
</div>
<div class="container" id="div_clientes">
    <div class="table-responsive">
        <table class="cell-border datatable">
            <thead>
            <tr>
                <th style="width: 150px;">Horários Marcados</th>
                <th style>Nome do Cliente</th>
                <th style="width: 120px;">Valor Total</th>
                <th style="width: 120px;">Média de Valor</th>
                <th style="width: 150px;">Total de presenças</th>
                <th style="width: 150px;">Total de ausências</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ranking->listarClientes() as $rankings_clientes) { ?>
            <tr class="table-light">
                <td><?= $rankings_clientes['vezes']; ?></td>
                <td><?= $rankings_clientes['nome']; ?></td>
                <td><?= number_format($rankings_clientes['valor_total'], 2); ?></td>
                <td><?= number_format($rankings_clientes['media_valor'], 2); ?></td>
                <td><?= $rankings_clientes['presente']; ?></td>
                <td><?= $rankings_clientes['ausente']; ?></td>

            </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>
</div>
<div class="container" id="div_horarios">
    <div class="table-responsive">
        <table class="cell-border datatable">
            <thead>
            <tr>
                <th style="width: 180px;">Quantidade Agendados</th>
                <th>Início e Fim</th>
                <th style="width: 120px;">Valor Total</th>
                <th style="width: 120px;">Média de Valor</th>
                <th style="width: 150px;">Total de presenças</th>
                <th style="width: 150px;">Total de ausências</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ranking->listarHorarios() as $rankings_horarios) { ?>
            <tr class="table-light">
                <td><?= $rankings_horarios['vezes']; ?></td>
                <td><?= $rankings_horarios['hora_inicio']; ?> até <?= $rankings_horarios['hora_fim']; ?></td>
                <td><?= number_format($rankings_horarios['valor_total'], 2); ?></td>
                <td><?= number_format($rankings_horarios['media_valor'], 2); ?></td>
                <td><?= $rankings_horarios['presente']; ?></td>
                <td><?= $rankings_horarios['ausente']; ?></td>

            </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>
</div>
<div class="container" id="div_turnos">
    <div class="table-responsive">
        <table class="cell-border datatable">
            <thead>
            <tr>
                <th style="width: 180px;">Quantidade Agendados</th>
                <th>Turno</th>
                <th style="width: 120px;">Valor Total</th>
                <th style="width: 120px;">Média de Valor</th>
                <th style="width: 150px;">Total de presenças</th>
                <th style="width: 150px;">Total de ausências</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ranking->listarTurnos() as $rankings_turnos) { ?>
            <tr class="table-light">
                <td><?= $rankings_turnos['vezes']; ?></td>
                <td><?= $rankings_turnos['turno']; ?></td>
                <td><?= number_format($rankings_turnos['valor_total'], 2); ?></td>
                <td><?= number_format($rankings_turnos['media_valor'], 2); ?></td>
                <td><?= $rankings_turnos['presente']; ?></td>
                <td><?= $rankings_turnos['ausente']; ?></td>
            </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>
</div>
<div class="container" id="div_agendamentos" style="width: 500px;">
    <div class="table-responsive">
        <table class="cell-border datatable">
            <thead>
            <tr>
                <th style="width: 120px;">Agendados</th>
                <th style="width: 120px;">Presentes</th>
                <th style="width: 120px;">Ausentes</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ranking->listarAgendamentos() as $rankings_agendamentos) {
            if ($rankings_agendamentos['agendados'] == 0) {
                $rankings_agendamentos['agendados'] = '';
            } ?>
            <tr class="table-light">
                <td><?= $rankings_agendamentos['agendados']; ?></td>
                <td><?= $rankings_agendamentos['presente']; ?></td>
                <td><?= $rankings_agendamentos['ausente']; ?></td>
            </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <br><br>
</div>
<div align="center">
    <a href="../Controllers/HorariosController.php">Voltar</a>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#div_quadras").hide();
        $("#div_esportes").hide();
        $("#div_clientes").hide();
        $("#div_horarios").hide();
        $("#div_turnos").hide();
        $("#div_agendamentos").hide();

        $('.datatable').DataTable({
            "searching": false,
            "ordering": false,
            "lengthChange": false,
            "bPaginate": false,
            "info": false,
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            }
        });

        $('#quadras').click(function () {
            $("#quadras").prop('disabled', true);
            $("#esportes").prop('disabled', false);
            $("#clientes").prop('disabled', false);
            $("#horarios").prop('disabled', false);
            $("#turnos").prop('disabled', false);
            $("#agendamentos").prop('disabled', false);
            $('#div_quadras').show();
            $("#div_esportes").hide();
            $("#div_clientes").hide();
            $("#div_horarios").hide();
            $("#div_turnos").hide();
            $("#div_agendamentos").hide();
        });

        $('#esportes').click(function () {
            $("#esportes").prop('disabled', true);
            $("#quadras").prop('disabled', false);
            $("#clientes").prop('disabled', false);
            $("#horarios").prop('disabled', false);
            $("#turnos").prop('disabled', false);
            $("#agendamentos").prop('disabled', false);
            $('#div_esportes').show();
            $("#div_quadras").hide();
            $("#div_clientes").hide();
            $("#div_horarios").hide();
            $("#div_turnos").hide();
            $("#div_agendamentos").hide();
        });

        $('#clientes').click(function () {
            $("#clientes").prop('disabled', true);
            $("#quadras").prop('disabled', false);
            $("#esportes").prop('disabled', false);
            $("#horarios").prop('disabled', false);
            $("#turnos").prop('disabled', false);
            $("#agendamentos").prop('disabled', false);
            $('#div_clientes').show();
            $("#div_quadras").hide();
            $("#div_esportes").hide();
            $("#div_horarios").hide();
            $("#div_turnos").hide();
            $("#div_agendamentos").hide();
        });

        $('#horarios').click(function () {
            $("#horarios").prop('disabled', true);
            $("#quadras").prop('disabled', false);
            $("#esportes").prop('disabled', false);
            $("#clientes").prop('disabled', false);
            $("#turnos").prop('disabled', false);
            $("#agendamentos").prop('disabled', false);
            $('#div_horarios').show();
            $("#div_quadras").hide();
            $("#div_esportes").hide();
            $("#div_clientes").hide();
            $("#div_turnos").hide();
            $("#div_agendamentos").hide();
        });

        $('#turnos').click(function () {
            $("#turnos").prop('disabled', true);
            $("#quadras").prop('disabled', false);
            $("#esportes").prop('disabled', false);
            $("#clientes").prop('disabled', false);
            $("#horarios").prop('disabled', false);
            $("#agendamentos").prop('disabled', false);
            $('#div_turnos').show();
            $("#div_quadras").hide();
            $("#div_esportes").hide();
            $("#div_clientes").hide();
            $("#div_horarios").hide();
            $("#div_agendamentos").hide();
        });

        $('#agendamentos').click(function () {
            $("#agendamentos").prop('disabled', true);
            $("#turnos").prop('disabled', false);
            $("#quadras").prop('disabled', false);
            $("#esportes").prop('disabled', false);
            $("#clientes").prop('disabled', false);
            $("#horarios").prop('disabled', false);
            $("#div_agendamentos").show();
            $('#div_turnos').hide();
            $("#div_quadras").hide();
            $("#div_esportes").hide();
            $("#div_clientes").hide();
            $("#div_horarios").hide();
        });
    });
</script>