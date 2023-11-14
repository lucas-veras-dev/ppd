<?php

namespace App\Controller\Service;

use App\Model\Repository\UsuarioRepository;

class UsuarioService extends Service
{
    private UsuarioRepository $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository;
    }

    public function inserir($obj)
    {
        return $this->usuarioRepository->insert($obj);
    }

    public function atualizar($obj)
    {
        return $this->usuarioRepository->update($obj);
    }

    public function excluir(Int $id)
    {
    }

    public function listar()
    {
        return $this->usuarioRepository->list();
    }

    public function listarPorId(Int $id)
    {
        return $this->usuarioRepository->listById($id);
    }

    public function verificarCredenciais($obj)
    {
        return $this->usuarioRepository->checkCredentials($obj);
    }

    public function alterarSituacao($situacao, $id)
    {
        return $this->usuarioRepository->changeSituation($situacao, $id);
    }
}
