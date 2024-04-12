<?php
  class Admins {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    function register_admin($data){   
       try{

       
       $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "admin")');

      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $result = $this->db->execute();
      if ($result) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $row = $this->db->single();
    
        if ($row) {
            $user_id = $row->id; // Assuming 'user_id' is the correct column name
    
            $this->db->query('INSERT INTO admin (user_id, contact_no, address, nic,dob,image) VALUES (:user_id, :mobile_number, :address, :nic,:dob,:image)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':mobile_number', $data['contact_no']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':image', $data['profile_image_name']);
            $result = $this->db->execute();
    
            return $result;
        } else {
            return false;
        }
        } else {
        return false;
       }} 
        catch (PDOException $e) {
        die($e);
        return false;
     }
    }

    public function get_all(){  try{
      $this->db->query('SELECT *,
      admin.id as cID,
      users.id as userId
      FROM admin
      INNER JOIN users
      ON admin.user_id = users.id');
           $results = $this->db->resultSet();
           return $results;
     } 
     catch (PDOException $e) {

     return false;
  }


  
}

public function getAdminByID($data){

  $this->db->query('SELECT * FROM admin WHERE user_id = :adminId');
  $this->db->bind(':adminId', $data);

  $row = $this->db->single();

  return $row;
}


public function admin_delete($id){
  $this->db->query('DELETE FROM users WHERE id = :adminId');
  $this->db->bind(':adminId', $id);

  if($this->db->execute()){
    return true;
  }
  else{
    return false;
  }

}

public function editprofile($data){
  try{
    $this->db->query('UPDATE users SET name = :name WHERE id = :admin_id');
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':admin_id', $data['id']);

    $result = $this->db->execute();

    if($result){
      $this->db->query('UPDATE admin SET address = :address, contact_no = :contactno WHERE user_id = :admin_id');
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':contactno', $data['contactno']);
      $this->db->bind(':admin_id', $data['id']);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }

    }else{
      return false;
    }


  }catch(PDOException $e){
    echo 'An error occurred: ' . $e->getMessage();
    return false;
  }
}

public function editprofile_withimg($data){
  try{
    $this->db->query('UPDATE users SET name = :name WHERE id = :admin_id');
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':admin_id', $data['id']);

    if($this->db->execute()){
      $this->db->query('UPDATE admin SET address = :address, contact_no = :contactno, image = :image WHERE user_id = :admin_id');
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':contactno', $data['contactno']);
      $this->db->bind(':admin_id', $data['id']);
      $this->db->bind(':image', $data['profile_image_name']);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }

    }else{
      return false;
    }

  }catch(PDOException $e){
    echo 'An error occurred: ' . $e->getMessage();
    return false;
  }
}



}