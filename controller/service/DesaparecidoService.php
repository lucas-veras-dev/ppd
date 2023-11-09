<?php

namespace App\Controller\Service;

use App\Model\Repository\DesaparecidoRepository;

class DesaparecidoService extends Service
{
    private DesaparecidoRepository $desaparecidoRepository;

    public function __construct()
    {
        $this->desaparecidoRepository = new DesaparecidoRepository;
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
        return $this->desaparecidoRepository->list();
    }

    public function listarPorId(Int $id)
    {
        return $this->desaparecidoRepository->listById($id);
    }
}
