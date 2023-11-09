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

    }

    public function atualizar($obj)
    {
        
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
        
    }
}
