<?php

namespace App\Model;

class UsuarioModel extends Model
{
    public String | Null $nome;
    public String | Null $cpf;
    public String | Null $dataNascimento;
    public String | Null $email;
    public String | Null $senha;
    public String | Null $situacao;
    public Object | Null $perfil;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
