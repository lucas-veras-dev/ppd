<?php

namespace App\Model;

class EstadoModel extends Model
{
    public String | Null $nome;
    public String | Null $uf;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
