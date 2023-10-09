<?php
require_once 'db.php';

class User extends Database
{

    protected $tableName = 'users';

    public function addUser($data)
    {

        if (!empty($data)) {
            $fields = $placeholders = [];

            foreach ($data as $field => $value) {
                $fields[] = $field;
                $placeholders[] = ":{$field}";
            }
        }

        $query = "INSERT INTO {$this->tableName} (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt  = $this->conn->prepare($query);

        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $this->conn->commit();
            $lastInsertedId =   $this->conn->lastInsertId();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->conn->rollBack();
        }
    }

    public function getUsers($start = 0, $limit = 4)
    {

        $query = "SELECT * FROM {$this->tableName} ORDER BY DESC LIMIT {$start}, {$limit} ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }


    public function getSingleUser($field, $value)
    {

        $query = "SELECT * FROM {$this->tableName} WHERE {$field}=:{$value} ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":{$field}" => $value]);
        if ($stmt->rowCount() > 0) {
            $result  = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }

        return $result;
    }
}
