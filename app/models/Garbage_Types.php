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

    public function update_garbage_types($data){
      try{
        $this->db->query('UPDATE garbage_types SET name= :garbage_type, credits_per_waste_quantity = :credits, approximate_amount= :approximate_amount, minimum_amount=:minimum_amount, selling_price=:selling_price WHERE ID =:garbage_id');
        $this->db->bind(':garbage_id', $data['id']);
        $this->db->bind(':garbage_type', $data['garbage_type']);
        $this->db->bind(':credits', $data['credit_per_waste_quantity']);
        $this->db->bind(':approximate_amount', $data['approximate_amount']);
        $this->db->bind(':minimum_amount', $data['minimum_amount']);
        $this->db->bind(':selling_price', $data['selling_price']);
  
        $result = $this->db->execute();
        return $result;

      }catch (PDOException $e){
        return false;
      }
     
    }

  }