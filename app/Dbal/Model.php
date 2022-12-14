<?php

namespace Atsmacode\Framework\Dbal;

use Atsmacode\Framework\Database\Database;

abstract class Model extends Database
{
    protected $table;
    public    $content = [];
    public    $data;

    public function find(array $data = null)
    {
        $rows       = null;
        $properties = $this->compileWhereStatement($data);

        try {
            $stmt = $this->connection->prepare("
                SELECT * FROM {$this->table}
                {$properties}
            ");

            $results = $stmt->executeQuery();
            $rows    = $results->fetchAllAssociative();
        } catch(\Exception $e) {
            error_log(__METHOD__ . ': ' . $e->getMessage());
        }

        if(!$rows){
            return $this;
        }

        $this->content = $rows;

        $this->setModelProperties($rows);

        return $this;
    }

    public function create(array $data = null)
    {
        $id              = null;
        $insertStatement = $this->compileInsertStatement($data);

        try {
            $stmt = $this->connection->prepare($insertStatement);

            /*
             * https://stackoverflow.com/questions/27978175/pdo-bindparam-php-foreach-loop
             * Link above suggested passing by reference is a must - not sure why,
             * need further research into the concept. It seemed the last $value
             * parameter was being set to all the columns without this: &$value
             */
            foreach($data as $column => &$value){
                $stmt->bindParam($column, $value);
            }

            $stmt->executeQuery();

            $id = $this->connection->lastInsertId();
        } catch(\Exception $e) {
            error_log(__METHOD__ . $e->getMessage());
        }

        /** @todo Calling find again, too many queries */
        $this->content = $this->find(['id' => $id])->content;

        return $this;
    }

    /**
     * To be used to update a single model instance.
     *
     * @param array $data
     * @return void
     */
    public function update($data)
    {
        $properties = $this->compileUpdateStatement($data);

        try {
            $stmt = $this->connection->prepare($properties);

            foreach($data as $column => &$value){
                if ($value !== null) { 
                    $stmt->bindParam(':'.$column, $value);
                }
            }

            $stmt->executeQuery();
        } catch(\Exception $e) {
            error_log(__METHOD__ . ': ' . $e->getMessage());
        }

        $this->content = $this->find(['id' => $this->id])->content;

        return $this;
    }

    /**
     * To be used to update a multiple model instances.
     *
     * @param array $data
     * @return void
     */
    public function updateBatch($data, $where = null)
    {
        $properties = $this->compileUpdateBatchStatement($data, $where);

        try {
            $stmt = $this->connection->prepare($properties);

            foreach($data as $column => &$value){
                $stmt->bindParam(':'.$column, $value);
            }

            $stmt->executeQuery();
        } catch(\Exception $e) {
            error_log(__METHOD__ . ': ' . $e->getMessage());
        }

        return $this;
    }

    public function all()
    {
        $rows = null;

        try {
            $stmt = $this->connection->prepare("
                SELECT * FROM {$this->table}
            ");

            $stmt->executeQuery();

            $rows = $stmt->fetchAllAssociative();
        } catch(\Exception $e) {
            error_log(__METHOD__ . ': ' . $e->getMessage());
        }

        $this->content = $rows;

        return $this;
    }

    /**
     * Created this to help with setting NULL values if
     * required. The condition if($value !== null){ causes
     * problem from time to time in the other methods.
     * 
     * TODO ^
     *
     * @param string $column
     * @param string $value
     * @return self
     */
    public function setValue($column, $value)
    {
        $query = sprintf("
            UPDATE
                {$this->table}
            SET
                {$column} = :value
            WHERE
                {$this->table}.id = :id
            LIMIT
                1
        ");

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':value', $value);
            $stmt->executeQuery();

            return $this;
        } catch(\Exception $e) {
            error_log(__METHOD__ . ': ' . $e->getMessage());
        }
    }

    private function compileUpdateStatement($data)
    {
        $properties = "UPDATE {$this->table} SET ";
        $pointer    = 1;

        foreach($data as $column => $value){
            if($value !== null){
                $properties .= $column . " = :". $column;

                if($pointer < count($data)){
                    $properties .= ", ";
                };
            }
            $pointer++;
        }
    
        $properties .= " WHERE id = {$this->id}";

        return $properties;
    }

    private function compileUpdateBatchStatement($data, $where = null)
    {
        $properties = "UPDATE {$this->table} SET ";
        $pointer    = 1;

        foreach($data as $column => $value){
            $properties .= $column . " = :". $column;

            if($pointer < count($data)){
                $properties .= ", ";
            };
            $pointer++;
        };

        if ($where) {
            $properties .= " WHERE {$where}";
        }

        return $properties;
    }

    private function compileWhereStatement($data)
    {
        $properties = "WHERE ";
        $pointer    = 1;

        foreach($data as $column => $value){

            if($value === null) {
                $properties .= $column . " IS NULL";
            } else if(is_int($value)) {
                $properties .= $column . " = ". $value;
            } else {
                $properties .= $column . " = '". $value . "'";
            }

            if($pointer < count($data)){
                $properties .= " AND ";
            };

            $pointer++;
        }

        return $properties;
    }

    private function compileInsertStatement($data)
    {
        $properties = "INSERT INTO {$this->table} (";
        $properties = $this->compileColumns($data, $properties);
        $properties .= "VALUES (";

        reset($data);

        $properties = $this->compileValues($data, $properties);

        return $properties;
    }

    private function compileColumns($data, $properties)
    {
        $pointer = 1;

        foreach(array_keys($data) as $column){
            $properties .= $column;

            if($pointer < count($data)){
                $properties .= ", ";
            } else {
                $properties .= ") ";
            };
            $pointer++;
        }

        return $properties;
    }

    private function compileValues($data, $properties)
    {
        $pointer = 1;
        
        foreach(array_keys($data) as $column){
            $properties .= ':'.$column;

            if($pointer < count($data)){
                $properties .= ", ";
            } else {
                $properties .= ")";
            };
            $pointer++;
        }

        return $properties;
    }

    protected function setModelProperties($result)
    {
        if(count($result) === 1){
            foreach (array_shift($result) as $column => $value) {
                $this->{$column} = $value;
            }
        }
    }

    public function isNotEmpty()
    {
        return count($this->content) > 0;
    }

    public function contains(array $data)
    {
        return in_array($data, $this->content);
    }
}
