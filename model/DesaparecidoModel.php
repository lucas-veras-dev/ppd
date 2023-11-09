<?php

namespace App\Model;

class DesaparecidoModel extends Model
{
    public String | Null $nomeFoto;
    public String | Null $nome;
    public String | Null $sexo;
    public String | Null $dataNascimento;
    public String | Null $localDesaparecimento;
    public String | Null $descricao;
    public String | Null $cpf;
    public String | Null $numeroBoletim;
    public String | Null $telefoneContato;
    public String | Null $emailContato;
    public String | Null $situacao;
    public Object | Null $cidade;
    public Object $usuario;
    public String | Null $arquivoFoto;
    public String | Null $extensaoFoto;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
