<?php

namespace App\Controller\Service;

use App\Model\Repository\PerfilRepository;

class PerfilService extends Service
{
    private PerfilRepository $perfilRepository;

    public function __construct()
    {
        $this->perfilRepository = new PerfilRepository;
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
        return $this->perfilRepository->list();
    }

    public function listarPorId(Int $id)
    {
        return $this->perfilRepository->listById($id);
    }
}
