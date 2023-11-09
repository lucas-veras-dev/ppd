<?php

namespace App\Model\Repository;

use App\Controller\Service\CidadeService;
use App\Controller\Service\UsuarioService;
use App\Model\DesaparecidoModel;

class DesaparecidoRepository extends Repository
{
    private CidadeService $cidadeService;
    private UsuarioService $usuarioService;

    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_desaparecido";
        $this->cidadeService = new CidadeService;
        $this->usuarioService = new UsuarioService;
    }

    public function convertItemToObject($obj): DesaparecidoModel
    {
        $newObj = new DesaparecidoModel();
        $newObj->id = $obj->id;
        $newObj->nomeFoto = $obj->nome_foto;
        $newObj->nome = $obj->nome;
        $newObj->sexo = $obj->sexo;
        $newObj->dataNascimento = $obj->datanascimento;
        $newObj->localDesaparecimento = $obj->localdesaparecimento;
        $newObj->descricao = $obj->descricao;
        $newObj->cpf = $obj->cpf;
        $newObj->numeroBoletim = $obj->numeroboletim;
        $newObj->telefoneContato = $obj->telefonecontato;
        $newObj->emailContato = $obj->emailcontato;
        $newObj->situacao = $obj->situacao;
        $newObj->cidade = $this->cidadeService->listarPorId($obj->TB_CIDADE_id)->dados;
        $newObj->usuario = $this->usuarioService->listarPorId($obj->TB_USUARIO_id)->dados;

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
