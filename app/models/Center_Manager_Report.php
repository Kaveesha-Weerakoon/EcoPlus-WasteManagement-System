<?php 
    class Center_Manager_Report{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        function getallRequests_collector($from = "none", $to = "none", $region, $collector_id= "none") {
            try {
                if ($collector_id == "none") {
                    $sql = 'SELECT * FROM request_main WHERE region=:region AND date >= :from AND date <= :to';
    
                } else {
                    $sql = 'SELECT * FROM request_main
                            INNER JOIN request_assigned
                            ON request_main.req_id = request_assigned.req_id
                            WHERE region = :region
                            AND date >= :from AND date <= :to
                            AND collector_id = :collectorId';
                }
        
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
                $this->db->bind(':region', $region);
                $this->db->bind(':from', $from);
                $this->db->bind(':to', $to);
        
                $results = $this->db->resultSet();
                return $results;
            } catch (PDOException $e) {
               
                die($e->getMessage()); // Displaying the error message for now
                return false;
            }
        }
    
        public function getCompletedRequests_collector($from = "none", $to = "none", $region, $collector_id= "none") {
            try {
                if ($collector_id == "none") {
                    $this->db->query('SELECT * FROM request_main WHERE type=\'completed\' AND region=:region AND date >= :from AND date <= :to');
                 
                } else {
                    $this->db->query('SELECT * FROM request_main
                                    INNER JOIN request_assigned
                                    ON request_main.req_id = request_assigned.req_id
                                    WHERE region = :region
                                    AND date >= :from AND date <= :to
                                    AND collector_id = :collectorId
                                    AND type = "completed" ');
                    
                    $this->db->bind(':collectorId', $collector_id);
                    
                    
                }

                $this->db->bind(':region', $region);
        
                // Adjusting binding based on $from and $to values
                if ($from == "none") {
                    $this->db->bind(':from', '1970-01-01');  // Adjusted default date
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
                //print_r($results);
                return $results;

            } catch (PDOException $e) {
                die($e);
                return false;
            }
        }

        public function getCancelledRequests_collector($from = "none", $to = "none", $region, $collector_id= "none"){
            try {
                if ($collector_id == "none") {
                    $this->db->query('SELECT * FROM request_main WHERE type=\'cancelled\' AND region=:region AND date >= :from AND date <= :to');
                   
                } else {
                    $this->db->query('SELECT * FROM request_main
                                    INNER JOIN request_assigned
                                    ON request_main.req_id = request_assigned.req_id
                                    WHERE region = :region
                                    AND date >= :from AND date <= :to
                                    AND collector_id = :collectorId
                                    AND type = "cancelled" ');
                    
                    $this->db->bind(':collectorId', $collector_id);
                    
                }

                $this->db->bind(':region', $region);
    
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

        function getonGoingRequests_collector($from = "none", $to = "none", $region, $collector_id= "none"){
            try {
                if ($collector_id == "none") {
                    $this->db->query("SELECT * FROM request_main WHERE (type='incoming' OR type='assigned') 
                                    AND region=:region 
                                    AND date >= :from AND date <= :to");
                    
                } else {
                    $this->db->query('SELECT * FROM request_main
                                    INNER JOIN request_assigned
                                    ON request_main.req_id = request_assigned.req_id
                                    WHERE region = :region
                                    AND date >= :from AND date <= :to
                                    AND collector_id = :collectorId
                                    AND type IN ("incoming", "assigned") ');
                    
                    $this->db->bind(':collectorId', $collector_id);
                    
                }

                $this->db->bind(':region', $region);
                
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

        function getCollectedGarbage_collector($from = "none", $to = "none", $region, $collector_id= "none") {
            try {
                if ($collector_id == "none") {
                    $sql = 'SELECT SUM(Plastic) as plastic, 
                            SUM(Polythene) as polythene, 
                            SUM(Glass) as glass, 
                            SUM(Paper_Waste) as paperwaste, 
                            SUM(Electronic_Waste) as electronicwaste, 
                            SUM(Metals) as metals FROM request_main 
                            JOIN request_completed 
                            ON request_completed.req_id = request_main.req_id 
                            WHERE region = :region AND date >= :from AND date <= :to';
                } else {
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
                            WHERE region = :region AND date >= :from AND date <= :to
                            AND collector_id = :collectorId';
                    
                }
        
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
                $this->db->bind(':region', $region);
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


    
  

    }