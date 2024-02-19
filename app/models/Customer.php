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
       return $results;
     }

     public function get_fined_requests($id) {
      try{
        $query = 'SELECT * FROM request_main r
        LEFT JOIN request_cancelled rc ON rc.req_id = r.req_id
        WHERE r.customer_id = :id AND rc.fine_type != \'None\'';

        $this->db->query($query);
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();
        return $results;
      }
      catch (PDOException $e) {
        return false;
    }
      
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

     public function block($id){
      try {
          $this->db->query('UPDATE customers SET blocked = :value WHERE user_id = :id');
          $this->db->bind(':value', TRUE); // You need to provide a value for ":value"
          $this->db->bind(':id', $id);
          $this->db->execute();
      } catch (PDOException $e) {
          die($e->getMessage());
      }
  } 
  
  public function unblock($id){
    try {
        $this->db->query('UPDATE customers SET blocked = :value WHERE user_id = :id');
        $this->db->bind(':value', FALSE); // You need to provide a value for ":value"
        $this->db->bind(':id', $id);
        $this->db->execute();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}



public function get_Cus_all_details($id){
      $this->db->query('SELECT *,
      customers.id as cID,
      users.id as userId,
      users.name as name
      FROM customers
      INNER JOIN users
      ON customers.user_id = users.id
      WHERE user_id = :id');
       $this->db->bind(':id', $id);

       $result = $this->db->single(); 
       return $result;
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

    public function getTotalGarbage($id){
      try{
        $this->db->query('SELECT * FROM customer_total_garbage WHERE user_id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->single();
         return $results;
      }
      catch (PDOException $e) {
        return false;
      }
    }

    public function get_customers_count($region) {
      try {
        $this->db->query('SELECT * FROM customers WHERE city= :region');
        $this->db->bind(':region', $region);

        $rows = $this->db->resultSet();
    
        $customer_count = $this->db->rowCount();
        return $customer_count; 

      }catch (PDOException $e) {
        return false;
      }
    }

    public function get_Notification($id) {
      try {
        $this->db->query('SELECT * FROM user_notification WHERE user_id = :id AND mark_as_read = "False" ORDER BY datetime DESC');          $this->db->bind(':id', $id);          
          $results = $this->db->resultSet();
          return $results;
      } catch (PDOException $e) {
          return false;
      }
    }
 
  public function view_Notification($id){
    try {
      $this->db->query('UPDATE user_notification SET mark_as_read = :new_value WHERE user_id = :id AND mark_as_read IN ("False")');
      
      $new_value = "True";
      $this->db->bind(':new_value', $new_value);
      $this->db->bind(':id', $id);
      
      $this->db->execute();
  
      if ($this->db->rowCount() > 0) {
          return true;
      } else {
          return false;
      }
  } catch (PDOException $e) {
      return false;
  }
  }
}
       