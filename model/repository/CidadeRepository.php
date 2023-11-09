<?php

namespace App\Model\Repository;

use App\Controller\Service\EstadoService;
use App\Model\CidadeModel;

class CidadeRepository extends Repository
{
    private EstadoService $estadoService;

    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_cidade";
        $this->estadoService = new EstadoService;
    }

    public function convertItemToObject($obj): CidadeModel
    {
        $newObj = new CidadeModel();
        $newObj->id = $obj->id;
        $newObj->nome = $obj->nome;
        $newObj->estado = $this->estadoService->listarPorId($obj->TB_ESTADO_id)->dados;

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
