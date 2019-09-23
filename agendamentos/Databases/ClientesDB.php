<?php

class ClientesDB
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->debug = false;
    }

    public function cadastrarCliente($cliente)
    {
        date_default_timezone_set("Brazil/East");
        $data["nome"] = $cliente->nome;
        $data["telefone"] = $cliente->telefone;
        $data["dt_cadastro"] = date('Y-m-d H:i:s');
        $data["operacao"] = "I";
        $cliente->id_cliente = $this->db->insert("clientes", $data);

        if ($cliente->id_cliente) {
            return $cliente->id_cliente;
        } else {
            return false;
        }
    }

    public function consultarClientes()
    {
        $sql = "SELECT id_cli,nome,telefone,
                DATE_FORMAT(dt_cadastro,'%d/%m/%Y') as data, DATE_FORMAT(dt_cadastro,'%T') as hora, ativado, desativado
                 FROM  clientes
             ORDER BY  id_cli DESC";
        return $this->db->select($sql);
    }

    public function desativarCliente($cliente)
    {
        $sql = "UPDATE clientes
                SET desativado = :desativado, ativado = :ativado, dt_cadastro = :dt_cadastro, operacao = :operacao
                WHERE id_cli = :id_cliente";
        $data["desativado"] = 1;
        $data["ativado"] = 0;
        $data["id_cliente"] = $cliente->id_cliente;
        date_default_timezone_set("Brazil/East");
        $data["dt_cadastro"] = date('Y-m-d H:i:s');
        $data["operacao"] = 'D';
        return $this->db->update($sql, $data);
    }

    public function ativarCliente($cliente)
    {
        $sql = "UPDATE clientes
                SET ativado = :ativado, desativado = :desativado, dt_cadastro = :dt_cadastro, operacao = :operacao
                WHERE id_cli = :id_cliente";
        $data["ativado"] = 1;
        $data["desativado"] = 0;
        $data["id_cliente"] = $cliente->id_cliente;
        date_default_timezone_set("Brazil/East");
        $data["dt_cadastro"] = date('Y-m-d H:i:s');
        $data["operacao"] = 'A';
        return $this->db->update($sql, $data);
    }

    public function consultarDados($cliente)
    {
        $sql = "SELECT nome,telefone
                 FROM  clientes
                WHERE  id_cli = :id_cliente";
        $data["id_cliente"] = $cliente->id_cliente;
        return $this->db->select($sql, $data);
    }

    public function atualizarCliente($cliente)
    {
        $sql = "UPDATE clientes
                 SET nome = :nome, telefone = :telefone, dt_cadastro = :dt_cadastro, operacao = :operacao
                WHERE  id_cli = :id_cliente";
        $data["id_cliente"] = $cliente->id_cliente;
        $data["nome"] = $cliente->nome;
        $data["telefone"] = $cliente->telefone;
        date_default_timezone_set("Brazil/East");
        $data["dt_cadastro"] = date('Y-m-d H:i:s');
        $data["operacao"] = 'U';
        return $this->db->update($sql, $data);
    }
}
