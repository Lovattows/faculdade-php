<?php

class RankingDB
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->debug = false;
    }

    public function listarQuadras()
    {
        $sql = "SELECT * FROM top_quadras";
        return $this->db->select($sql);
    }

    public function listarEsportes()
    {
        $sql = "SELECT * FROM top_esportes";
        return $this->db->select($sql);
    }

    public function listarClientes()
    {
        $sql = "SELECT * FROM top_clientes";
        return $this->db->select($sql);
    }

    public function listarHorarios()
    {
        $sql = "SELECT * FROM top_horarios";
        return $this->db->select($sql);
    }

    public function listarTurnos()
    {
        $sql = "SELECT * FROM top_turnos";
        return $this->db->select($sql);
    }

    public function listarAgendamentos()
    {
        $sql = "SELECT * FROM top_agendamentos";
        return $this->db->select($sql);
    }
}
