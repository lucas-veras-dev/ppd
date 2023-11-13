<?php

namespace App\Model\Repository;

use PDO;
use PDOException;

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

    public function listByState(int $id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE TB_ESTADO_id = :TB_ESTADO_id order by 1";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':TB_ESTADO_id', $id);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount != 0) {
                // montando resposta
                return $this->response(1, 1003, null, $this->convertListToObject($stmt->fetchAll(PDO::FETCH_OBJ)));
            }

            // montando resposta
            return $this->response(0, 9005);
        } catch (PDOException $e) {
            // montando resposta
            return $this->response(0, 9004, null, null, $e->getMessage());
        }
    }
}
