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

    public function newUpdate(string $table, array $data): bool
    {
        $keys = array_keys($data);
        $result = [];
        $id = "'".$data['id']."'";
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $result[$key.'='.':' . $key] = $value;
            }
        }

        //UPDATE Customers SET rating = 200 WHERE snum = 1001;
        $sql = "UPDATE ".$table." SET ".implode(',',array_keys($result))." WHERE id=".$id;

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':title',$data['title']);
        $statement->bindParam(':created_at',$data['created_at']);
        $statement->bindParam(':parent_id',$data['parent_id']);
        $statement->execute($result);

    }

    public function newSelectAll(string $table): array
    {
        $statement = $this->connection->query('SELECT * FROM '.$table);
        return $statement->fetchAll();
    }

    public function newSelectOne(string $table, string $id): object
    {
        $statement = $this->connection->query('SELECT * FROM '.$table.' WHERE id='."'". $id."'");
        return $statement->fetchObject();
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