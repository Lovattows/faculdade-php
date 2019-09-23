<?php

class ManipulacaoModel
{

    private $id;

    public function __construct()
    {
        $this->DB = new ManipulacaoDB();
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

    public function now()
    {
        $manipulacaoDB = new ManipulacaoDB();
        return $manipulacaoDB->excluirNow();
    }

    public function month()
    {
        $manipulacaoDB = new ManipulacaoDB();
        return $manipulacaoDB->excluirMonth();
    }

    public function year()
    {
        $manipulacaoDB = new ManipulacaoDB();
        return $manipulacaoDB->excluirYear();
    }

    public function past()
    {
        $manipulacaoDB = new ManipulacaoDB();
        return $manipulacaoDB->excluirPast();
    }

    public function future()
    {
        $manipulacaoDB = new ManipulacaoDB();
        return $manipulacaoDB->excluirFuture();
    }
}