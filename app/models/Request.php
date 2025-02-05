<?php
  class Request {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
    
  public function getTotalRequests(){
    try {
      $this->db->query('
          SELECT * FROM request_main
      ');

      $results = $this->db->resultSet();
      return $results;

    } catch (PDOException $e) {
      return false;
    }
  }
   
    public function request_insert($data){
      try{
        $this->db->query('INSERT INTO request_main (region, customer_id, name,contact_no, date, time,instructions,lat,longi) VALUES (:region, :customer_id, :name,:contact_no, :date, :time,:instructions,:lat,:longi)');
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':customer_id', $data['customer_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':instructions', $data['instructions']);
        $this->db->bind(':lat', $data['lattitude']);
        $this->db->bind(':longi', $data['longitude']);
        $insertResult = $this->db->execute();

        if($insertResult){
          $notificationText = "Customer C{$data['customer_id']} has been requested";
          $this->db->query("INSERT INTO center_notification (center_id, region, notification) VALUES (:center_id, :region, :notification)");
          $this->db->bind(":center_id", $data["center_id"]);
          $this->db->bind(":region", $data["region"]);
          $this->db->bind(":notification", $notificationText);
          $insertNotification = $this->db->execute();

          if($insertNotification){
            return $insertNotification;
          }
          else{
            return false;
          }

        }



      }catch(Exception $e){
        return false;
      }

        
    }

    public function get_request_current($user_id) {
      $query = '
          SELECT
              rm.req_id As request_id,
              rm.*,
              ar.*,
              c.user_id AS collector_user_id,
              c.*,
              u.name as name
          FROM
              request_main rm
          LEFT JOIN
              request_assigned ar ON rm.req_id = ar.req_id
          LEFT JOIN
              collectors c ON ar.collector_id = c.user_id
          LEFT JOIN 
              users u ON c.user_id=u.id
          WHERE
              rm.customer_id = :customer_id
              AND rm.type IN ("incoming", "assigned")
              ORDER BY CONCAT(date, " ", time) DESC
      ';
  
      $this->db->query($query);
      $this->db->bind(':customer_id', $user_id);
      $results = $this->db->resultSet();
  
      return $results;
  }
  
    public function get_request_by_id($req_id){
      $this->db->query('SELECT * FROM request_main  WHERE req_id = :workerId');
      $this->db->bind(':workerId', $req_id);
      $row = $this->db->single();
      return $row;
    }

    public function cancel_request($data) {
      try { 
        
          $this->db->query('INSERT INTO request_cancelled (req_id, cancelled_by, reason, assinged, collector_id, fine, fine_type) VALUES (:req_id, :cancelled_by, :reason, :assinged, :collector_id, :fine, :fine_type)');
          $this->db->bind(':req_id', $data['request_id']);
          $this->db->bind(':cancelled_by', $data['cancelled_by']);
          $this->db->bind(':reason', $data['reason']);
          $this->db->bind(':assinged', $data['assinged']);
          $this->db->bind(':collector_id', $data['collector_id']);
          $this->db->bind(':fine', $data['fine_amount'] ?? '0');
          $this->db->bind(':fine_type', $data['fine_type'] ?? "None");
          $insertResult = $this->db->execute(); 

         if ($insertResult) {
              $this->db->query('UPDATE request_main SET type = :type WHERE req_id = :req_id');
              $this->db->bind(':type', 'cancelled');
              $this->db->bind(':req_id', $data['request_id']);
              $updateResult = $this->db->execute();
           
              $request = $this->get_request_by_id($data['request_id']);
            
              if ($updateResult && $request) {
                
                  if ($data['cancelled_by'] === "Customer") {
                      $this->db->query('INSERT INTO user_notification (user_id, notification) VALUES (:customer_id, :notification)');
                      $this->db->bind(':customer_id',$data['collector_id']);
                      $this->db->bind(':notification', "Req ID {$data['request_id']} Cancelled By Customer");
                      $result = $this->db->execute();     
                  }
                  else{
                    $this->db->query('INSERT INTO user_notification (user_id, notification) VALUES (:customer_id, :notification)');
                    $this->db->bind(':customer_id', $request->customer_id);
                    $this->db->bind(':notification', "Req ID {$data['request_id']} Has been Cancelled");
                    $result = $this->db->execute();
                  }

                  if ($data['fine_type'] !== "None") {
                   
                      if ($result) {
                          $c=$this->db->query('SELECT credit_amount FROM customer_credits WHERE user_id = :customer_id');
                          $this->db->bind(':customer_id', $request->customer_id);
                          $credit  =$this->db->single();
  
                          if ($credit ) {
                              $balance=$credit->credit_amount - $data['fine_amount'];
                              $this->db->query('UPDATE customer_credits SET credit_amount = :credit_amount WHERE user_id= :customer_id');
                              $this->db->bind(':customer_id', $request->customer_id);
                              $this->db->bind(':credit_amount',$balance);
                              $updateResult = $this->db->execute();
  
                              if ($updateResult) {
                                  return true;
                              } else {
                                  return false;
                              }
                          } else {
                              return false;
                          }
                      } else {
                          return false;
                      }
                  }
              } else {
                  return false;
              }
          } else {
              return false;
          }
      } catch (PDOException $e) {
          return false;
      }
    }
    
    public function cancelling_auto(){
      try {
          $today = date('Y-m-d'); 
          
          $this->db->query('SELECT rm.*,ra.*, rm.req_id AS req_id 
          FROM request_main rm 
          LEFT JOIN request_assigned ra ON rm.req_id = ra.req_id 
          WHERE rm.date < :today AND (rm.type = "incoming" OR rm.type = "assigned")          
          ');
        
          $this->db->bind(':today', $today);
          $results = $this->db->resultSet();
       
          foreach ($results as $request) {   
              $this->db->query('UPDATE request_main SET type =:new_state WHERE req_id =:request_id');
              $this->db->bind(':new_state', 'cancelled'); 
              $this->db->bind(':request_id', $request->req_id);
              
              $result2 = $this->db->execute();
             
              if ($result2) {
                  $this->db->query('INSERT INTO request_cancelled (req_id, cancelled_by, reason, assinged, collector_id, fine, fine_type) VALUES (:req_id, :cancelled_by, :reason, :assigned, :collector_id, :fine, :fine_type)');
                  
                  $this->db->bind(':req_id', $request->req_id);
                  $this->db->bind(':cancelled_by', "System");
                  $this->db->bind(':reason', "None");
                 
                  $this->db->bind(':assigned', isset($request->status) ? $request->status : ''); // If $request->status is null, bind an empty string
                  $this->db->bind(':collector_id', isset($request->collector_id) ? $request->collector_id : 0); // If $request->collector_id is null, bind 0                  
                  $this->db->bind(':fine', '0');
                  $this->db->bind(':fine_type', "None");
             
                  $insertResult = $this->db->execute(); 
               
              }
          }
          
          return $results; 
  
      } catch (PDOException $e) {
         die($e);
         return false;
      }
  }
  

    public function get_cancelled_request_by_id($req_id){
      try{
        $this->db->query('SELECT * FROM request_main rm JOIN request_cancelled rc on rc.req_id=rm.req_id WHERE rm.req_id = :workerId');
        $this->db->bind(':workerId', $req_id);
        $row = $this->db->single();
        return $row;
      }catch (PDOException $e) {
     
        return false;
     
    }}

    public function refund($req_id,$balance){
     try{
      $this->db->query('UPDATE customer_credits SET credit_amount = :new_balance WHERE user_id = :user_id');
      $this->db->bind(':new_balance', $balance); 
      $this->db->bind(':user_id', $req_id->customer_id);
      $result=$this->db->execute();
      if($result){
        $this->db->query('UPDATE request_cancelled SET fine = :fine, fine_type = :fine_type WHERE req_id = :req_id');
        $this->db->bind(':fine', 0);
        $this->db->bind(':fine_type', "None");
        $this->db->bind(':req_id', $req_id->req_id);
        $result1 = $this->db->execute();
        if($result1){
          $notificationText = "Req ID . $req_id->req_id. fine has been refunded";
          $this->db->query("INSERT INTO user_notification (user_id,  notification) VALUES (:user_id, :notification)");
          $this->db->bind('user_id', $req_id->customer_id);
          $this->db->bind(':notification', $notificationText);
          $result2 = $this->db->execute();
        }
      }
     
      }catch (PDOException $e) {
      die($e);
      return false;
   
    }}

  

    public function get_cancelled_request($customer_id){    
      try{
        
      $query = '
      SELECT
        rm.req_id AS request_id,
        rm.*,
        rc.*,
        ra.*,
        c.user_id AS collector_user_id,
        c.*,
        u.name AS collector_name
      FROM
        request_main rm
      LEFT JOIN
        request_cancelled rc ON rm.req_id = rc.req_id
      LEFT JOIN
        request_assigned ra ON rc.req_id = ra.req_id
      LEFT JOIN
        collectors c ON ra.collector_id = c.user_id
      LEFT JOIN
        users u ON c.user_id = u.id
       WHERE
        rm.customer_id = :customer_id
        AND rm.type = :type ORDER BY CONCAT(rc.cancelled_time) DESC
      ';

       $this->db->query($query);
       $this->db->bind(':customer_id', $customer_id);
     $this->db->bind(':type', 'cancelled'); // Assuming 'cancelled' is a string value
       $results = $this->db->resultSet();

      return $results;}catch (PDOException $e) {
      
        return false;
     
      }
    }

    public function get_incoming_request($region){
      $this->db->query('SELECT * FROM request_main WHERE region = :region AND type IN ("incoming")');
      $this->db->bind(':region', $region);
        
        $results = $this->db->resultSet();
        
        return $results;
    }

    public function get_cancelled_request_bycenter($center){
      $this->db->query('
          SELECT request_main.*, request_cancelled.*
          FROM request_main
          LEFT JOIN request_cancelled ON request_main.req_id = request_cancelled.req_id
          WHERE request_main.region = :region AND request_main.type = :type
          ORDER BY cancelled_time DESC
      ');

      $this->db->bind(':region', $center);
      $this->db->bind(':type', 'cancelled');
      $results = $this->db->resultSet();
     
      return $results;
    }

    public function assing_collector($data) {
      try{
        $this->db->query('INSERT INTO request_assigned (req_id, collector_id) VALUES (:req_id, :collector_id)');
      $this->db->bind(':req_id', $data['request_id']);
      $this->db->bind(':collector_id', $data['collector_id']);
      $insertResult = $this->db->execute();
      $request=$this->get_request_by_id($data['request_id']);
      
      if ($insertResult && $request) {
          $this->db->query('UPDATE request_main SET type = :type WHERE req_id = :req_id');
          $this->db->bind(':type', 'assigned'); 
          $this->db->bind(':req_id', $data['request_id']);
          $updateResult = $this->db->execute();
          

          if($updateResult){
            $notificationText = "Req ID {$data['request_id']} Has been Assigned";
            $this->insert_notification($request->customer_id, $notificationText);
            $this->insert_notification($data['collector_id'], $notificationText);
          };
      } else {
          return false;
      } }catch (PDOException $e) {
        return false;
     }
    }

    public function insert_notification($user_id, $notification) {
      try {
          $this->db->query('INSERT INTO user_notification (user_id, notification, mark_as_read) VALUES (:user_id, :notification, :mark_as_read)');
          $this->db->bind(':user_id', $user_id);
          $this->db->bind(':notification', $notification);
          $this->db->bind(':mark_as_read', 'False', PDO::PARAM_STR);
          $this->db->execute();
          return true;
      } catch (PDOException $e) {
          return false;
      }
  }

    public function get_assigned_request_by_center($region){
      $this->db->query('
      SELECT 
      request_main.*, 
      request_main.name AS customer_name,
      request_main.contact_no AS customer_contactno,
      request_assigned.collector_id, 
      collectors.*,
      collectors.user_id as collector_id,
      users.name as collector_name
      FROM request_main
      LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
      LEFT JOIN collectors ON request_assigned.collector_id = collectors.user_id
      JOIN users ON users.id = collectors.user_id
      WHERE request_main.region = :region AND request_main.type = :type;
  
     ');

      $this->db->bind(':region', $region);
      $this->db->bind(':type', 'assigned');
      $results = $this->db->resultSet();
      return $results;
    }

    public function get_assigned_request_by_collector($collector_id){
      $this->db->query('
         SELECT request_main.*,
         status
         FROM request_main
         JOIN request_assigned ON request_main.req_id = request_assigned.req_id
         WHERE request_assigned.collector_id = :collector_id
         AND request_main.type = "assigned"
      ');

      $this->db->bind(':collector_id', $collector_id);

      $results = $this->db->resultSet();
      
      return $results;
    }

    public function get_assigned_requests_count_by_collector_for_day($collector_id){
      $today = date("Y-m-d");
      //var_dump($today);
      $this->db->query('
         SELECT request_main.*,
         status
         FROM request_main
         JOIN request_assigned ON request_main.req_id = request_assigned.req_id
         WHERE request_assigned.collector_id = :collector_id
         AND request_main.type = "assigned"
         AND request_main.date = :today
         
      ');

      $this->db->bind(':collector_id', $collector_id);
      $this->db->bind(':today', $today);

      $results = $this->db->resultSet();
      // var_dump($results);

      $request_count = $this->db->rowCount();
      //var_dump($request_count);
      return $request_count;
      
      
    }

    public function get_cancelled_request_by_collector($collector_id){
      $this->db->query('
      SELECT
      request_main.*,
      request_cancelled.*
     
      FROM
      request_main
      JOIN
      request_assigned ON request_main.req_id = request_assigned.req_id
      LEFT JOIN
      request_cancelled ON request_main.req_id = request_cancelled.req_id
      WHERE
      request_assigned.collector_id = :collector_id
      AND request_main.type = "cancelled"
      ORDER BY CONCAT(request_cancelled.cancelled_time)  DESC;
      ');

     $this->db->bind(':collector_id', $collector_id);

     $results = $this->db->resultSet();

     return $results;

    }

    public function get_assigned_request($req_id){
      
      $this->db->query('SELECT * FROM request_assigned WHERE req_id =:req_id');
      $this->db->bind(':req_id', $req_id);

      $row = $this->db->single();

      return $row;
    }

    public function get_total_requests_by_region($region){
      $this->db->query('SELECT * FROM request_main WHERE region= :region');
      $this->db->bind(':region', $region);

      $rows = $this->db->resultSet();

      $total_requests = $this->db->rowCount();
      return $total_requests;

    }

    public function get_total_requests_by_customer($customer_id){
      try {
          $this->db->query('SELECT * FROM request_main WHERE customer_id= :customer_id');
          $this->db->bind(':customer_id', $customer_id);
          $rows = $this->db->resultSet();
    
          return $rows;
      } catch (PDOException $e) {
          return false;
      }
    }

    public function get_incoming_requests_count($region){
      try {
        $this->db->query('SELECT * FROM request_main WHERE region = :region AND type IN ("incoming")');
        $this->db->bind(':region', $region);
        $rows = $this->db->resultSet();
    
        $request_count = $this->db->rowCount();
        return $request_count;

      } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
      }
    }

    public function get_completed_requests_count( $region ){
      try {
        $this->db->query('SELECT * FROM request_main WHERE region = :region AND type IN ("completed")');  
        $this->db->bind(':region', $region);
        $rows = $this->db->resultSet();
    
        $request_count = $this->db->rowCount();
        return $request_count;   

      }catch (PDOException $e) {
        return false;
      }
    }

    public function markontheway($id){
      try{
        $this->db->query('UPDATE request_assigned SET status =:type WHERE req_id = :req_id');
        $this->db->bind(':type', 'ontheway'); 
        $this->db->bind(':req_id', $id);
        $updateResult = $this->db->execute();
        $request=$this->get_request_by_id($id);

        if($updateResult &&  $request){
          $notificationText = "Req ID {$id} Collector is On the Way";
          $this->insert_notification($request->customer_id, $notificationText);
        }
      }
      catch (PDOException $e) {
        return false;
      }

    }
    
    public function verification($id,$user_id) {
      try {
        
        $code = rand(1, 1000000);

        $this->db->query('UPDATE request_assigned SET code = :code WHERE req_id = :req_id');
        $this->db->bind(':code', $code);
        $this->db->bind(':req_id', $id);
        $this->db->execute();
        $notificationText= "Req ID $id Verify code updated";
        $this->insert_notification($user_id, $notificationText);

          return true; // Return true if the query is executed successfully
      } catch (PDOException $e) {
          return false; // Return false if there's any error
      }
    }  
    
    public function getverification($id) {
      try {
        
        $this->db->query('SELECT code FROM request_assigned WHERE req_id = :req_id');  
        $this->db->bind(':req_id', $id);
        $row = $this->db->single();
        return $row;  

      }catch (PDOException $e) {
      
        return false;
      }
    }

    public function get_ongoing_request_by_center($center) {
      try {
        $this->db->query('SELECT * FROM request_main WHERE region = :region AND type IN ("incoming", "assigned")');
        $this->db->bind(':region', $center);
          
          $results = $this->db->resultSet();
          
          return $results;
      } catch (PDOException $e) {
          // Handle the exception if needed
          return false;
      }
    }
    
    public function get_nothandovered_request_by_center($center) {
      try {
          $this->db->query('SELECT * FROM request_main rm 
                            LEFT JOIN request_completed rc 
                            ON rm.req_id = rc.req_id 
                            WHERE rm.region = :region AND rc.added="no"');
          $this->db->bind(':region', $center);
         
          $results = $this->db->resultSet();
       
          return $results;
      } catch (PDOException $e) {
          // Handle the exception if needed
          die($e);
          return false;
      }
  }
  
  

}