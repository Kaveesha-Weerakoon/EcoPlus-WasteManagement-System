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

    public function get_complains($id) {
      $this->db->query('SELECT * FROM customer_complains WHERE customer_id = :id ORDER BY customer_complains.date DESC');
      $this->db->bind(':id', $id);
      $results = $this->db->resultSet();
      
      return $results;
  }


   public function get_customer($id){
    $this->db->query('SELECT * FROM customers WHERE user_id = :id');
    $this->db->bind(':id', $id);
    $results = $this->db->getOne();
    
    return $results;
   }

}
    