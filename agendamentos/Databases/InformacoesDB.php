<?php

class InformacoesDB
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->debug = false;
    }

    public function consultarClientes()
    {
        $sql = "SELECT id_cli,nome
                 FROM  clientes
                 WHERE ativado = 1
             ORDER BY  id_cli DESC";
        return $this->db->select($sql);
    }

    public function consultarHorarios()
    {
        $sql = "SELECT hora_inicio, hora_fim, turno, id_horario
            FROM horarios WHERE turno <> :turno
            ORDER BY id_horario ASC";
        $condicoes["turno"] = '';
        return $this->db->select($sql, $condicoes);
    }

    public function consultarQuadras()
    {
        $sql = "SELECT nome, id_quadra
            FROM quadras WHERE nome <> :nome
            ORDER BY id_quadra ASC";
        $condicoes["nome"] = '';
        return $this->db->select($sql, $condicoes);
    }

    public function consultarEsportes()
    {
        $sql = "SELECT nome, id_esporte
            FROM esportes WHERE nome <> :nome
            ORDER BY id_esporte ASC";
        $condicoes["nome"] = '';
        return $this->db->select($sql, $condicoes);
    }

    public function consultarAgendamentos()
    {
        $sql = "SELECT
            a.id_agendamento,
            c.nome as nome_cliente,
            c.telefone as telefone_cliente,
            e.nome as nome_esporte,
            q.nome as quadra_nome,
            h.hora_inicio as hr_ini,
            h.hora_fim as hr_fim,
            a.presente as presente,
            a.ausente as ausente,
            DATE_FORMAT(a.data, '%d/%m/%Y') as agendamento_data,
            a.valor as agendamento_valor,
            TIMESTAMPDIFF(MINUTE,NOW(),CONCAT(a.data,' ',h.hora_inicio)) as minutos_restantes
        FROM agendamento a
        INNER JOIN clientes c ON a.id_cli = c.id_cli
        INNER JOIN esportes e ON a.id_esporte = e.id_esporte
        INNER JOIN quadras q ON a.id_quadra = q.id_quadra
        INNER JOIN horarios h ON a.id_horario = h.id_horario
        ORDER BY a.id_agendamento DESC";
        $condicoes["finalizado"] = 0;
        return $this->db->select($sql, $condicoes);
    }
}
