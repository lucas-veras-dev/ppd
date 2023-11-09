<?php

namespace App\Model\Repository;

use App\Model\PerfilModel;

class PerfilRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_perfil";
    }

    public function convertItemToObject($obj): PerfilModel
    {
        $newObj = new PerfilModel();
        $newObj->id = $obj->id;
        $newObj->perfil = $obj->perfil;

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
