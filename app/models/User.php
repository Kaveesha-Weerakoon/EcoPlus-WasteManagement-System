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
      
              $this->db->query('INSERT INTO customers (user_id, mobile_number, address, city) VALUES (:user_id, :mobile_number, :address, :city)');
              $this->db->bind(':user_id', $user_id);
              $this->db->bind(':mobile_number', $data['contact_no']);
              $this->db->bind(':address', $data['address']);
              $this->db->bind(':city', $data['city']);
      
              $result = $this->db->execute();
      
              // Return true or false based on the final insert
              return $result;
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
  }