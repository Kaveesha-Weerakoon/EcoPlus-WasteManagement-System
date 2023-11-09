<?php
  class Collector{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
  
    public function register_collector($data){
        $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "collector")');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $result = $this->db->execute();
        if ($result) {
          $this->db->query('SELECT * FROM users WHERE email = :email');
          $this->db->bind(':email', $data['email']);
          $row = $this->db->single();
          if ($row) {
            $user_id = $row->id;
            $this->db->query('INSERT INTO collectors (user_id, contact_no, address, nic,dob,center_id,center_name,vehicle_no,vehicle_type) VALUES (:user_id, :contact_no, :address, :nic,:dob,:center_id,:center_name,:vehicle_no,:vehicle_type)');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':contact_no', $data['contact_no']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':center_id', $_SESSION['center_id']);
            $this->db->bind(':center_name', "kottawa");
            $this->db->bind(':vehicle_no', $data['vehicle_no']);
            $this->db->bind(':vehicle_type', $data['vehicle_type']);
            $result = $this->db->execute();

          }
          else{
            return false;
          }

        }
        else{
           return false;
        }


        return true;
       
      }


      public function get_collectors(){
        $this->db->query('SELECT *,
              collectors.id as cID,
              users.id as userId
              FROM collectors
              INNER JOIN users
              ON collectors.user_id = users.id');
        $results = $this->db->resultSet();
        return $results;

      }

      public function getCollectorByNIC($NIC){
        $this->db->query('SELECT * FROM collectors WHERE nic = :nic');
        $this->db->bind(':nic', $NIC);

        $row = $this->db->single();

        return $row;

      }

      public function getCollectorByVehicleNo($vehicleNo){
        $this->db->query('SELECT * FROM collectors WHERE vehicle_no = :vehicleNo');
        $this->db->bind(':vehicleNo', $vehicleNo);

        $row = $this->db->single();

        return $row;

      }

      // public function getCollectorByEmail($email){
      //   $this->db->query('SELECT * FROM collectors WHERE email = :email');
      //   $this->db->bind(':email', $email);

      //   $row = $this->db->single();

      //   return $row;

      // }
}
