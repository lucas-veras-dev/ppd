<?php

namespace App\Model\Repository;

use App\Controller\Service\PerfilService;
use App\Model\UsuarioModel;

class UsuarioRepository extends Repository
{
    private PerfilService $perfilService;

    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_usuario";
        $this->perfilService = new PerfilService;
    }

    public function convertItemToObject($obj): UsuarioModel
    {
        $newObj = new UsuarioModel();
        $newObj->id = $obj->id;
        $newObj->nome = $obj->nome;
        $newObj->cpf = $obj->cpf;
        $newObj->dataNascimento = $obj->datanascimento;
        $newObj->email = $obj->email;
        $newObj->situacao = $obj->situacao;
        $newObj->perfil = $this->perfilService->listarPorId($obj->TB_PERFIL_id)->dados;

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
