<?php
require_once("../app/configuration/database.php") ; 

Class Model { 
    use Database ;
    private $table ;   

    public function __construct($table) {
        $this->table = $table;
    }

    function selectwhere($data) {

        $query = "SELECT * FROM $this->table WHERE "; 
        $keys = array_keys($data) ; 
        $str="" ; 

        foreach($keys as $key) { 
            $query = $query . $key . " = :" . $key . " && " ; 
        } 
        $query = trim ($query , " && ");


        $rows = $this->requete($query , $data) ; 
        return $rows  ;

       
    }



    function insert($data) { 
      $keys = array_keys($data) ; 
      $query = "INSERT INTO $this->table(".implode("," , $keys).") VALUES (:".implode(",:" , $keys).")" ; 
      $result = $this->requete($query , $data) ; 
     
      

    }


    function selectAll() { 
        $query = "SELECT * FROM $this->table"; 
        $rows = $this->requete($query) ; 
      
        return $rows ;

    }


    function update($conditions , $data) {
      
        $setPart = [];
        foreach (array_keys($data) as $key) {
            $setPart[] = "$key = :$key";
        }
        $setQuery = implode(", ", $setPart);
    
      
        $wherePart = [];
        foreach (array_keys($conditions) as $key) {
            $wherePart[] = "$key = :cond_$key";
        }
        $whereQuery = implode(" AND ", $wherePart);
    
        
        $query = "UPDATE $this->table SET $setQuery WHERE $whereQuery";
    
        
        $params = array_merge(
            $data,
            array_combine(
                array_map(fn($key) => "cond_$key", array_keys($conditions)),
                array_values($conditions)
            )
        );
    
       
        return $this->requete($query, $params);
    }

    
    function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id"; 
        $params = ['id' => $id]; 
        $result = $this->requete($query, $params); 
    
        return $result; 
    }



    function selectAttributes($attributes, $conditions = [], $negations = []) {
    
        $columns = $attributes ? implode(", ", $attributes) : "*";
        $query = "SELECT $columns FROM $this->table";
    
        $wherePart = [];
    

        if (!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                $wherePart[] = "$key = :$key";
            }
        }
    

        if (!empty($negations)) {
            foreach ($negations as $key => $value) {
                $wherePart[] = "$key != :neg_$key"; 
            }
        }

        if (!empty($wherePart)) {
            $query .= " WHERE " . implode(" AND ", $wherePart);
        }
    

        $parameters = array_merge(
            $conditions, 
            array_combine(
                array_map(fn($key) => "neg_$key", array_keys($negations)), 
                array_values($negations)
            )
        );
    
   
        $rows = $this->requete($query, $parameters);
        return $rows;
    }
    


    function getColumnValues($column, $conditions = []) {
        $query = "SELECT $column FROM $this->table";

        if (!empty($conditions)) {
            $wherePart = [];
            foreach (array_keys($conditions) as $key) {
                $wherePart[] = "$key = :$key";
            }
            $query .= " WHERE " . implode(" AND ", $wherePart);
        }

        $rows = $this->requete($query, $conditions);

     
        $values = [];
        foreach ($rows as $row) {
            $values[] = $row[$column];
        }

        return $values;
    }
}
    



?>