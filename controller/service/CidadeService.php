<?php

namespace App\Controller\Service;

use App\Model\Repository\CidadeRepository;

class CidadeService extends Service
{
    private CidadeRepository $cidadeRepository;

    public function __construct()
    {
        $this->cidadeRepository = new CidadeRepository;
    }

    public function inserir($obj)
    {

    }

    public function atualizar($obj)
    {
        
    }

    public function excluir(Int $id)
    {
        
    }

    public function listar()
    {
        return $this->cidadeRepository->list();
    }

    public function listarPorId(Int $id)
    {
        return $this->cidadeRepository->listById($id);
    }
}
