<?php
  class Customer {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

     public function get_customer($id){
       $this->db->query('SELECT * FROM customers WHERE user_id = :id');
      $this->db->bind(':id', $id);
      $results = $this->db->single();
      // print_r($results);
       return $results;
     }

     public function get_all(){
      $this->db->query('SELECT *,
      customers.id as cID,
      users.id as userId
      FROM customers
      INNER JOIN users
      ON customers.user_id = users.id');
           $results = $this->db->resultSet();
           return $results;
     }

     public function deletecomplain($id){
       $this->db->query('DELETE FROM customers WHERE id = :id');
      // Bind values
       $this->db->bind(':id', $id);

      // Execute
       if($this->db->execute()){
         return true;
      } else {
        return false;
      }
     }

}
    