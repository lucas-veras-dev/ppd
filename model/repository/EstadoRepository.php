<?php

namespace App\Model\Repository;

use App\Model\EstadoModel;

class EstadoRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_estado";
    }

    public function convertItemToObject($obj): EstadoModel
    {
        $newObj = new EstadoModel();
        $newObj->id = $obj->id;
        $newObj->nome = $obj->nome;
        $newObj->uf = $obj->uf;

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
