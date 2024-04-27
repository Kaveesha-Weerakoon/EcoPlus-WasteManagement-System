<?php
  class Collector_Complain {
  
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function complains($data){
        $id= $_SESSION['collector_id'];

        $this->db->query('INSERT INTO collector_complains (collector_id,name,contact_no, region,subject,complaint,center_id) VALUES (:collector_id,:name,:contact_no,:region,:subject,:complaint,:center_id)');


        // Bind values
  
        $this->db->bind(':collector_id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':complaint', $data['complain']);
        $this->db->bind(':region', $data['region']);

        $this->db->bind(':center_id', $data['center_id']);

        $result = $this->db->execute();
        
        if ($result) {
                return $result; 
        } else {
            // Handle the case where the user was not inserted into the 'users' table
            return false;
        }
    }
  
    public function get_complains_by_collector($id) {
      $this->db->query('SELECT * FROM collector_complains WHERE collector_id = :id ORDER BY collector_complains.date DESC');
      $this->db->bind(':id', $id);
      $results = $this->db->resultSet();
    
      return $results;
  }
    public function get_complains() {
     
        $this->db->query('SELECT * FROM collector_complains  ORDER BY collector_complains.date DESC');
        $results = $this->db->resultSet();
        return $results;
    }

    public function get_complains_byCenterID($centerId){

        $query = "SELECT * FROM collector_complains WHERE center_id = :center_id ORDER BY date DESC";
        $this->db->query($query);
        $this->db->bind(':center_id', $centerId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function get_collector_complains_with_image(){
      $this->db->query('SELECT collector_complains.*, collectors.image 
                        FROM collector_complains 
                        INNER JOIN collectors ON collector_complains.collector_id =collectors.user_id
                        ORDER BY collector_complains.date DESC');
      $results = $this->db->resultSet();
      return $results;
    }

    public function get_collector_complaints_by_region($region){
      try{
        $this->db->query('SELECT collector_complains.* , collectors.image
                          FROM collector_complains 
                          INNER JOIN collectors 
                          ON collector_complains.collector_id = collectors.user_id
                          WHERE collector_complains.region = :region
                          ORDER BY collector_complains.date DESC');
        $this->db->bind(':region', $region);
        $results = $this->db->resultSet();
        return $results;
  
  
      }catch (PDOException $e){
        return false;
      }
      
  
  
  
    }
  
  



 


  }