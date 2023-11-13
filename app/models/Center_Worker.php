<?php
  class Center_Worker{
    private $db;

    public function __construct(){

      $this->db = new Database;
    }

    public function add_center_workers($data){
        $this->db->query('INSERT INTO center_workers(center_id, name, nic, address,contact_no,dob) VALUES (:id,:name, :nic, :address,:contact_no,:dob )');
        // Bind values
        $this->db->bind(':id', $_SESSION['center_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);

        $result = $this->db->execute();
        return $result;
       
      }

    public function get_center_workers($data){
        $this->db->query('SELECT * FROM center_workers WHERE center_id=:id');
        $this->db->bind(':id', $data);
        $results = $this->db->resultSet();
        
        return $results;
      }

    public function getCenterWorkerByNIC($NIC){
        $this->db->query('SELECT * FROM center_workers WHERE nic = :nic');
        $this->db->bind(':nic', $NIC);

        $row = $this->db->single();

        return $row;

    }

    public function getCenterWorkersByNIC_except($NIC, $workerId){
      $this->db->query('SELECT * FROM center_workers WHERE nic = :nic AND id <> :id');
      $this->db->bind(':nic', $NIC);
      $this->db->bind(':id', $workerId);

      $rows = $this->db->resultSet();

      //check whether there are center workers with the entered NIC
      if($this->db->rowCount() > 0){
        return true;
      } 
      else {
        return false;
      }
    }

    public function getCenterWorkerById($workerId){
        $this->db->query('SELECT * FROM center_workers WHERE id = :workerId');
        $this->db->bind(':workerId', $workerId);

        $row = $this->db->single();

        return $row;

      }
    
      public function update_center_workers($data){

        $this->db->query('UPDATE center_workers SET name = :name, nic = :nic, address = :address, contact_no = :contact_no, dob = :dob WHERE id = :workerId');
        // Bind values
        $this->db->bind(':workerId', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);

        $result = $this->db->execute();
        return $result;
       
      }
    

    public function delete_center_workers($workerId){
        $this->db->query('DELETE FROM center_workers WHERE id = :workerId');
        $this->db->bind(':workerId', $workerId);

        if($this->db->execute()){
          return true;
        }
        else{
          return false;
        }

      }
  
}