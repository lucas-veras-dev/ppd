<?php

namespace App\Model;

class PerfilModel extends Model
{
    public String $perfil;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
