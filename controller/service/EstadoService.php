<?php

namespace App\Controller\Service;

use App\Model\Repository\EstadoRepository;

class EstadoService extends Service
{
    private EstadoRepository $estadoRepository;

    public function __construct()
    {
        $this->estadoRepository = new EstadoRepository;
    }

    public function inserir($obj)
    {

    }

    public function atualizar($obj)
    {
        
    }

    public function deletar(Int $id)
    {
        
    }

    public function listar()
    {
        return $this->estadoRepository->list();
    }

    public function listarPorId(Int $id)
    {
        return $this->estadoRepository->listById($id);
    }
}
