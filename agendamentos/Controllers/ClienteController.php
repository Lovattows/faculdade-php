<?php
error_reporting(0);
session_start();

require_once '../Databases/Database.php';
require_once '../Databases/Debug.php';
require_once '../Databases/ClientesDB.php';
require_once '../Models/ClientesModel.php';

$cliente = new ClientesModel();
$action = filter_input(INPUT_GET, 'Action', FILTER_SANITIZE_STRING);

if ($action == 'Add') {
    $cliente->nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $cliente->telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    if ($cliente->salvar()) {
        $_SESSION["tipo_msg"] = "success";
        $_SESSION["msg"] = "Cliente cadastrado com sucesso.";
        header('Location: ../Views/ListarClientesView.php');
    } else {
        $_SESSION["tipo_msg"] = "danger";
        $_SESSION["msg"] = "Telefone já cadastrado.";
        header('Location: ../Views/CadastrarClienteView.php');
    }
} else if ($action == 'Deactivate') {
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $cliente->id_cliente = $id;
    $cliente->desativar();
    $cliente->id_cliente = "";
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Cliente ID <strong>" . $id . "</strong> desativado com sucesso.";
    header('Location: ../Views/ListarClientesView.php');
} else if ($action == 'Activate') {
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $cliente->id_cliente = $id;
    $cliente->ativar();
    $cliente->id_cliente = "";
    $_SESSION["tipo_msg"] = "success";
    $_SESSION["msg"] = "Cliente ID <strong>" . $id . "</strong> ativado com sucesso.";
    header('Location: ../Views/ListarClientesView.php');
} else if ($action == "Update") {
    $id = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $cliente->id_cliente = $id;
    $dados = $cliente->dados();
    $_SESSION["dados_cliente"]["id_cli"] = $id;
    $_SESSION["dados_cliente"]["nome"] = $dados[0]["nome"];
    $_SESSION["dados_cliente"]["telefone"] = $dados[0]["telefone"];
    header('Location: ../Views/AtualizarClienteView.php');
} else if ($action == "Send") {
    $cliente->id_cliente = $_SESSION["dados_cliente"]["id_cli"];
    $cliente->nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $cliente->telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    if ($cliente->atualizar()) {
        $_SESSION["tipo_msg"] = "success";
        $_SESSION["msg"] = "Cliente alterado com sucesso.";
        header('Location: ../Views/ListarClientesView.php');
    } else {
        $_SESSION["tipo_msg"] = "danger";
        $_SESSION["msg"] = "Telefone já cadastrado.";
        header('Location: ../Views/AtualizarClienteView.php');
    }
}

