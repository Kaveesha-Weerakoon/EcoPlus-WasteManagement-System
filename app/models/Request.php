<?php
  class Request {
    private $db;

    public function __construct(){
      $this->db = new Database;
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
      try{
      $this->db->query('INSERT INTO request_cancelled (req_id, cancelled_by, reason,assinged,collector_id) VALUES (:req_id, :cancelled_by, :reason,:assinged,:collector_id)');
      $this->db->bind(':req_id', $data['request_id']);
      $this->db->bind(':cancelled_by', $data['cancelled_by']);
      $this->db->bind(':reason', $data['reason']);
      $this->db->bind(':assinged', $data['assinged']);
      $this->db->bind(':collector_id', $data['collector_id']);
      $insertResult = $this->db->execute();
     
      if ($insertResult) {
          $this->db->query('UPDATE request_main SET type = :type WHERE req_id = :req_id');
          $this->db->bind(':type', 'cancelled');
          $this->db->bind(':req_id', $data['request_id']);
          $updateResult = $this->db->execute();

          $request=$this->get_request_by_id($data['request_id']);
          
          if( $updateResult && $request){
            $this->db->query('INSERT INTO user_notification (user_id, notification) VALUES (:customer_id, :notification)');
            $this->db->bind(':customer_id',$request->customer_id);
            $this->db->bind(':notification', "Req ID {$data['request_id']} Has been Cancelled");
            $result= $this->db->execute();
            if($result){
              return $result;
             }
             else{
              return false;
             }
          }else{
            return false;
          };
          
          
      } else {
          return false;
      }
    } catch (PDOException $e) {
      return false;
  }
      
  }

    public function get_cancelled_request($customer_id){    
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
        AND rm.type = :type ORDER BY CONCAT(date, " ", time) DESC
      ';

       $this->db->query($query);
       $this->db->bind(':customer_id', $customer_id);
     $this->db->bind(':type', 'cancelled'); // Assuming 'cancelled' is a string value
       $results = $this->db->resultSet();

      return $results;

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
               collectors.*
            FROM request_main
            LEFT JOIN request_assigned ON request_main.req_id = request_assigned.req_id
            LEFT JOIN collectors ON request_assigned.collector_id = collectors.user_id
            WHERE request_main.region= :region AND request_main.type = :type
     ');

      $this->db->bind(':region', $region);
      $this->db->bind(':type', 'assigned');
      $results = $this->db->resultSet();
      return $results;
    }

    public function get_assigned_request_by_collector($collector_id){
      $this->db->query('
         SELECT request_main.*
         FROM request_main
         JOIN request_assigned ON request_main.req_id = request_assigned.req_id
         WHERE request_assigned.collector_id = :collector_id
         AND request_main.type = "assigned"
      ');

      $this->db->bind(':collector_id', $collector_id);

      $results = $this->db->resultSet();

      return $results;
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
      AND request_main.type = "cancelled";
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

}