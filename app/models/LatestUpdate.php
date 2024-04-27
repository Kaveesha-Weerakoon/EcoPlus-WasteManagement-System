<?php
  class LatestUpdate{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    function getLatestDiscount($id){
        try {
            $this->db->query('
                SELECT * 
                FROM discounts d 
                JOIN users da ON da.id=d.agent_id  
                WHERE customer_id = :id 
                ORDER BY created_at DESC
                LIMIT 1
            ');
        
            $this->db->bind(':id', $id);
            $result = $this->db->single();
            return $result;
        } catch (PDOException $e) {
            return false;
        }
        
    }

    function getLatestCompleted($customer_id){
        try {
            $this->db->query('
                SELECT 
                    request_main.*, 
                    request_completed.*, 
                    request_assigned.*,
                    users.name as name,
                    collectors.user_id AS collector_user_id, 
                    request_main.req_id As request_id,
                    collectors.image AS collector_image,
                    collectors.contact_no AS collector_contact_no,
                    collectors.vehicle_no AS collector_vehicle_no,
                    collectors.vehicle_type AS collector_vehicle_type
                FROM 
                    request_main
                LEFT JOIN 
                    request_completed ON request_main.req_id = request_completed.req_id
                LEFT JOIN 
                    request_assigned ON request_main.req_id = request_assigned.req_id
                LEFT JOIN 
                    collectors  ON request_assigned.collector_id = collectors.user_id
                LEFT JOIN 
                    users ON collectors.user_id = users.id
                WHERE 
                    request_main.customer_id = :customer_id
                    AND request_main.type = "completed" 
                ORDER BY 
                    CONCAT(request_completed.completed_datetime) DESC
                LIMIT 1
            ');
        
            $this->db->bind(':customer_id', $customer_id);
        
            return $this->db->single();
        } catch (PDOException $e) {
            return false;
        }
        
    }

    function getLatestCancelled($customer_id){
        try {
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
                    AND rm.type = :type 
                    AND rc.fine != 0
                ORDER BY 
                    CONCAT(rc.cancelled_time) DESC
                LIMIT 1
            ';
        
            $this->db->query($query);
            $this->db->bind(':customer_id', $customer_id);
            $this->db->bind(':type', 'cancelled'); // Assuming 'cancelled' is a string value
            return $this->db->single();
        } catch (PDOException $e) {
            return false;
        }
    }
    

    function getLatestTransferd($user_id){
        try{
            $this->db->query('
            SELECT 
            credits_transfer.*, 
            c.image AS sender_img, 
            c2.image AS receiver_img
        FROM 
            credits_transfer
        LEFT JOIN 
            customers c ON c.user_id = credits_transfer.sender_id 
        LEFT JOIN 
            customers c2 ON c2.user_id = credits_transfer.receiver_id
        WHERE 
            credits_transfer.sender_id = :user_id OR credits_transfer.receiver_id = :user_id 
        ORDER BY 
            CONCAT(credits_transfer.date, " ", credits_transfer.time) DESC
        LIMIT 1
            ');
        
            $this->db->bind(':user_id', $user_id);
            return $this->db->single();
        } catch (PDOException $e) {
            return false;
        }
        
    }

}