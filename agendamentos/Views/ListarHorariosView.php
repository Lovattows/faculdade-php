<?php
error_reporting(0);
session_start();

?>
<head>
    <?php include '../Views/BasicView.php'; ?>
</head>
<div class="container">
    <h2 class="text-center">Horários da quadra LVTDA.</h2>
    <h5 class="text-left">
        <a href="../Views/CadastrarHorarioView.php" class="btn btn-success">
            <i class="fas fa-calendar-plus" style="padding: 3px 3px 3px 3px" title="Agendar horário"></i>
        </a>
        <a href="../Views/CadastrarClienteView.php" class="btn btn-primary">
            <i class="fa fa-user-plus" style="padding: 3px 3px 3px 3px" title="Registrar cliente"></i>
        </a>
        <a href="../Views/ListarClientesView.php" class="btn btn-dark">
            <i class="fas fa-users" style="padding: 3px 3px 3px 3px" title="Clientes cadastrados"></i>
        </a>
        <a href="../Views/ListarRankingsView.php" class="btn btn-warning">
            <i class="fas fa-star" style="padding: 3px 3px 3px 3px" title="Melhores ratings"></i>
        </a>
        <a href="../Views/ManipularDadosView.php" class="btn btn-danger">
            <i class="fa fa-trash" style="padding: 3px 3px 3px 3px" title="Excluir dados"></i>
        </a>
        <a class="btn navbar-btn btn-danger navbar-right" role="button"
           href="../Controllers/LoginController.php?Logout=1" style="float: right;">Logout</a>
        <p>
    </h5>
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" && isset($_SESSION['tipo_msg']) && $_SESSION['tipo_msg'] != "") { ?>
        <div align="center">
            <div style="font-size: 1.2em; margin-top: 25px; width:400px;"
                 class="alert alert-<?= $_SESSION['tipo_msg']; ?>" align="center">
                <strong><?= $_SESSION['msg']; ?></strong>
            </div>
        </div>
        <?php
        $_SESSION['msg'] = "";
        $_SESSION['tipo_msg'] = "";
    }

    ?>
    <div class="table-responsive">
        <table id="lista_agendamento" class="cell-border">
            <thead>
            <tr>
                <th>Ação</th>
                <th>ID</th>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Esporte</th>
                <th>Quadra</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Hora Início</th>
                <th>Hora Fim</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($_SESSION['dados_horarios']) && $_SESSION['dados_horarios'] != "") {
                $dados = $_SESSION['dados_horarios'];
                foreach ($dados as $key => $value) {

                    if ($dados[$key]['minutos_restantes'] <= 0 && $dados[$key]['presente'] == 0 && $dados[$key]['ausente'] == 0) {
                        $tr = "table-warning";
                    } else if ($dados[$key]['minutos_restantes'] > 0 && $dados[$key]['presente'] == 0 && $dados[$key]['ausente'] == 0) {
                        $tr = "table-light";
                    } else if ($dados[$key]['presente'] == 1) {
                        $tr = "table-success";
                    } else if ($dados[$key]['ausente'] == 1) {
                        $tr = "table-danger";
                    }

                    ?>
                    <tr class="<?= $tr; ?>">
                        <?php if ($tr == "table-light") { ?>
                            <td align="center" style="width: 90px;">
                                <a href="../Controllers/AgendamentoController.php?Action=Delete&ID=<?= $dados[$key]['id_agendamento']; ?> "
                                   title="Excluir Horário"
                                   onClick="return confirm('Deseja prosseguir com a exclusão?');"
                                   class="btn btn-danger">
                                    <i class="fas fa-trash-alt" title="Excluir Horário"></i>
                                </a>
                            </td>
                        <?php } else if ($tr == "table-warning") { ?>
                            <td style="width: 90px;">
                                <a href="../Controllers/HorariosController.php?Action=Present&ID=<?= $dados[$key]['id_agendamento']; ?> "
                                   title="Presente no horário"
                                   onClick="return confirm('Confirmar presença no horário?');" class="btn btn-success">
                                    <i class="fas fa-check-circle" title="Confirmar Presença"></i>
                                </a>
                                <a href="../Controllers/HorariosController.php?Action=Absent&ID=<?= $dados[$key]['id_agendamento']; ?> "
                                   title="Ausente no horário"
                                   onClick="return confirm('Confirmar ausência no horário?');" class="btn btn-danger">
                                    <i class="fas fa-ban" title="Confirmar Falta"></i></i>
                                </a>
                            </td>
                        <?php } else if ($tr == "table-success") { ?>
                            <td align="center" style="width: 90px;">
                                <a class="btn btn-outline-dark disabled" href="#">
                                    <i class="fas fa-check"></i>
                                </a>
                            </td>
                        <?php } else if ($tr == "table-danger") { ?>
                            <td align="center" style="width: 90px;">
                                <a class="btn btn-outline-dark disabled" href="#">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                        <?php } ?>
                        <td><?= $dados[$key]['id_agendamento']; ?></td>
                        <td><?= $dados[$key]['nome_cliente']; ?></td>
                        <td><?= $dados[$key]['telefone_cliente']; ?></td>
                        <td><?= $dados[$key]['nome_esporte']; ?></td>
                        <td><?= $dados[$key]['quadra_nome']; ?></td>
                        <td><?= $dados[$key]['agendamento_valor']; ?></td>
                        <td><?= $dados[$key]['agendamento_data']; ?></td>
                        <td><?= $dados[$key]['hr_ini']; ?></td>
                        <td><?= $dados[$key]['hr_fim']; ?></td>
                    </tr>
                    <?php
                }
            }

            ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(window).bind("beforeunload", function () {
            $.ajax({
                url: '../Controllers/HorariosController.php'
            });
        });

        $('#lista_agendamento').DataTable({
            "lengthMenu": [
                [10, 50, 100],
                ['10 ', '25 ', '50 ']],
            "order": [[1, "desc"]],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            }
        });
    });
</script>
