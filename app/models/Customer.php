<?php
  class Customer {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function complains($data){
      $id= $_SESSION['user_id'];
      $this->db->query('INSERT INTO customer_complains (customer_id,name,contact_no, region,subject,complaint) VALUES (:customer_id,:name,:contact_no,:region,:subject,:complaint)');
      // Bind values

      $this->db->bind(':customer_id', $id);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':contact_no', $data['contact_no']);
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':complaint', $data['complain']);
      $this->db->bind(':region', $data['region']);

      $result = $this->db->execute();
      
      if ($result) {
              return $result; 
      } else {
          // Handle the case where the user was not inserted into the 'users' table
          return false;
      }
    }

}
    