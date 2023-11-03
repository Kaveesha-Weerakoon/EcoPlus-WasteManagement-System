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
    
      public function register_collector($data){
        $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "collector")');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $result = $this->db->execute();
       
        return true;
       
      }
}
