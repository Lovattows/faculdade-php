<?php
session_start();
error_reporting(0);
require_once '../Databases/Debug.php';
require_once '../Databases/Database.php';
require_once '../Databases/ClientesDB.php';
require_once '../Models/ClientesModel.php';

$cliente = new ClientesModel();
?>
<head>
    <?php include '../Views/BasicView.php'; ?>
</head>
<div class="container">
    <h2 class="text-center">Clientes cadastrados</h2>
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
        <table id="lista_clientes" class="cell-border">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Data de Cadastro</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cliente->consultar() as $clientes) { ?>
                <tr class="table-light">
                    <td><?= $clientes['id_cli']; ?></td>
                    <td width="40%"><?= $clientes['nome']; ?></td>
                    <td><?= $clientes['telefone']; ?></td>
                    <td><?= $clientes['data']; ?> ás <?= $clientes["hora"] ?></td>
                    <?php if ($clientes['ativado'] == 1) { ?>
                        <td>Ativado</td>
                    <?php } else if ($clientes['desativado'] == 1) { ?>
                        <td>Desativado</td>
                    <?php } ?>
                    <td>
                        <?php if ($clientes['ativado'] == 1) { ?>
                            <a href="../Controllers/ClienteController.php?Action=Update&ID=<?= $clientes['id_cli']; ?>"><i
                                        class="btn btn-info far fa-edit"></i></a>
                            <a href="../Controllers/ClienteController.php?Action=Deactivate&ID=<?= $clientes['id_cli']; ?> "
                               title="Desativar" onClick="return confirm('Deseja desativar o cliente?');"><i
                                        class="btn btn-danger far fa-times-circle"></i></a>
                        <?php } else if ($clientes['desativado'] == 1) { ?>
                            <a href="../Controllers/ClienteController.php?Action=Activate&ID=<?= $clientes['id_cli']; ?> "
                               title="Desativar" onClick="return confirm('Deseja ativar o cliente?');"><i
                                        class="btn btn-success far fa-check-circle"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <div align="center">
        <a href="../Controllers/HorariosController.php">Voltar</a>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#lista_clientes').DataTable({
            "lengthMenu": [
                [10, 50, 100],
                ['10 ', '25 ', '50 ']],
            "order": [[0, "desc"]],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            }
        });
    });
</script>