<?php
require_once 'Database.php';

class Address extends Database
{
    protected $tableName = 'user_address';

    public function addAddress($data)
    {

        if (!empty($data)) {
            $fields = $placeholders = [];
            foreach ($data as $field => $value) {
                $fields[] = $field;
                $placeholders[] = ":{$field}";
            }
        }

        $query = "INSERT INTO {$this->tableName} (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $this->conn->prepare($query);

        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertedId =   $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->conn->rollBack();
        }  //throw $th;
    }


    public function getAddress()
    {

        $query = "SELECT * FROM {$this->tableName} ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }

    public function getSingleAddress($field, $value)
    {

        $query = "SELECT * FROM {$this->tableName} WHERE {$field}=:{$field} ";
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
