<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function register($data){
     try{
      $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "customer")');
      // Bind values
      $this->db->bind(':name', $data->name);
      $this->db->bind(':email', $data->email);
      $this->db->bind(':password', $data->password);
      $result = $this->db->execute();
      
      if ($result) {
          $this->db->query('SELECT * FROM users WHERE email = :email');
          $this->db->bind(':email', $data->email);
          $row = $this->db->single();
      
          if ($row) {
              $user_id = $row->id; 
      
              $this->db->query('INSERT INTO customers (user_id, mobile_number, address, city,image) VALUES (:user_id, :mobile_number, :address, :city,:image)');
              $this->db->bind(':user_id', $user_id);
              $this->db->bind(':mobile_number', $data->mobile_number);
              $this->db->bind(':address', $data->address);
              $this->db->bind(':city', $data->city);
              $this->db->bind(':image', "profile.png");
              $result_customer_insert = $this->db->execute();

              if ($result_customer_insert) {
                $this->db->query('INSERT INTO customer_credits (user_id, credit_amount) VALUES (:user_id, 0)');
                $this->db->bind(':user_id', $user_id);
                $result_credit_insert = $this->db->execute();
                return $row  ;
                
            } else {
                return false; // Failed to insert customer data
            }
          } else {
            return false;
        }

      } else {
        return false;
    }} catch(PDOException $e) {
   
      // Handle exceptions
      return false;
  }
  }
  
  public function register_confirm($data){

    $this->db->query('INSERT INTO temp_user (name, email, password,mobile_number,address,city,expires,hashedToken,selector) 
    VALUES (:name, :email,:password ,:mobile_number,:address,:city,:expires,:hashedToken,:selector)');
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email_reg']);
    $this->db->bind(':password', $data['password_reg']);
    $this->db->bind(':mobile_number', $data['contact_no']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':city', $data['city']);
    $this->db->bind(':expires', $data['expires']);
    $this->db->bind(':hashedToken', $data['hashedToken']);
    $this->db->bind(':selector', $data['selector']);

    $result = $this->db->execute();
    return $result;
  }

  public function deleteEmail($email){
    try{
      $this->db->query('DELETE FROM temp_user WHERE email=:email');
      $this->db->bind(':email',$email);
      //Execute
      if($this->db->execute()){
          return true;
      }else{
          return false;
      }


   }catch (PDOException $e){
       die($e);
      return false;

  }
  }

  public function pw_check($id, $password){
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    $hashed_password = $row->password;
    if(password_verify($password, $hashed_password)){
      return $row;
    } else {
      return false;
    }
  }

  public function change_pw($id, $newPassword) {

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $this->db->query('UPDATE users SET password = :password WHERE id = :id');
    $this->db->bind(':password', $hashedPassword);
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
        return true; 
    } else {
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

    public function findUserByEmailOrUsername($email, $username){
      try{
        $this->db->query('SELECT * FROM users WHERE name = :username OR email = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
  
        $row = $this->db->single();
  
        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }


      }catch(PDOException $e){
        return false;
      }
     
    }

    public function resetPassword($newPwdHash, $tokenEmail){
      try{
        $this->db->query('UPDATE users SET password=:pwd WHERE email=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);
  
        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

      }catch(PDOException $e){
        return false;
      }
     
    }
    
    public function get_pending_user($email){
      try {
          $this->db->query('SELECT * FROM temp_user WHERE email =:email');
          $this->db->bind(':email', $email);
          
          // Execute the query
          $row = $this->db->single();
          return $row;  
      } catch(PDOException $e) {
       
          return false;
      }
  }
  
  public function findUserByEmail2($email){
    try{
      $this->db->query('SELECT * FROM users WHERE email =:email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();
  
      // Check row
       return $row;
    } catch(PDOException $e) {
       
      return false;
   }
  }

  public function deleteEmailCM_Admin($email){
    try {
        $this->db->query('DELETE FROM cm_admin WHERE email=:email');
        $this->db->bind(':email', $email);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
       
        return false;
    }
  }

  public function register_confirm_cm_admin($data){
    try {

      $this->db->query('INSERT INTO cm_admin (name, email, password,contact_no,address,nic,dob,expires,hashedToken,selector) 
      VALUES (:name, :email,:password ,:mobile_number,:address,:nic,:dob,:expires,:hashedToken,:selector)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':mobile_number', $data['contact_no']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':nic', $data['nic']);
      $this->db->bind(':dob', $data['dob']);

      $this->db->bind(':expires', $data['expires']);
      $this->db->bind(':hashedToken', $data['hashedToken']);
      $this->db->bind(':selector', $data['selector']);
  
      $result = $this->db->execute();
      return $result;
   } catch (PDOException $e) {
       die($e);
    return false;
   }
  }

  public function findCMadminByMail($email){
    try {
      $this->db->query('SELECT * FROM cm_admin WHERE email =:email');
      $this->db->bind(':email', $email);
      
      // Execute the query
      $row = $this->db->single();
      return $row;  
    }
      catch (PDOException $e) {
        die($e);
     return false;
    }
   }
}