<?php

namespace App\Model;

class CidadeModel extends Model
{
    public String | Null $nome;
    public Object | Null $estado;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
