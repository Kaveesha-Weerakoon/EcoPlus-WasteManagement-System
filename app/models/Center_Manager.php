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
      $this->db->bind(':name', $data->name);
      $this->db->bind(':email', $data->email);
      $this->db->bind(':password', $data->password);
      $result = $this->db->execute();
      if ($result) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',$data->email);
        $row = $this->db->single();
    
        // Check if the user was successfully inserted and retrieved
        if ($row) {
            $user_id = $row->id; // Assuming 'user_id' is the correct column name
    
            $this->db->query('INSERT INTO center_managers (user_id, contact_no, address, nic,dob,image) VALUES (:user_id, :mobile_number, :address, :nic,:dob,:image)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':mobile_number',$data->contact_no);
            $this->db->bind(':address', $data->address);
            $this->db->bind(':nic', $data->nic);
            $this->db->bind(':dob', $data->dob);
            $this->db->bind(':image', "profile.png");
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
      try{
      $this->db->query('SELECT *,
              center_managers.id as cmID,
              users.id as userId
              FROM center_managers
              INNER JOIN users
              ON center_managers.user_id = users.id');
      $results = $this->db->resultSet();
      return $results;}catch(PDOException $e){
        echo 'An error occurred: ' . $e->getMessage();
        return false;
      }
    }

    public function getCenterManagerByNIC($NIC){
      try{
      $this->db->query('SELECT * FROM center_managers WHERE nic = :nic');
      $this->db->bind(':nic', $NIC);

      $row = $this->db->single();

      return $row;
      }catch(PDOException $e){
        echo 'An error occurred: ' . $e->getMessage();
        return false;
      }

    }

    public function getCenterManagerByID($data){
try{
      $this->db->query('SELECT * FROM center_managers WHERE user_id = :managerId');
      $this->db->bind(':managerId', $data);

      $row = $this->db->single();

      return $row;}catch(PDOException $e){
        echo 'An error occurred: ' . $e->getMessage();
        return false;
      }
    }

    public function getCenterManagerByNIC_except($NIC, $managerId){
      try{
      $this->db->query('SELECT * FROM center_managers WHERE nic = :nic AND user_id <> :id'); 
      $this->db->bind(':nic', $NIC);
      $this->db->bind(':id', $managerId);

      $rows = $this->db->resultSet();

      //check whether there are center managers with the entered NIC
      if($this->db->rowCount() > 0){
        return true;
      } 
      else {
        return false;
      }
    }
    catch(PDOException $e){
      echo 'An error occurred: ' . $e->getMessage();
      return false;
    }}

    public function getCenterManagerBy_centerId($center_id){
      try{

      
      $this->db->query('SELECT * FROM center_managers WHERE assigned_center_id = :centerId');
      $this->db->bind(':centerId', $center_id);

      $row = $this->db->single();
      return $row;}catch(PDOException $e){
        echo 'An error occurred: ' . $e->getMessage();
        return false;
      }
    }

    public function get_Non_Assigned_CenterManger(){
      try{
      $this->db->query('SELECT *,
              center_managers.id as cmID,
              users.id as userId
              FROM center_managers
              INNER JOIN users
              ON center_managers.user_id = users.id
              WHERE center_managers.assinged = "No"');
      $results = $this->db->resultSet();
      return $results;
    }catch(PDOException $e){
      echo 'An error occurred: ' . $e->getMessage();
      return false;
    }}

    public function delete_centermanager($centermanagerId){
      try{
      $this->db->query('DELETE FROM users WHERE id = :centermanagerId');
      $this->db->bind(':centermanagerId', $centermanagerId);

      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }}catch(PDOException $e){
        echo 'An error occurred: ' . $e->getMessage();
        return false;
      }

    }
    

    public function change_center_managers($new_manager, $old_manager, $center_id) {
     try{
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
     }catch (PDOException $e) {
      return false;
     }
  }

    public function Remove_Assign($center_manager_id){
      try{
      $updateManagerQuery = 'UPDATE center_managers SET assinged = "No", assigned_center_id = :assigned_center_id WHERE user_id = :centerManagerId';
      $val = 0;
      $this->db->query($updateManagerQuery);
      $this->db->bind(':centerManagerId',$center_manager_id);
      $this->db->bind(':assigned_center_id', $val);
      
      $result=$this->db->execute();}catch(PDOException $e){
        echo 'An error occurred: ' . $e->getMessage();
        return false;
      }
    }
  
    public function update_center_managers($data){
      $this->db->query('UPDATE users SET name = :name WHERE id= :managerId');
      $this->db->bind(':managerId', $data['id']);
      $this->db->bind(':name', $data['name']);
      
      $result1 = $this->db->execute();
      if($result1){
        $this->db->query('UPDATE center_managers SET nic = :nic, address = :address, contact_no = :contact_no, dob = :dob WHERE user_id = :collectorId');
        $this->db->bind(':collectorId', $data['id']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);

        $result2 = $this->db->execute();
        if($result2){
          return $result2;
        }
        else{
          return false;
        }

      }else{
        return false;
      }


    }

    public function getCenterManager_ByID_view($managerId){
      $this->db->query('SELECT *
                        FROM center_managers
                        INNER JOIN users
                        ON center_managers.user_id = users.id
                        WHERE center_managers.user_id = :manager_Id'); 
      $this->db->bind(':manager_Id', $managerId);
      
      $row = $this->db->single();
      return $row;

    }
  
    public function editprofile($data){

      $this->db->query('UPDATE users SET name = :value WHERE id = :id');
      $this->db->bind(':value', $data['name']);
      $this->db->bind(':id', $_SESSION['center_manager_id']);
      $_SESSION['center_manager_name']=$data['name'];
      
      if ($this->db->execute()) {
        $this->db->query('UPDATE center_managers SET address = :address, contact_no = :contact_number WHERE user_id = :customer_id');
        $this->db->bind(':address',  $data['address']);
        $this->db->bind(':contact_number',  $data['contactno']);
        $this->db->bind(':customer_id',  $_SESSION['center_manager_id']);
        
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
        $this->db->bind(':id', $_SESSION['center_manager_id']);

        $_SESSION['user_name']=$data['name'];
        $_SESSION['cm_profile'] =$data['profile_image_name'];

        if ($this->db->execute()) {
           $this->db->query('UPDATE center_managers SET address = :address, contact_no = :contact_number,  image = :image WHERE user_id = :customer_id');
           $this->db->bind(':address', $data['address']);
           $this->db->bind(':contact_number', $data['contactno']);
           $this->db->bind(':customer_id', $_SESSION['center_manager_id']);
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

    public function mark_holidays($data){
      try{
        $this->db->query('INSERT INTO holidays (center_id, region, date) VALUES (:center_id, :region, :date)');
        $this->db->bind(':center_id', $data['center_id']);
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':date', $data['holiday']);
        $result = $this->db->execute();

        if($result){
          return $result;

        }else{
          return false;
        }


      }catch(Exception $e){
        //echo 'Error: ' . $e->getMessage();
        return false;
        

      }

    }

    public function get_marked_holidays($region){
      try{
        $this->db->query('SELECT date FROM holidays WHERE region = :region');
        $this->db->bind(':region', $region);
        $results = $this->db->resultSet();

        return $results;

      }catch(Exception $e){
        return false;
      }
    }

    public function update_cm_to_na($id){
      try{
         
          $this->db->query('UPDATE center_managers SET assinged = :value, assigned_center_id = :value2 WHERE user_id = :id');
          $this->db->bind(':value', "No");
          $this->db->bind(':value2', 0);   
          $this->db->bind(':id', $id);   
      
  
          return $this->db->execute();
      }
      catch(Exception $e){
          die($e->getMessage());
          return false;
      }
  }
  
}