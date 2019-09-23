<?php
error_reporting(0);
session_start();

?>
<head>
    <?php include '../Views/BasicView.php'; ?>
</head>

<h2 class="text-center">
    Atualizar Dados do Cliente
</h2>
<hr>

<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" && isset($_SESSION['tipo_msg']) && $_SESSION['tipo_msg'] != "") { ?>
    <div align="center">
        <div style="font-size: 1.2em; margin-top: 25px; width:400px;" class="alert alert-<?= $_SESSION['tipo_msg']; ?>"
             align="center">
            <strong><?= $_SESSION['msg']; ?></strong>
        </div>
    </div>
    <?php
    $_SESSION['msg'] = "";
    $_SESSION['tipo_msg'] = "";
}

?>

<form method="post" action="../Controllers/ClienteController.php?Action=Send" id="cadastro_cliente">
    <div class="container" align="center">
        <div class="col-md-4">
            Nome: <i class="fa fa-user"></i>
            <input type="text" class="form-control" name="nome" id="nome" maxlength="100" value="<?= $_SESSION["dados_cliente"]["nome"] ?>" required autofocus>
            <br>
        </div>
        <div class="col-md-3">
            Telefone: <i class="fa fa-phone"></i>
            <div clas="row">
                <input type="radio" name="tipo_telefone" value="residencial" id="tipo_telefone"> Residencial
                <input type="radio" name="tipo_telefone" value="celular" id="tipo_telefone"> Celular
            </div>
            <input type="text" class="form-control" name="telefone" id="telefone" required disabled="disabled">
            <br>
        </div>
    </div>
    <div class="col-md-12" align="center">
        <button class="btn btn-primary btn-lg" id="atualizar">Atualizar</button>
        <br><br>
        <a href="../Views/ListarClientesView.php">Voltar</a>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('input:radio[name="tipo_telefone"]').change(function () {
            $('input:text[name="telefone"]').removeAttr("disabled");
            $('input[name="telefone"]').val('');
            if (this.value === 'residencial') {
                $("#telefone").mask("0000-0000");
            } else if (this.value === 'celular') {
                $("#telefone").mask("00000-0000");
            }
        });

        $("#atualizar").click(function () {
            var tipo_telefone = $("input[type='radio']:checked").val();
            var telefone = $('input[name="telefone"]').val().length;
            if (tipo_telefone === 'residencial' && telefone < 9) {
                alert("Preencha um número de telefone.");
                return false;
            } else if (tipo_telefone === 'celular' && telefone < 10) {
                alert("Preencha um número de celular.");
                return false;
            }
        });
    });
</script>
