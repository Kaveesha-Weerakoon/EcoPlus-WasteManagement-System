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
    
    public function getDiscountAgentByID2($data){
      try{
      $this->db->query('SELECT * FROM users INNER JOIN discount_agents ON users.id=discount_agents.user_id WHERE user_id = :agentId');
      $this->db->bind(':agentId', $data);

      $row = $this->db->single();

      return $row; 
     }
      catch (PDOException $e) {
        return false;
     }
    }

    
    public function addcredits($data){
      try {
          // Update the credits for the discount agent
          $this->db->query('UPDATE discount_agents SET credits = :new_balance WHERE user_id = :user_id1');
          $this->db->bind(':new_balance', $data['new_balance']);
          $this->db->bind(':user_id1', $data['agent']->user_id); // corrected access to user_id property
          $result = $this->db->execute();
          if ($result) {
              // Insert a new entry into the discountagent_credit table
              $this->db->query('INSERT INTO discountagent_credit (agent_id, credited_amount) VALUES (:agent_id, :credits)');
              $this->db->bind(':agent_id', $data['agent']->user_id);
              $this->db->bind(':credits', $data['credit']); // corrected variable name
              $insertResult = $this->db->execute();
              return $insertResult;
          }
      } catch (PDOException $e) {
          // Handle exceptions
          die($e->getMessage()); // corrected access to getMessage method
          return false;
      }
    }
    
    public function getCreditlog($id){
      try{
        $this->db->query('SELECT * FROM discountagent_credit WHERE agent_id = :id ORDER BY credited_date DESC');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        return $results;
       } 
       catch (PDOException $e) {
        die($e);
          return false;
       }
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
        $this->db->bind(':id', $_SESSION['agent_id']);

        $_SESSION['user_name']=$data['name'];
         $_SESSION['agent_profile'] =$data['profile_image_name'];

        if ($this->db->execute()) {
           $this->db->query('UPDATE discount_agents SET address = :address, contact_no = :contact_number,  image = :image WHERE user_id = :user_id');
           $this->db->bind(':address', $data['address']);
           $this->db->bind(':contact_number', $data['contactno']);
           $this->db->bind(':user_id', $_SESSION['agent_id']);
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


    public function addDiscount($customer_id, $customer_name, $discount_amount, $center,$agent_id) {
        try{
          $this->db->query('INSERT INTO discounts (customer_id, customer_name,agent_id, discount_amount, center) VALUES (:customer_id, :customer_name,:agent_id, :discount_amount, :center)');
          $this->db->bind(':customer_id', $customer_id);
          $this->db->bind(':customer_name', $customer_name);
          $this->db->bind(':discount_amount', $discount_amount);        
          $this->db->bind(':agent_id', $agent_id);
          $this->db->bind(':center', $center);
  
          return $this->db->execute();
        }
        catch (PDOException $e) {
          return false;
       }
      
    }


    public function get_discount($id) {
      try{ $this->db->query('SELECT * FROM discounts d JOIN users da ON da.id=d.agent_id  WHERE customer_id = :id ');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
      
        return $results; } 
        catch (PDOException $e) {
           return false;
        }
    }

    public function getDiscountByAgent($id){
       try{
      $this->db->query('SELECT * FROM discounts WHERE agent_id = :id ORDER BY created_at DESC');
      $this->db->bind(':id', $id);
      $results = $this->db->resultSet();
      return $results;
     } 
     catch (PDOException $e) {
        return false;
     }
    }
    
  

          

 
  }