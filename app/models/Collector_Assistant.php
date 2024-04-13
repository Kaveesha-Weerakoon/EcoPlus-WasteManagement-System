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

      public function getCollectorAssisByNIC_except($NIC, $assisId){
        $this->db->query('SELECT * FROM collector_assistants WHERE nic = :nic AND id <> :id');
        $this->db->bind(':nic', $NIC);
        $this->db->bind(':id', $assisId);
  
        $rows = $this->db->resultSet();
  
        //check whether there are center workers with the entered NIC
        if($this->db->rowCount() > 0){
          return true;
        } 
        else {
          return false;
        }
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


      public function update_collector_assistants($data){
        $this->db->query('UPDATE collector_assistants SET  name = :name, nic = :nic, address = :address, contact_no = :contact_no, dob = :dob WHERE id = :assisId ');
        // Bind values
        $this->db->bind(':assisId', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':dob', $data['dob']);

        $result = $this->db->execute();
        return $result;
       
      }

      public function get_collector_assistants_bycolid($collectorId){
        $this->db->query('SELECT * FROM collector_assistants WHERE collector_id = :collectorId');
        $this->db->bind(':collectorId', $collectorId);

        $rows = $this->db->resultSet();

        return $rows;

      }

      public function get_collector_assistants_by_centerId($center_id){
        try{
          $this->db->query('SELECT * FROM collector_assistants
                            LEFT JOIN collectors
                            ON collector_assistants.collector_id = collectors.user_id
                            WHERE center_id = :center_id');
          $this->db->bind(':center_id', $center_id);

          $result = $this->db->resultSet();

          return $result;


        }catch (PDOException $e) {
        
          die($e->getMessage()); 
          return false;
        }
      }
  
}