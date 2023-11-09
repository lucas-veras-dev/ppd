<?php

namespace App\Model\Repository;

require_once(__DIR__ . '/../../config/db.php');

use PDO;
use PDOException;
use stdClass;

abstract class Repository
{
    public PDO $connectionPdo;
    protected $table;
    public Object $response;

    public function __construct()
    {
        $this->getConnection();
        $this->response = new stdClass;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    private function getConnection()
    {
        $host = HOST_DB;
        $port = PORT;
        $dbname = DBNAME;
        $user = USER_DB;
        $password = PASSWORD_DB;

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            if (!isset($this->connectionPdo)) {
                $this->connectionPdo = new PDO($dsn, $user, $password, $options);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function autoCommit(Bool $status)
    {
        $this->connectionPdo->setAttribute(PDO::ATTR_AUTOCOMMIT, $status);
        if (!$status) {
            $this->connectionPdo->beginTransaction();
        }
    }

    public abstract function convertItemToObject($obj);

    public function convertListToObject(array|Object $lista): array
    {
        $dados = [];

        foreach ($lista as $obj) :
            $dados[] = $this->convertItemToObject($obj);
        endforeach;

        return $dados;
    }

    public function response(Int $code = null, Int $idMsg = null, Int $idInserido = null, $dados = null, String $msgError = null): Object
    {
        $this->response->code = $code;
        $this->response->idMsg = $idMsg;
        $this->response->idInserido = $idInserido;
        $this->response->dados = $dados;
        $this->response->msgError = $msgError;

        return $this->response;
    }

    public abstract function insert($obj);

    public abstract function update($obj);

    public abstract function delete($obj);

    public abstract function list();

    public abstract function listById(Int $id);

    public function findAll()
    {
        try {
            $sql = "SELECT * FROM {$this->table} order by 1";

            $stmt = $this->connectionPdo->prepare($sql);
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

    public function findById($id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id order by 1";

            $stmt = $this->connectionPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount != 0) {
                // montando resposta
                return $this->response(1, 1003, null, $this->convertItemToObject($stmt->fetchAll(PDO::FETCH_OBJ)[0]));
            }

            // montando resposta
            return $this->response(0, 9005);
        } catch (PDOException $e) {
            // montando resposta
            return $this->response(0, 9004, null, null, $e->getMessage());
        }
    }
}
