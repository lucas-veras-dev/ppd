<?php

namespace App\Controller\Service;

abstract class Service
{
    public abstract function inserir($obj);
    public abstract function atualizar($obj);
    public abstract function deletar(Int $id);
    public abstract function listar();
    public abstract function listarPorId(Int $id);
}
