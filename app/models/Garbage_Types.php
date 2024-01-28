<?php
  class Garbage_Types{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
    
    public function get_all(){
       try{
        $this->db->query('SELECT * FROM garbage_types');
  
        $results = $this->db->resultSet();
        return $results;  
       }catch (PDOException $e) {
        return false;
    }
    }

  }