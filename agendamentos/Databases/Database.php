<?php

class Database extends PDO
{

    public $debug;
    public $sql_debug;

    public function __construct($banco = "estoque")
    {
        if ($banco == "estoque") {
            $sgdb = "mysql";
            $db = "quadra";
            $user = "root";
            $password = "";
            $host = "localhost";
            $persistent = true;
        }

        if ($sgdb) {
            $options = [
                PDO::ATTR_PERSISTENT => $persistent,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $dns = sprintf('%s:host=%s;dbname=%s;charset=utf8', $sgdb, $host, $db);

            parent::__construct($dns, $user, $password);
        }
    }

    protected function bindValues(&$sth, $data = [])
    {
        foreach ($data as $key => $val) {
            $tipo = (is_int($val)) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $sth->bindValue(":$key", $val, $tipo);
        }
    }

    public function select($sql, array $where = [], $all = true, $fetchMode = PDO::FETCH_ASSOC)
    {
        //var_dump($where);
        $sth = $this->prepare($sql);
        $selec = $this->bindValues($sth, $where);
        $sth->execute();

        if ($this->debug) {
            $this->showDebug($sql, $where);
        }

        if ($all) {
            return $sth->fetchAll($fetchMode);
        }
        return $sth->fetch($fetchMode);
    }

    public function insert($table, $data)
    {
        $camposNomes = implode('`, `', array_keys($data));
        $camposValores = ':' . implode(', :', array_keys($data));

        $sql = sprintf('INSERT INTO %s (`%s`) VALUES (%s)', $table, $camposNomes, $camposValores);

        $sth = $this->prepare($sql);

        $this->bindValues($sth, $data);

        $sth->execute();

        if ($this->debug) {
            $this->showDebug($sql, $data);
        }

        return $this->lastInsertID();
    }

    public function update($sql, $data)
    {
        $sth = $this->prepare($sql);
        $selec = $this->bindValues($sth, $data);

        if ($this->debug) {
            $this->showDebug($sql, $data);
        }

        return $sth->execute();
    }

    protected function truncate($table)
    {
        $truncate_table = $this->prepare("TRUNCATE TABLE $table");
        $truncate_table->execute();
    }

    private function showDebug($sql, $data)
    {
        echo "<pre>" . $this->sql_debug = PdoDebugger::show($sql, $data);
        echo "</pre>";
    }
}
