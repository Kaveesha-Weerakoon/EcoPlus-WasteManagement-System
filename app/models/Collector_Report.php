<?php
    class Collector_Report{
        private $db;

        public function __construct(){
          $this->db = new Database;
        }

    
        public function getCompletedRequests($user_id,$from = "none", $to = "none") {
            try {
              $this->db->query('SELECT * FROM request_main
              INNER JOIN request_assigned
              ON request_main.req_id = request_assigned.req_id
              WHERE collector_id = :collector_id
              AND date >= :from AND date <= :to
              AND type = "completed" ');

                $this->db->bind(':collector_id',$user_id);

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
              
                $this->db->query('SELECT * FROM request_main
                                    INNER JOIN request_assigned
                                    ON request_main.req_id = request_assigned.req_id
                                    WHERE collector_id = :collector_id
                                    AND date >= :from AND date <= :to
                                    AND type = "cancelled" ');
                $this->db->bind(':collector_id',$user_id);
          
    
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
        
        public function getAssignRequests($user_id,$from="none",$to="none"){
            try {
                $this->db->query('SELECT * FROM request_main
                INNER JOIN request_assigned
                ON request_main.req_id = request_assigned.req_id
                WHERE collector_id = :collector_id
                AND date >= :from AND date <= :to
                AND type = "assigned" ');
                 $this->db->bind(':collector_id',$user_id);

                
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
                $sql = 'SELECT * FROM request_main
                INNER JOIN request_assigned
                ON request_main.req_id = request_assigned.req_id
                WHERE collector_id = :collector_id
                AND date >= :from AND date <= :to';
                $this->db->query($sql);
        
                $this->db->bind(':collector_id', $user_id);
        
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
          
            $this->db->query('SELECT SUM(credit_amount) AS total_credits 
            FROM request_main 
            INNER JOIN request_completed ON request_completed.req_id = request_main.req_id 
            INNER JOIN request_assigned ON request_assigned.req_id = request_main.req_id 
            WHERE type = \'completed\'
            AND collector_id = :collector_id 
            AND date >= :from 
            AND date <= :to');
            $this->db->bind(':collector_id', $user_id);

    
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
        
        function getCreditsMonths($user_id) {
           try {
            
            $this->db->query('SELECT *, MONTH(request_main.date) as month 
                    FROM request_main 
                    INNER JOIN request_completed 
                    ON request_completed.req_id = request_main.req_id
                    INNER JOIN request_assigned
                    ON request_assigned.req_id = request_main.req_id 
                    WHERE type = \'completed\' 
                    AND collector_id= :collector_id');
             $this->db->bind(':collector_id', $user_id);
             $results = $this->db->resultSet();
             return $results;
          } catch (PDOException $e) {
            return false;
          }
        }



        function getCollectedGarbage_collector($collector_id= "none",$from = "none", $to = "none") {
            try {
                
                    $sql = 'SELECT SUM(Plastic) as plastic, 
                            SUM(Polythene) as polythene, 
                            SUM(Glass) as glass, 
                            SUM(Paper_Waste) as paperwaste, 
                            SUM(Electronic_Waste) as electronicwaste, 
                            SUM(Metals) as metals FROM request_main 
                            JOIN request_completed 
                            ON request_completed.req_id = request_main.req_id 
                            JOIN request_assigned
                            ON request_assigned.req_id = request_main.req_id
                            WHERE  date >= :from AND date <= :to
                            AND collector_id = :collectorId';
        
                if ($from == "none") {
                    $from = '1970-01-01';  
                }
        
                if ($to == "none") {
                    $today = date('Y-m-d');
                    $next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $to = $next_month;
                }
        
                $this->db->query($sql);
                if ($collector_id != "none") {
                    $this->db->bind(':collectorId', $collector_id);
                }
                $this->db->bind(':from', $from);
                $this->db->bind(':to', $to);
        
                // Execute the query and fetch the aggregated values directly
                $result = $this->db->single();
                //print_r($result);
                return $result;

            } catch (PDOException $e) {
               
                die($e->getMessage()); // Displaying the error message for now
                return false;
            }
        } 

        function getHandOveredGarbage_collector($collector_id= "none",$from = "none", $to = "none") {
            try {
                
                    $sql = 'SELECT SUM(plastic) as plastic, 
                            SUM(polythene) as polythene, 
                            SUM(glass) as glass, 
                            SUM(paper_waste) as paperwaste, 
                            SUM(electronic_waste) as electronicwaste, 
                            SUM(metals) as metals FROM request_main 
                            JOIN garbage_confirmed 
                            ON garbage_confirmed.req_id = request_main.req_id 
                            JOIN request_assigned
                            ON request_assigned.req_id = request_main.req_id
                            WHERE date >= :from AND date <= :to
                            AND request_assigned.collector_id = :collectorId';
               
        
                if ($from == "none") {
                    $from = '1970-01-01';  
                }
        
                if ($to == "none") {
                    $today = date('Y-m-d');
                    $next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
                    $to = $next_month;
                }
                $this->db->query($sql);
                if ($collector_id != "none") {
                    $this->db->bind(':collectorId', $collector_id);
                }
                $this->db->bind(':from', $from);
                $this->db->bind(':to', $to);
        
                // Execute the query and fetch the aggregated values directly
                $aggregatedValues = $this->db->single();
        
                return $aggregatedValues;
            } catch (PDOException $e) {
                // Handle the exception gracefully, log the error or display a user-friendly message
                die($e->getMessage()); // Displaying the error message for now
                return false;
            }
        } 

        
 

  
}