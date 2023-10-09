<?php
require_once 'Database.php';

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
            $lastInsertedId =   $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->conn->rollBack();
        }
    }

    public function updateUser($data, $user_id)
    {

        if (!empty($data)) {
            $fields = '';
            $x = 1;
            $fieldsCount = count($data);
            foreach ($data as $field => $value) {
                $fields .= "{$field} = :{$field}";
                if ($x < $fieldsCount) {

                    $fields .= ", ";
                }
                $x++;
            }
        }
        $query = "UPDATE {$this->tableName} SET {$fields} WHERE user_id=:user_id";

        $stmt  = $this->conn->prepare($query);

        try {
            $this->conn->beginTransaction();
            $data['user_id'] = $user_id;
            $stmt->execute($data);
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->conn->rollBack();
        }
    }

    public function getUsers()
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


    public function getSingleUser($field, $value)
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
    public function deleteUser($user_id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE user_id=:user_id";


        $stmt = $this->conn->prepare($query);

        try {
            $stmt->execute([":user_id" => $user_id]);
            if ($stmt->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            return false;
        }
    }
}
