<?php
  class Center_Manager{
    private $db;
    private $re;

    public function __construct(){

      $this->db = new Database;
      $this->re = new Database;
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

    public function getCenterManagerByNIC($NIC){
      $this->db->query('SELECT * FROM center_managers WHERE nic = :nic');
      $this->db->bind(':nic', $NIC);

      $row = $this->db->single();

      return $row;

    }

    public function getCenterManagerByID($data){

      $this->db->query('SELECT * FROM center_managers WHERE user_id = :assisId');
      $this->db->bind(':assisId', $data);

      $row = $this->db->single();

      return $row;
    }

    public function get_Non_Assigned_CenterManger(){
      $this->db->query('SELECT *,
              center_managers.id as cmID,
              users.id as userId
              FROM center_managers
              INNER JOIN users
              ON center_managers.user_id = users.id
              WHERE center_managers.assinged = "No"');
      $results = $this->db->resultSet();
      return $results;
    }

    public function delete_centermanager($centermanagerId){
      $this->db->query('DELETE FROM users WHERE id = :centermanagerId');
      $this->db->bind(':centermanagerId', $centermanagerId);

      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }

    }
    

    public function change_center_managers($new_manager, $old_manager, $center_id) {
      $updateManagerQuery = 'UPDATE center_managers SET assinged = "True", assigned_center_id = :assigned_center_id WHERE user_id = :centerManagerId';
  
      $this->db->query($updateManagerQuery);
      $this->db->bind(':centerManagerId', $new_manager->user_id);
      $this->db->bind(':assigned_center_id', $center_id);
      
      $result=$this->db->execute();
      if($result){
        $updateManagerQuery2 = 'UPDATE center_managers SET assinged = "No", assigned_center_id = :assigned_center_id2 WHERE user_id = :centerManagerId2';
     
        $val = 0;
        $this->re->query($updateManagerQuery2);
        $this->re->bind(':assigned_center_id2', $val);
        $this->re->bind(':centerManagerId2', $old_manager->user_id);
         $this->re->execute();
      }
  }
  
  
}
