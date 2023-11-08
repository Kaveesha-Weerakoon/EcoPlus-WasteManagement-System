<?php
  class Center_Worker{
    private $db;

    public function __construct(){

      $this->db = new Database;
    }

    public function add_center_workers($data){
        $this->db->query('INSERT INTO center_workers(center_id,name, nic, address,contact_no,dob) VALUES (:id,:name, :nic, :address,:contact_no,:dob )');
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
  
}