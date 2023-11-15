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
            $this->db->bind(':center_name', $data['center_name']);
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

    public function get_collectors_bycenterid($center_id){
           $this->db->query('SELECT *,
                             collectors.id as cID,
                             users.id as userId
                             FROM collectors
                             INNER JOIN users
                             ON collectors.user_id = users.id
                             WHERE collectors.center_id = :center_id');
            $this->db->bind(':center_id', $center_id);

            $results = $this->db->resultSet();
            return $results;
    }

    public function update_collectors($data){ 
      $this->db->query('UPDATE users SET name = :name WHERE id= :collectorId');
      $this->db->bind(':collectorId', $data['id']);
      $this->db->bind(':name', $data['name']);
      
      $result1 = $this->db->execute();
      if($result1){
        $this->db->query('UPDATE collectors SET nic = :nic, address = :address, contact_no = :contact_no, dob = :dob, vehicle_no= :vehicleNo, vehicle_type= :vehicleType WHERE user_id = :collectorId');
        $this->db->bind(':collectorId', $data['id']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contactNo', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':vehicleNo', $data['vehicle_no']);
        $this->db->bind(':vehicleType', $data['vehicle_type']);

        $result2 = $this->db->execute();
        if($result2){
          return true;
        }
        else{
          return false;
        }

      }else{
        return false;
      }
   

    }

    public function getCollectorByNIC_except($NIC, $collectorId){ 
      $this->db->query('SELECT * FROM collectors WHERE nic = :nic AND user_id <> :id');
      $this->db->bind(':nic', $NIC);
      $this->db->bind(':id', $collectorId);

      $rows = $this->db->resultSet();

      //check whether there are collectors with the entered NIC
      if($this->db->rowCount() > 0){
        return true;
      } 
      else {
        return false;
      }



    }

    public function getCollector_ByID_view($collectorId){
      $this->db->query('SELECT *
                        FROM collectors
                        INNER JOIN users
                        ON collectors.user_id = users.id
                        WHERE collectors.user_id = :collector_Id'); 
      $this->db->bind(':collector_Id', $collectorId);
      
      $row = $this->db->single();
      return $row;

    }


    public function delete_collectors($collectorId){
        $this->db->query('DELETE FROM users WHERE id = :collectorId');
        $this->db->bind(':collectorId', $collectorId);

        if($this->db->execute()){
          return true;
        }
        else{
          return false;
        }

      }

      

    public function getCollectorById($collectorId){
        $this->db->query('SELECT * FROM collectors WHERE user_id = :collectorId');
        $this->db->bind(':collectorId', $collectorId);

        $row = $this->db->single();

        return $row;

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

   

}
