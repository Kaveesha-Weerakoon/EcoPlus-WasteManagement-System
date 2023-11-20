<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function register($data){

      $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "customer")');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $result = $this->db->execute();
      
      if ($result) {
          $this->db->query('SELECT * FROM users WHERE email = :email');
          $this->db->bind(':email', $data['email']);
          $row = $this->db->single();
      
          // Check if the user was successfully inserted and retrieved
          if ($row) {
              $user_id = $row->id; // Assuming 'user_id' is the correct column name
      
              $this->db->query('INSERT INTO customers (user_id, mobile_number, address, city,image) VALUES (:user_id, :mobile_number, :address, :city,:image)');
              $this->db->bind(':user_id', $user_id);
              $this->db->bind(':mobile_number', $data['contact_no']);
              $this->db->bind(':address', $data['address']);
              $this->db->bind(':city', $data['city']);
              $this->db->bind(':image', $data['profile_image_name']);
              $result_customer_insert = $this->db->execute();

            if ($result_customer_insert) {
                $this->db->query('INSERT INTO customer_credits (user_id, credit_amount) VALUES (:user_id, 100)');
                $this->db->bind(':user_id', $user_id);

                $result_credit_insert = $this->db->execute();

                // Return true or false based on the final insert into customer_credits
                return $result_credit_insert;
            }else {
            // Handle failure in inserting into the 'customers' table
              
              $result = $this->db->execute();
      
              // Return true or false based on the final insert
              return $result;
          } 

          } else {
            // Handle the case where the user was not found in the database
            return false;
        }

      } else {
        // Handle the case where the user was not inserted into the 'users' table
        return false;
    }

  }
                          


    public function login($email, $password){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }
    
    public function findUserByEmail($email){
      
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    public function findUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :user_id');
      $this->db->bind(':user_id', $id);
      
      $row = $this->db->single();
      
      // Check row
      if ($this->db->rowCount() > 0) {
          return $row; // Returning user data if found
      } else {
          return null; // Return null or false if user is not found
      }
    }

    public function deleteuser($id){
      $this->db->query('DELETE FROM users WHERE id = :id');
      $this->db->bind(':id', $id);
      $result = $this->db->execute();
    }
  }