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

    public function get_details_by_id($id){
      try{
        $this->db->query('SELECT * FROM garbage_types WHERE ID= :id');
        $this->db->bind(':id', $id);

        $result = $this->db->single();
        return $result;

      }catch (PDOException $e){
        return false;
      }
    }

  }