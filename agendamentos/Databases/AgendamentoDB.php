<?php

class AgendamentoDB
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->debug = false;
    }

    public function cadastrarAgendamento($agendamento)
    {
        date_default_timezone_set("Brazil/East");
        $data["id_cli"] = $agendamento->id_cli;
        $data["id_esporte"] = $agendamento->id_esporte;
        $data["id_horario"] = $agendamento->id_horario;
        $data["id_quadra"] = $agendamento->id_quadra;
        $data["data"] = $agendamento->data;
        $data["valor"] = $agendamento->valor;
        $data["dt_cadastro"] = date('Y-m-d H:i:s');
        $agendamento->id_agendamento = $this->db->insert("agendamento", $data);

        if ($agendamento->id_agendamento) {
            return $agendamento->id_agendamento;
        } else {
            return false;
        }
    }

    public function consultarAgendamento($agendamento)
    {
        $sql = "SELECT id_quadra, nome
                FROM quadras
                WHERE id_quadra NOT IN (SELECT id_quadra FROM agendamento WHERE id_horario = :id_horario AND data = :data)";
        $data["id_horario"] = $agendamento->id_horario;
        $data["data"] = $agendamento->data;
        return $this->db->select($sql, $data);
    }

    public function excluirAgendamento($agendamento)
    {
        $sql = "DELETE
                FROM agendamento
                WHERE id_agendamento = :id_agendamento";
        $data["id_agendamento"] = $agendamento->id_agendamento;
        return $this->db->update($sql, $data);
    }

    public function confirmarPresenca($agendamento)
    {
        $sql = "UPDATE agendamento
                SET presente = 1
                WHERE id_agendamento = :id_agendamento";
        $data["id_agendamento"] = $agendamento->id_agendamento;
        return $this->db->update($sql, $data);
    }

    public function confirmarAusencia($agendamento)
    {
        $sql = "UPDATE agendamento
                SET ausente = 1
                WHERE id_agendamento = :id_agendamento";
        $data["id_agendamento"] = $agendamento->id_agendamento;
        return $this->db->update($sql, $data);
    }
}
