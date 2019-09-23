<?php

class UsuarioModel
{

    private $login;
    private $password;

    public function __construct()
    {
        $this->DB = new UsuarioDB();
    }

    public function __construct_1($vet)
    {
        $this->login = $vet["login"];
        $this->password = $vet["password"];
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

    public function consultar()
    {
        $usuarioDB = new UsuarioDB();
        return $usuarioDB->consultarUsuario($this);
    }
}
