<?php

namespace App\Core\DB;

use App\Core\DB\DBConnection;
use PDO;

class PDORepository
{
    protected $table = '';
    protected $primaryKey = 'id';
    protected $fields = '*';
    protected $connection;

    public function __construct(string $database = null)
    {
        $this->connection = DBConnection::getConnection($database);
    }

    public function getFields(array $fields)
    {
        if (is_array($fields) && count($fields) >= 0) {
            $result = implode(', ', $fields);
        }
        return $fields;
    }

    public function getAll(): array
    {
        $sql = sprintf("SELECT %s FROM %s", $this->fields, $this->table);
        return $this->connection
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array
    {
        $result = $this->connection->prepare(
            "select * from {$this->table} where {$this->primaryKey} = ? "
        );
        $result->bindParam(1, $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($params = [])
    {
        $fields = array_keys($params);
        $fields = implode(',', $fields);
        $values = array_values($params);

        $valueAlias = '?';

        for ($i = 0; $i < count($params) - 1; $i++) {
            $valueAlias .= ',?';
        }

        $stmt = $this->connection->prepare(
            "insert into {$this->table} ($fields) values ($valueAlias)"
        );

        for ($i = 1; $i <= count($params); $i++) {
            $stmt->bindParam($i, $values[$i - 1]);
        }
        $stmt->execute();

        return $this->lastInsertId();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollBack()
    {
        $this->connection->rollBack();
    }

}

