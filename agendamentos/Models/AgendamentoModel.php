<?php

class AgendamentoModel
{

    private $id_agendamento;
    private $id_horario;
    private $id_cli;
    private $id_esporte;
    private $id_quadra;
    private $data;
    private $valor;

    public function __construct()
    {
        $this->DB = new AgendamentoDB();
    }

    public function __construct_1($vet)
    {
        $this->id_agendamento = $vet["id_agendamento"];
        $this->id_horario = $vet["id_horario"];
        $this->id_cli = $vet["id_cli"];
        $this->id_esporte = $vet["id_esporte"];
        $this->id_quadra = $vet["id_quadra"];
        $this->data = $vet["data"];
        $this->nome = $vet["nome"];
        $this->valor = $vet["valor"];
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
        $agendamentoDB = new AgendamentoDB();
        return $agendamentoDB->cadastrarAgendamento($this);
    }

    public function consultar()
    {
        $agendamentoDB = new AgendamentoDB();
        return $agendamentoDB->consultarAgendamento($this);
    }

    public function excluir()
    {
        $agendamentoDB = new AgendamentoDB;
        return $agendamentoDB->excluirAgendamento($this);
    }

    public function confirmarPresenca()
    {
        $agendamentoDB = new AgendamentoDB;
        return $agendamentoDB->confirmarPresenca($this);
    }

    public function confirmarAusencia()
    {
        $agendamentoDB = new AgendamentoDB;
        return $agendamentoDB->confirmarAusencia($this);
    }
}
