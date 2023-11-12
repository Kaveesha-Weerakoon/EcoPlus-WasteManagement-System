<?php
  class Collector_Assistant{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function add_collector_assistants($data){
        $this->db->query('INSERT INTO collector_assistants (collector_id,name, nic, address, contact_no,dob) VALUES (:id,:name, :nic, :address,:contact_no,:dob )');
        // Bind values
        $this->db->bind(':id', $_SESSION['collector_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);

        $result = $this->db->execute();
        return $result;
       
      }

    public function get_collector_assistants($data){
        $this->db->query('SELECT * FROM collector_assistants WHERE collector_id=:id');
        $this->db->bind(':id', $data);
        $results = $this->db->resultSet();
        
        return $results;
      }

      public function getCollectorAssisByNIC($NIC){
        $this->db->query('SELECT * FROM collector_assistants WHERE nic = :nic');
        $this->db->bind(':nic', $NIC);

        $row = $this->db->single();

        return $row;

      }

      public function getCollectorAssisById($assisId){
        $this->db->query('SELECT * FROM collector_assistants WHERE id = :assisId');
        $this->db->bind(':assisId', $assisId);
        
        $row = $this->db->single();

        return $row;

      }

      public function delete_collector_assistants($assisId){
        $this->db->query('DELETE FROM collector_assistants WHERE id = :assisId');
        $this->db->bind(':assisId', $assisId);

        if($this->db->execute()){
          return true;
        }
        else{
          return false;
        }

      }
  
}