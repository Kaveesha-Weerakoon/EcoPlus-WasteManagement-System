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
          AND request_main.type = "completed" ORDER BY CONCAT(request_completed.completed_datetime) DESC
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
          AND request_main.type = "completed" ORDER BY CONCAT(request_completed.completed_datetime) DESC
      ');
  
      $this->db->bind(':collector_id', $collector_id);
  
      $results = $this->db->resultSet();
  
      return $results;
    }

    public function get_complete_request_cus($collector_id){
      $this->db->query('
        SELECT request_main.*, request_completed.*,customers.*,customers.image  AS customer_image
        FROM request_main
        LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
        LEFT JOIN request_completed ON request_main.req_id = request_completed.req_id
        LEFT JOIN customers ON request_main.customer_id = customers.user_id
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
      $this->db->bind(':Paper_Waste', $data['paper_quantity']);
      $this->db->bind(':Electronic_Waste', $data['electronic_quantity']);
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
          $this->db->query('INSERT INTO user_notification (user_id, notification) VALUES (:customer_id, :notification)');
          $this->db->bind(':customer_id',$request->customer_id);
          $this->db->bind(':notification', "Req ID {$data['req_id']} Has been Completed");
          $result1 = $this->db->execute();
          
          if($result1){
            $notificationText = "Req ID {$data['req_id']} has been completed";
            $this->db->query("INSERT INTO center_notification (center_id, region, notification) VALUES (:center_id, :region, :notification)");
            $this->db->bind(':center_id', $data['center_id']);
            $this->db->bind(':region', $data['region']);
            $this->db->bind(':notification', $notificationText);
            $result2 = $this->db->execute();

            if($result2){
              return true;
              
            }else{
              return false;
            }

          }else{
            return false;
          }

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
          ORDER BY request_completed.completed_datetime DESC
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

    public function get_completed_garbage_totals_by_collector($collector_id){
      $this->db->query('
          SELECT 
              SUM(Polythene) AS total_polythene,
              SUM(Plastic) AS total_plastic,
              SUM(Glass) AS total_glass,
              SUM(Paper_Waste) AS total_paper_waste,
              SUM(Electronic_Waste) AS total_electronic_waste,
              SUM(Metals) AS total_metals
          FROM request_completed
          LEFT JOIN request_assigned ON request_completed.req_id = request_assigned.req_id
          WHERE request_assigned.collector_id = :collector_id 
          AND request_completed.req_id IS NOT NULL
      ');
  
      $this->db->bind(':collector_id', $collector_id);
  
      $result = $this->db->single();
  
      return $result;
    }


    public function get_completed_garbage_totals_by_customer($customer_id){
      $this->db->query('
          SELECT 
              SUM(rc.Polythene) AS total_polythene,
              SUM(rc.Plastic) AS total_plastic,
              SUM(rc.Glass) AS total_glass,
              SUM(rc.Paper_Waste) AS total_paper_waste,
              SUM(rc.Electronic_Waste) AS total_electronic_waste,
              SUM(rc.Metals) AS total_metals
          FROM request_completed rc
          LEFT JOIN request_main rm ON rc.req_id = rm.req_id
          WHERE rm.customer_id = :customer_id 
          AND rc.req_id IS NOT NULL
      ');
  
      $this->db->bind(':customer_id', $customer_id);
  
      $result = $this->db->single();
  
      return $result;
  }
  
    public function getAllCompletedRequests(){
      try {
          $this->db->query('
              SELECT * FROM request_main
              WHERE type = :type
          ');
          $this->db->bind(':type', 'completed');
  
          $results = $this->db->resultSet();
  
          return $results;
      } catch (PDOException $e) {
        
          return false;
      }
  }  

  public function getTotalCreditsGivenInMonth(){
    try {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');
        // Prepare the SQL query
        $this->db->query('
        SELECT 
        SUM(credit_amount) as credit_amount
        FROM request_completed rc
        WHERE 
        rc.req_id IS NOT NULL 
        AND MONTH(rc.completed_datetime) =:currentMonth
        AND YEAR(rc.completed_datetime) =:currentYear

        ');

        // Bind the current month and year to the database query
        $this->db->bind(':currentMonth',  $currentMonth);
        $this->db->bind(':currentYear', $currentYear);

        // Execute the query
        $this->db->execute();
        
        // Fetch the result
        $row = $this->db->single();
        
        // Return the total credits given in the current month
        return $row;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error)
 
        return false;
    }
}

public function getTotalGarbage(){
  try {$this->db->query('
     SELECT 
      SUM(Polythene) AS total_polythene,
      SUM(Plastic) AS total_plastic,
      SUM(Glass) AS total_glass,
      SUM(Paper_Waste) AS total_paper_waste,
      SUM(Electronic_Waste) AS total_electronic_waste,
      SUM(Metals) AS total_metals
      FROM request_completed
    ' );
   $result = $this->db->single();
   return $result;
} 
catch (PDOException $e) {
  return false;
}

}
  
}