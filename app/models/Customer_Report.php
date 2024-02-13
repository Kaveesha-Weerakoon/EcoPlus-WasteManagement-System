<?php
    class Customer_Report{
        private $db;

        public function __construct(){
          $this->db = new Database;
        }

    
        public function getCompletedRequests($user_id,$from = "none", $to = "none") {
            try {
                $this->db->query('SELECT * FROM request_main WHERE type=\'completed\' AND customer_id=:customer_id AND date >= :from AND date <= :to');

                $this->db->bind(':customer_id',$user_id);

                if ($from == "none") {
                    $this->db->bind(':from', '1970-01-01');  
                    
                } else {
                    $this->db->bind(':from', $from);
                }
        
                if ($to == "none") {
                    $today = date('Y-m-d');
                    $next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $this->db->bind(':to',   $next_month );
                } else {
                    $this->db->bind(':to', $to);
                }
        
                $results = $this->db->resultSet();
    
                return $results;
            } catch (PDOException $e) {
                die($e);
                return false;
            }
        }
        
        public function getCancelledRequests($user_id,$from="none",$to="none"){
            try {
              
                $this->db->query('SELECT * FROM request_main WHERE type=\'cancelled\' AND customer_id=:customer_id  AND date >= :from AND date <= :to');
                $this->db->bind(':customer_id',$user_id);
          
    
                  if ($from == "none") {
                    $this->db->bind(':from', '1970-01-01');  
                } else {
                   
                    $this->db->bind(':from', $from);
                }
        
                if ($to == "none") {
                    $today = date('Y-m-d');
                    $next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $this->db->bind(':to',   $next_month );
                } else {
                    $this->db->bind(':to', $to);
                }
        
                $results = $this->db->resultSet();
                return $results;
            } catch (PDOException $e) {
                die('3');
                return false;
            }
               
        } 
        
        public function getonGoingRequests($user_id,$from="none",$to="none"){
            try {
                 $this->db->query("SELECT * FROM request_main WHERE (type='incoming' OR type='assigned') AND customer_id=:customer_id AND date >= :from AND date <= :to");
                 $this->db->bind(':customer_id',$user_id);

                
                if ($from == "none") {
                    $this->db->bind(':from', '1970-01-01'); 
                } else {
                    $this->db->bind(':from', $from);
                }
            
                if ($to == "none") {
                    $today = date('Y-m-d');
                    $next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $this->db->bind(':to',   $next_month );
                } else {
                    $this->db->bind(':to', $to);
                }
            
                $results = $this->db->resultSet();
                return $results;
            } catch (PDOException $e) {
                die('2');
                return false;
            }
        }
        
        public function getallRequests($user_id, $from = "none", $to = "none") {
            try {
                $sql = 'SELECT * FROM request_main WHERE customer_id=:customer_id AND date >= :from AND date <= :to';
                $this->db->query($sql);
        
                $this->db->bind(':customer_id', $user_id);
        
                if ($from == "none") {
                    $from = '1970-01-01';  
                }
        
                if ($to == "none") {
                    $today = date('Y-m-d');
                    $next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $to = $next_month;
                }
        
                $this->db->bind(':from', $from);
                $this->db->bind(':to', $to);
        
                $results = $this->db->resultSet();
                return $results;
            } catch (PDOException $e) {
                // Handle the exception gracefully, log the error or display a user-friendly message
                die('1'); // Displaying the error message for now
                return false;
            }
        }
        
        function getCredits( $user_id,$from = "none", $to = "none") {
         try {
          
            $this->db->query('SELECT SUM(credit_amount) AS total_credits FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\' AND customer_id=:customer_id  AND date >= :from AND date <= :to');
            $this->db->bind(':customer_id', $user_id);

    
            if ($from == "none") {
                $from = '1970-01-01';  
            }
    
            if ($to == "none") {
                $to = date('Y-m-d', strtotime('+1 month')); 
            }
    
            $this->db->bind(':from', $from);
            $this->db->bind(':to', $to);
    
            // Execute the query
            $result = $this->db->single();
            return $result;
         } catch (PDOException $e) {
            die($e);
            return false;
         }
        }
        
        function getCreditsMonths( $user_id) {
           try {
            
             $this->db->query('SELECT *, MONTH(request_main.date) as month FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\' AND customer_id=:customer_id ');
             $this->db->bind(':customer_id', $user_id);
             $results = $this->db->resultSet();
             return $results;
          } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }
}