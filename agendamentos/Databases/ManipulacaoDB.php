<?php

class ManipulacaoDB
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->debug = false;
    }

    public function excluirNow()
    {
        $sql = "CALL p_delete_agendamento_now();";
        return $this->db->select($sql);
    }

    public function excluirMonth()
    {
        $sql = "CALL p_delete_agendamento_month();";
        return $this->db->select($sql);
    }

    public function excluirYear()
    {
        $sql = "CALL p_delete_agendamento_year();";
        return $this->db->select($sql);
    }

    public function excluirPast()
    {
        $sql = "CALL p_delete_agendamento_past();";
        return $this->db->select($sql);
    }

    public function excluirFuture()
    {
        $sql = "CALL p_delete_agendamento_future();";
        return $this->db->select($sql);
    }
}