<?php
  class Center_Manager{
    private $db;

    public function __construct(){

      $this->db = new Database;
    }

    public function register_center_manager($data){
      $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "centermanager")');
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
    
            $this->db->query('INSERT INTO center_managers (user_id, contact_no, address, nic,dob) VALUES (:user_id, :mobile_number, :address, :nic,:dob)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':mobile_number', $data['contact_no']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':dob', $data['dob']);
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

    public function get_center_managers(){
      $this->db->query('SELECT *,
              center_managers.id as cmID,
              users.id as userId
              FROM center_managers
              INNER JOIN users
              ON center_managers.user_id = users.id');
      $results = $this->db->resultSet();
      return $results;
    }


  }
