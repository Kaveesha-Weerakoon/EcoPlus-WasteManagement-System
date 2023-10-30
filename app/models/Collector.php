<?php
  class Collector{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function add_collector_assistants($data){
        $this->db->query('INSERT INTO collector_assistants (collector_id,name, nic, address, contactno,dob) VALUES (:id,:name, :nic, :address,:contactno,:dob )');
        // Bind values
        $this->db->bind(':id', $_SESSION['collector_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contactno', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);

        $result = $this->db->execute();
        return $result;
       
      }

      public function get_collector_assistants(){
        $this->db->query('SELECT *FROM collector_assistants');
        $results = $this->db->resultSet();
        return $results;
      }
  
}
