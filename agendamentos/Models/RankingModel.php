<?php

class RankingModel
{

    private $id;

    public function __construct()
    {
        $this->DB = new RankingDB();
    }

    public function __construct_1($vet)
    {
        $this->id = $vet["id"];
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

    public function listarQuadras()
    {
        $rankingDB = new RankingDB();
        return $rankingDB->listarQuadras();
    }

    public function listarEsportes()
    {
        $rankingDB = new RankingDB();
        return $rankingDB->listarEsportes();
    }

    public function listarClientes()
    {
        $rankingDB = new RankingDB();
        return $rankingDB->listarClientes();
    }

    public function listarHorarios()
    {
        $rankingDB = new RankingDB();
        return $rankingDB->listarHorarios();
    }

    public function listarTurnos()
    {
        $rankingDB = new RankingDB();
        return $rankingDB->listarTurnos();
    }

    public function listarAgendamentos()
    {
        $rankingDB = new RankingDB();
        return $rankingDB->listarAgendamentos();
    }
}
