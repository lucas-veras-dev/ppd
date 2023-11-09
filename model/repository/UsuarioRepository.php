<?php

namespace App\Model\Repository;

use App\Model\UsuarioModel;

class UsuarioRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_usuario";
    }

    public function convertItemToObject($obj): UsuarioModel
    {
        $newObj = new UsuarioModel();
        $newObj->id = $obj->id;
        $newObj->nome = $obj->nome;
        $newObj->cpf = $obj->cpf;
        $newObj->dataNascimento = $obj->datanascimento;
        $newObj->email = $obj->email;
        $newObj->senha = $obj->senha;
        $newObj->situacao = $obj->situacao;
        $newObj->tbPerfilId = $obj->TB_PERFIL_id;

        return $newObj;
    }

    public function insert($obj)
    {
    }

    public function update($obj)
    {
    }

    public function delete($obj)
    {
    }

    public function list()
    {
        return parent::findAll();
    }

    public function listById(int $id)
    {
        return parent::findById($id);
    }
}
