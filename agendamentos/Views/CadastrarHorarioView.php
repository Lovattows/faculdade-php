<?php
session_start();
error_reporting(0);
require_once '../Databases/Debug.php';
require_once '../Databases/Database.php';
require_once '../Databases/InformacoesDB.php';
require_once '../Models/InformacoesModel.php';

$informacoes = new InformacoesModel();

?>
<head>
    <?php include '../Views/BasicView.php'; ?>
</head>

<h2 class="text-center">Agendar horário</h2>
<hr>

<form method="post" action="../Controllers/AgendamentoController.php?Action=Add">
    <div class="container clear_fix" align="center">
        <div class="row">
            <div id="cliente_div" class="col-sm" style="clear:both">
                <label>Clientes</label>
                <div style="text-align: center">
                    <select class="js-example-basic-single" name="cliente" style="width:25%" required>
                        <option value="" selected="true" disabled="disabled">--- Selecione ---</option>
                        <?php foreach ($informacoes->consultaCliente() as $cliente) { ?>
                            <option value="<?= $cliente['id_cli'] ?>"><?= $cliente['nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="esporte_div" class="col-sm" style="clear:both">
                <label>Esportes</label>
                <div style="text-align: center">
                    <select class="js-example-basic-single " name="esporte" style="width:25%" required>
                        <option value="" selected="true" disabled="disabled">--- Selecione ---</option>
                        <?php foreach ($informacoes->consultaEsporte() as $esportes) { ?>
                            <option value="<?= $esportes['id_esporte'] ?>"><?= $esportes['nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="valor_div" class="col-sm" style="clear:both">
                <label>Valor</label>
                <div style="text-align: center">
                    <input type="text" name="valor" id="valor" style="width: 35px;" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="data_div" class="col-sm" style="clear:both">
                <label>Data</label>
                <div style="text-align: center">
                    <input type="text" id="data" name="data" style="width:8%" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="horario_div" class="col-sm" style="clear:both">
                <label>Horários</label>
                <div style="text-align: center">
                    <select class="js-example-basic-single " name="horario" style="width:25%" required>
                        <option value="" selected="true" disabled="disabled">--- Selecione ---</option>
                        <?php foreach ($informacoes->consultaHorario() as $horarios) { ?>
                            <option value="<?= $horarios['id_horario'] ?>"><?= $horarios['hora_inicio'] ?>
                                até <?= $horarios['hora_fim'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="quadra_div" class="col-sm" style="clear:both">
                <label>Quadras</label>
                <div style="text-align: center">
                    <div id="popula_quadra"></div>
                </div>
            </div>
        </div>
        <p>
        <div>
            <button class="btn btn-primary btn-lg">Registrar</button>
        </div>
    </div>
</form>
<div align="center">
    <a href="../Views/ListarHorariosView.php">Voltar</a>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $("#data").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true});
            $.datepicker.regional['pt-BR'] = {
                minDate: new Date(),
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                    'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
        });

        $("#valor").mask("000");

        $('.js-example-basic-single').select2();

        $("#esporte_div").hide();
        $("#valor_div").hide();
        $("#data_div").hide();
        $("#horario_div").hide();
        $("#quadra_div").hide();

        $("select[name='cliente']").on('change', function () {
            $("#esporte_div").hide();
            $("#valor_div").hide();
            $("#data_div").hide();
            $("#horario_div").hide();
            $("#quadra_div").hide();
            $("select[name='esporte']").val(null).trigger("change");
            $("input[name='valor']").val(null).trigger("change");
            $("input[name='data']").val(null).trigger("change");
            $("select[name='horario']").val(null).trigger("change");
            $("select[name='quadra']").val(null).trigger("change");
            var cliente = $('select[name=cliente]').val();
            if (cliente) {
                $("#esporte_div").show();
            }
        });

        $("select[name='esporte']").on('change', function () {
            $("#valor_div").hide();
            $("#data_div").hide();
            $("#horario_div").hide();
            $("#quadra_div").hide();
            $("input[name='valor']").val(null).trigger("change");
            $("input[name='data']").val(null).trigger("change");
            $("select[name='horario']").val(null).trigger("change");
            $("select[name='quadra']").val(null).trigger("change");
            var esporte = $('select[name=esporte]').val();
            if (esporte) {
                $("#valor_div").show();
            }
        });

        $("input[name='valor']").on('change', function () {
            $("#data_div").hide();
            $("#horario_div").hide();
            $("#quadra_div").hide();
            $("input[name='data']").val(null).trigger("change");
            $("select[name='horario']").val(null).trigger("change");
            $("select[name='quadra']").val(null).trigger("change");
            var valor = $("input[name='valor']").val();
            if (valor) {
                $("#data_div").show();
            }
        });

        $("input[name='data']").on('change', function () {
            $("#horario_div").hide();
            $("#quadra_div").hide();
            $("select[name='horario']").val(null).trigger("change");
            $("select[name='quadra']").val(null).trigger("change");
            var data = $('input[name=data]').val();
            if (data) {
                $("#horario_div").show();
            }
        });

        $("select[name='horario']").on('change', function () {
            $("#quadra_div").hide();
            $("select[name='quadra']").val(null).trigger("change");
            var horario = $('select[name=horario]').val();
            var data = $('input[name=data]').val();
            if (horario) {
                $.ajax({
                    url: '../Ajax/AgendamentoAjax.php',
                    type: 'GET',
                    dataType: '',
                    data: 'Action=Consult&Horario=' + horario + '&Data=' + data,
                    success: function (data) {
                        if (data) {
                            $('#popula_quadra').html(data);
                            $('.js-example-basic-single').select2();
                            $("#quadra_div").show();
                        }
                    }
                });
            }
        });
    });
</script>
