<?php
  class Collect_Garbage{
    private $db;

    public function __construct(){
      $this->db = new Database;
    } 
    
    public function get_request_by_id($req_id){
      $this->db->query('SELECT * FROM request_main  WHERE req_id = :workerId');
      $this->db->bind(':workerId', $req_id);
      $row = $this->db->single();
      return $row;
    }


    public function get_complete_request_relevent_customer($customer_id){
      try{
      $this->db->query('
          SELECT request_main.*, request_completed.*,request_assigned.*,
          users.name as name,
          collectors.user_id AS collector_user_id, 
          request_main.req_id As request_id,
          collectors.image AS collector_image,
          collectors.contact_no AS collector_contact_no,
          collectors.vehicle_no AS collector_vehicle_no,
          collectors.vehicle_type AS collector_vehicle_type
          FROM request_main
          LEFT JOIN request_completed ON request_main.req_id = request_completed.req_id
          LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
          LEFT JOIN collectors  ON request_assigned.collector_id = collectors.user_id
          LEFT JOIN users ON collectors.user_id=users.id
          WHERE request_main.customer_id = :customer_id
          AND request_main.type = "completed"
      ');
  
      $this->db->bind(':customer_id', $customer_id);
  
      $results = $this->db->resultSet();
  
      return $results;
      }catch (PDOException $e) {
        return false;
    }
  }
  
    public function get_complete_request($collector_id){
      $this->db->query('
          SELECT request_main.*, request_completed.*
          FROM request_main
          LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
          LEFT JOIN request_completed ON request_main.req_id = request_completed.req_id
          WHERE request_assigned.collector_id = :collector_id
          AND request_main.type = "completed"
      ');
  
      $this->db->bind(':collector_id', $collector_id);
  
      $results = $this->db->resultSet();
  
      return $results;
  }

  public function get_complete_request_cus($collector_id){
    $this->db->query('
        SELECT request_main.*, request_completed.*
        FROM request_main
        LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
        LEFT JOIN request_completed ON request_main.req_id = request_completed.req_id
        WHERE request_assigned.collector_id = :collector_id 
        AND request_main.type = "completed"
    ');

    $this->db->bind(':collector_id', $collector_id);

    $results = $this->db->resultSet();

    return $results;
}
  
    public function insert($data){
      try{
      $this->db->query('INSERT INTO request_completed (req_id, Polythene, Plastic, Glass, Paper_Waste, Electronic_Waste, Metals, credit_amount, note, added) VALUES (:req_id, :Polythene, :Plastic, :Glass, :Paper_Waste, :Electronic_Waste, :Metals, :credit_amount, :note, :added)');
      
      $this->db->bind(':req_id', $data['req_id']);
      $this->db->bind(':Polythene', $data['polythene_quantity']);
      $this->db->bind(':Plastic', $data['plastic_quantity']);
      $this->db->bind(':Glass', $data['glass_quantity']);
      $this->db->bind(':Paper_Waste', $data['paper_waste_quantity']);
      $this->db->bind(':Electronic_Waste', $data['electronic_waste_quantity']);
      $this->db->bind(':Metals', $data['metals_quantity']);
      $this->db->bind(':credit_amount', $data['credit_Amount']);
      $this->db->bind(':note', $data['note']);
      $addedValue = isset($data['added']) ? $data['added'] : 'no';
      $this->db->bind(':added', $addedValue);

      $result = $this->db->execute();
      if ($result) {
        $this->db->query('UPDATE request_main SET type = :type WHERE req_id = :req_id');
        $this->db->bind(':type', 'completed');
        $this->db->bind(':req_id', $data['req_id']);
        
        $updateResult = $this->db->execute();
        $request=$this->get_request_by_id($data['req_id']);

         if($updateResult  && $request){
          $this->db->query('INSERT INTO customer_nofification (customer_id, notification) VALUES (:customer_id, :notification)');
          $this->db->bind(':customer_id',$request->customer_id);
          $this->db->bind(':notification', "Req ID {$data['req_id']} Has been Completed");
          $this->db->execute();
          return true;
         }
         else{
          return false;
         }

        }
      }catch (PDOException $e) {
        return false;
    } 
    }

    public function get_completed_requests_bycenter($region){
      $this->db->query('
          SELECT request_main.*, request_completed.*,request_assigned.*,
          users.name AS name,
          collectors.user_id AS collector_id, 
          request_main.req_id AS request_id,
          request_main.name AS customer_name,
          collectors.image AS collector_image,
          collectors.contact_no AS collector_contact_no,
          collectors.vehicle_no AS collector_vehicle_no,
          collectors.vehicle_type AS collector_vehicle_type
          FROM request_main
          LEFT JOIN request_completed ON request_main.req_id = request_completed.req_id
          LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
          LEFT JOIN collectors  ON request_assigned.collector_id = collectors.user_id
          LEFT JOIN users ON collectors.user_id=users.id
          WHERE request_main.region = :region
          AND request_main.type = "completed"
      ');
  
      $this->db->bind(':region', $region);
  
      $result = $this->db->resultSet();
  
      return $result;


    }

    public function get_completed_request_byreqId($req_id){
      $this->db->query('SELECT * FROM request_completed WHERE req_id = :req_id');
      $this->db->bind(':req_id', $req_id);
      $result = $this->db->single();

      return $result;

    }


  
}