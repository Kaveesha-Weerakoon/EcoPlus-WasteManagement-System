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
       $this->db->bind(':id', $id);

       if($this->db->execute()){
         return true;
      } else {
        return false;
      }
     }

     public function editprofile($data){

            $this->db->query('UPDATE users SET name = :value WHERE id = :id');
            $this->db->bind(':value', $data['name']);
            $this->db->bind(':id', $_SESSION['user_id']);
            $_SESSION['user_name']=$data['name'];

            if ($this->db->execute()) {
              $this->db->query('UPDATE customers SET address = :address, mobile_number = :contact_number, city = :city WHERE user_id = :customer_id');
              $this->db->bind(':address',  $data['address']);
              $this->db->bind(':contact_number',  $data['contactno']);
              $this->db->bind(':city',  $data['city']);
              $this->db->bind(':customer_id',  $_SESSION['user_id']);
             
              if ($this->db->execute()) {
                  return true; 
              } else {
                  return false; 
              }          
         }else {
             return false; 
         }
     }

    public function editprofile_withimg($data){

      $this->db->query('UPDATE users SET name = :value WHERE id = :id');
      $this->db->bind(':value', $data['name']);
      $this->db->bind(':id', $_SESSION['user_id']);

      $_SESSION['user_name']=$data['name'];
      $_SESSION['customer_profile'] =$data['profile_image_name'];

      if ($this->db->execute()) {
        $this->db->query('UPDATE customers SET address = :address, mobile_number = :contact_number, city = :city, image = :image WHERE user_id = :customer_id');
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact_number', $data['contactno']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':customer_id', $_SESSION['user_id']);
        $this->db->bind(':image', $data['profile_image_name']);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }          
       }else {
         return false; 
      }
    }
    
    
    public function deletecustomer($id){
      $this->db->query('DELETE FROM users WHERE id = :id');
      $this->db->bind(':id', $id);

      if($this->db->execute()){
        return true;
     } else {
       return false;
     }
    }
}
    