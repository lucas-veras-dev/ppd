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
        return $this->desaparecidoRepository->insert($obj);
    }

    public function atualizar($obj)
    {
        
    }

    public function deletar(Int $id)
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

    public function listarPorAtivo()
    {
        return $this->desaparecidoRepository->listByActive();
    }

    public function listarPorFiltro($obj)
    {
        return $this->desaparecidoRepository->listByFilter($obj);
    }

    public function alterarSituacao($situacao, $id)
    {
        return $this->desaparecidoRepository->changeSituation($situacao, $id);
    }
}
