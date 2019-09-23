<?php

class UsuarioDB
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->debug = false;
    }

    public function consultarUsuario($usuario)
    {
        $sql = "SELECT *
                FROM usuario
                WHERE login = :login AND password = :password";
        $data["login"] = $usuario->login;
        $data["password"] = md5($usuario->password);
        return $this->db->select($sql, $data);
    }
}
