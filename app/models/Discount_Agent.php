<?php
  class Discount_Agent{
    private $db;
    private $re;

    public function __construct(){

      $this->db = new Database;
      $this->re = new Database;
    }

    public function register_discount_agent($data){
      $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "discountagent")');
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
    
            $this->db->query('INSERT INTO discount_agents (user_id,contact_no, address,image) VALUES (:user_id, :mobile_number, :address,:image)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':mobile_number', $data['contact_no']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':image', $data['profile_image_name']);
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

    public function get_discount_agent(){
      $this->db->query('SELECT *,
              discount_agents.id as AgentID,
              users.id as userId
              FROM discount_agents
              INNER JOIN users
              ON discount_agents.user_id = users.id');
      $results = $this->db->resultSet();
      return $results;
    }

    public function getDiscountAgentByID($data){

      $this->db->query('SELECT * FROM discount_agents WHERE user_id = :agentId');
      $this->db->bind(':agentId', $data);

      $row = $this->db->single();

      return $row;
    }


    public function discount_agent_delete($id){
      $this->db->query('DELETE FROM users WHERE id = :discountAgentId');
      $this->db->bind(':discountAgentId', $id);

      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }

    }


    public function editprofile($data){

      $this->db->query('UPDATE users SET name = :value WHERE id = :id');
      $this->db->bind(':value', $data['name']);
      $this->db->bind(':id', $_SESSION['agent_id']);
      $_SESSION['agent_name']=$data['name'];
      if ($this->db->execute()) {
        $this->db->query('UPDATE discount_agents SET address = :address, contact_no = :contact_number WHERE user_id = :agent_id');
        $this->db->bind(':address',  $data['address']);
        $this->db->bind(':contact_number',  $data['contactno']);
        $this->db->bind(':agent_id',  $_SESSION['agent_id']);
       
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
        $this->db->bind(':id', $_SESSION['collector_id']);

        $_SESSION['user_name']=$data['name'];
         $_SESSION['collector_profile'] =$data['profile_image_name'];

        if ($this->db->execute()) {
           $this->db->query('UPDATE discount_agents SET address = :address, contact_no = :contact_number,  image = :image WHERE agent_id = :agent_id');
           $this->db->bind(':address', $data['address']);
           $this->db->bind(':contact_number', $data['contactno']);
           $this->db->bind(':agent_id', $_SESSION['agent_id']);
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
    

 
  }