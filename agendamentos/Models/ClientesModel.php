<?php

class ClientesModel
{

    private $id_cliente;
    private $nome;
    private $telefone;

    public function __construct()
    {
        $this->DB = new ClientesDB();
    }

    public function __construct_1($vet)
    {
        $this->id_cliente = $vet["id_cliente"];
        $this->nome = $vet["nome"];
        $this->telefone = $vet["telefone"];
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function salvar()
    {
        $clientesDB = new ClientesDB();
        return $clientesDB->cadastrarCliente($this);
    }

    public function desativar()
    {
        $clientesDB = new ClientesDB();
        return $clientesDB->desativarCliente($this);
    }

    public function ativar()
    {
        $clientesDB = new ClientesDB();
        return $clientesDB->ativarCliente($this);
    }

    public function consultar()
    {
        $clientesDB = new ClientesDB();
        return $clientesDB->consultarClientes($this);
    }

    public function dados()
    {
        $clientesDB = new ClientesDB();
        return $clientesDB->consultarDados($this);
    }

    public function atualizar()
    {
        $clientesDB = new ClientesDB();
        return $clientesDB->atualizarCliente($this);
    }
}
