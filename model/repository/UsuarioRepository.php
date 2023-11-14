<?php

namespace App\Model\Repository;

use PDO;
use PDOException;

use App\Controller\Service\PerfilService;
use App\Model\UsuarioModel;

class UsuarioRepository extends Repository
{
    private PerfilService $perfilService;

    public function __construct()
    {
        parent::__construct();
        $this->table = "tb_usuario";
        $this->perfilService = new PerfilService;
    }

    public function convertItemToObject($obj): UsuarioModel
    {
        $newObj = new UsuarioModel();
        $newObj->id = $obj->id;
        $newObj->nome = $obj->nome;
        $newObj->cpf = $obj->cpf;
        $newObj->dataNascimento = $obj->datanascimento;
        $newObj->email = $obj->email;
        $newObj->situacao = $obj->situacao;
        $newObj->perfil = $this->perfilService->listarPorId($obj->TB_PERFIL_id)->dados;

        return $newObj;
    }

    public function insert($obj): Object
    {
        // desabilitando autocommit
        parent::autoCommit(0);

        try {
            $sql = "INSERT INTO {$this->table} 
            (nome, cpf, datanascimento, email, senha, TB_PERFIL_id)
            VALUES
            (:nome, :cpf, :datanascimento, :email, :senha, :TB_PERFIL_id)";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':nome', $obj->nome);
            $stmt->bindValue(':cpf', $obj->cpf);
            $stmt->bindValue(':datanascimento', $obj->dataNascimento);
            $stmt->bindValue(':email', $obj->email);
            $stmt->bindValue(':senha', $obj->senha);
            $stmt->bindValue(':TB_PERFIL_id', 2);
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
        // desabilitando autocommit
        parent::autoCommit(0);

        try {
            $sql = "UPDATE {$this->table} SET
            nome = :nome,
            cpf = :cpf,
            datanascimento = :datanascimento,
            email = :email
            WHERE
            id = :id";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':id', $obj->id);
            $stmt->bindValue(':nome', $obj->nome);
            $stmt->bindValue(':cpf', $obj->cpf);
            $stmt->bindValue(':datanascimento', $obj->dataNascimento);
            $stmt->bindValue(':email', $obj->email);
            $stmt->execute();

            $this->connectionPdo->commit();

            // montando resposta
            return $this->response(1, 1002);
        } catch (PDOException $e) {

            $this->connectionPdo->rollBack();

            // montando resposta
            return $this->response(0, 9003, null, null, $e->getMessage());
        } finally {
            // habilitando autocommit
            parent::autoCommit(1);
        }
    }

    public function delete($obj)
    {
        // desabilitando autocommit
        parent::autoCommit(0);

        try {
            // deletando desaparecidos
            $sql = "DELETE FROM tb_desaparecido WHERE TB_USUARIO_id = :TB_USUARIO_id";
            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':TB_USUARIO_id', $obj->id);
            $stmt->execute();

            // deletando usuário
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':id', $obj->id);
            $stmt->execute();

            $this->connectionPdo->commit();

            // montando resposta
            return $this->response(1, 1004);
        } catch (PDOException $e) {

            $this->connectionPdo->rollBack();

            // montando resposta
            return $this->response(0, 9003, null, null, $e->getMessage());
        } finally {
            // habilitando autocommit
            parent::autoCommit(1);
        }
    }

    public function list()
    {
        return parent::findAll();
    }

    public function listById(int $id)
    {
        return parent::findById($id);
    }

    public function checkCredentials($obj)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE email = :email and senha = :senha and situacao = 'A' order by 1";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':email', $obj->email);
            $stmt->bindValue(':senha', $obj->senha);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount != 0) {
                // montando resposta
                return $this->response(1, 1001, null, $this->convertItemToObject($stmt->fetchAll(PDO::FETCH_OBJ)[0]));
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
            return $this->response(1, 1002);
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
