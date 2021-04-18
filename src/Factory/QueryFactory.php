<?php

namespace Solutions\Factory;

use PDO;

final class QueryFactory
{
    private PDO $connection;

    /**
     * The constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function newInsert(string $table, array $data): bool
    {
        $keys = array_keys($data);
        $result = [];
        foreach ($data as $key => $value) {
            $result[':' . $key] = $value;
        }
        $sql = "INSERT INTO ".$table." (".implode(',',$keys).") VALUES (".implode(',',array_keys($result)).")";

        $statement = $this->connection->prepare($sql);
        return $statement->execute($result);
    }

/*

    public function newSelect(string $table): Query
    {
        return $this->newQuery()->from($table);
    }


    public function newQuery(): Query
    {
        return $this->connection->newQuery();
    }


    public function newUpdate(string $table, array $data): Query
    {
        return $this->newQuery()->update($table)->set($data);
    }


    public function newInsert(string $table, array $data): Query
    {
        return $this->newQuery()->insert(array_keys($data))
            ->into($table)
            ->values($data);
    }


    public function newDelete(string $table): Query
    {
        return $this->newQuery()->delete($table);
    }*/
}