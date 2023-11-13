<?php

namespace App\Model\Repository;

use PDO;
use PDOException;

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
        $newObj->arquivoFoto = $obj->arquivo_foto;
        $newObj->extensaoFoto = $obj->extensao_foto;

        return $newObj;
    }

    public function insert($obj): Object
    {
        // desabilitando autocommit
        parent::autoCommit(0);

        try {
            $sql = "INSERT INTO {$this->table} 
            (nome_foto, nome, sexo, datanascimento, localdesaparecimento, descricao,
            cpf, numeroboletim, telefonecontato, emailcontato, TB_CIDADE_id,
            TB_USUARIO_id, arquivo_foto, extensao_foto)
            VALUES
            (:nome_foto, :nome, :sexo, :datanascimento, :localdesaparecimento, :descricao,
            :cpf, :numeroboletim, :telefonecontato, :emailcontato, :TB_CIDADE_id,
            :TB_USUARIO_id, :arquivo_foto, :extensao_foto)";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':nome_foto', $obj->nomeFoto);
            $stmt->bindValue(':nome', $obj->nome);
            $stmt->bindValue(':sexo', $obj->sexo);
            $stmt->bindValue(':datanascimento', $obj->dataNascimento);
            $stmt->bindValue(':localdesaparecimento', $obj->localDesaparecimento);
            $stmt->bindValue(':descricao', $obj->descricao);
            $stmt->bindValue(':cpf', $obj->cpf);
            $stmt->bindValue(':numeroboletim', $obj->numeroBoletim);
            $stmt->bindValue(':telefonecontato', $obj->telefoneContato);
            $stmt->bindValue(':emailcontato', $obj->emailContato);
            $stmt->bindValue(':TB_CIDADE_id', $obj->cidade->id);
            $stmt->bindValue(':TB_USUARIO_id', $obj->usuario->id);
            $stmt->bindValue(':arquivo_foto', $obj->arquivoFoto);
            $stmt->bindValue(':extensao_foto', $obj->extensaoFoto);
            $stmt->execute();

            $this->connectionPdo->commit();

            // montando resposta
            return $this->response(1, 1001, parent::getLastId());
        } catch (PDOException $e) {

            $this->connectionPdo->rollBack();

            // montando resposta
            return $this->response(0, 9006, null, null, $e->getMessage());
        } finally {
            // habilitando autocommit
            parent::autoCommit(1);
        }
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

    public function listByActive()
    {
        try {
            $sql = "SELECT * FROM {$this->table} where situacao = 'A' order by 1";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount != 0) {
                // montando resposta
                return $this->response(1, 1001, null, $this->convertListToObject($stmt->fetchAll(PDO::FETCH_OBJ)));
            }

            // montando resposta
            return $this->response(0, 9005);
        } catch (PDOException $e) {
            // montando resposta
            return $this->response(0, 9006, null, null, $e->getMessage());
        }
    }

    public function changeSituation($situacao, $id): Object
    {
        // desabilitando autocommit
        parent::autoCommit(0);

        try {
            $sql = "UPDATE {$this->table} SET
            situacao = :situacao
            WHERE
            id = :id";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':situacao', $situacao);
            $stmt->execute();

            $this->connectionPdo->commit();

            // montando resposta
            return $this->response(1, 1002, parent::getLastId());
        } catch (PDOException $e) {

            $this->connectionPdo->rollBack();

            // montando resposta
            return $this->response(0, 9003, null, null, $e->getMessage());
        } finally {
            // habilitando autocommit
            parent::autoCommit(1);
        }
    }
}
