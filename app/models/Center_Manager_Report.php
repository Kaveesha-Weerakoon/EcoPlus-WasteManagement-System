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

        function getHandOveredGarbage_collector($from = "none", $to = "none", $region, $collector_id= "none") {
            try {
                if ($collector_id == "none") {
                    $sql = 'SELECT SUM(plastic) as plastic, 
                            SUM(polythene) as polythene, 
                            SUM(glass) as glass, 
                            SUM(paper_waste) as paperwaste, 
                            SUM(electronic_waste) as electronicwaste, 
                            SUM(metals) as metals FROM request_main 
                            JOIN garbage_confirmed 
                            ON garbage_confirmed.req_id = request_main.req_id 
                            WHERE region = :region 
                            AND date >= :from AND date <= :to';
                } else {
                    $sql = 'SELECT SUM(plastic) as plastic, 
                            SUM(polythene) as polythene, 
                            SUM(glass) as glass, 
                            SUM(paper_waste) as paperwaste, 
                            SUM(electronic_waste) as electronicwaste, 
                            SUM(metals) as metals FROM request_main 
                            JOIN garbage_confirmed 
                            ON garbage_confirmed.req_id = request_main.req_id 
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
        
                if ($collector_id != "none") {
                    $this->db->bind(':collectorId', $collector_id);
                }
                $this->db->bind(':region', $region);
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

        function getSelledGarbage( $from = "none", $to = "none",$centerId) {
            try {
                // Prepare the SQL query
                $sql = 'SELECT 
                            SUM(income) AS income, 
                            SUM(Plastic) as plastic, 
                            SUM(Polythene) as polythene, 
                            SUM(Glass) as glass, 
                            SUM(Paper_Waste) as paperwaste, 
                            SUM(Electronic_Waste) as electronicwaste, 
                            SUM(Metals) as metals 
                        FROM released_stocks 
                        WHERE center_id = :center_id 
                        AND released_date_time >= :from 
                        AND released_date_time <= :to';
                
                // Set default values for $from and $to if not provided
                if ($from === "none") {
                    $from = '1970-01-01';  
                }
                
                if ($to === "none") {
                    $to = date('Y-m-d', strtotime('+1 month'));
                }
        
                // Bind parameters and execute the query
                $this->db->query($sql);
                $this->db->bind(':center_id', $centerId);
                $this->db->bind(':from', $from);
                $this->db->bind(':to', $to);
                
                // Fetch the aggregated values
                $aggregatedValues = $this->db->single();
                
                return $aggregatedValues;
            } catch (PDOException $e) {
                // Handle the exception gracefully
                die($e->getMessage());
                // or log the error and return false
                // error_log($e->getMessage());
                // return false;
            }
        } 
        
        function getCredits_collector($from = "none", $to = "none", $region, $collector_id= "none") {
            try {
                if ($collector_id == "none") {
                    $sql = 'SELECT SUM(credit_amount) AS total_credits 
                            FROM request_main 
                            INNER JOIN request_completed ON request_completed.req_id = request_main.req_id 
                            INNER JOIN request_assigned ON request_assigned.req_id = request_main.req_id 
                            WHERE type = \'completed\' 
                            AND region = :region 
                            AND date >= :from 
                            AND date <= :to';
                } else {
                    $sql = 'SELECT SUM(credit_amount) AS total_credits 
                            FROM request_main 
                            INNER JOIN request_completed ON request_completed.req_id = request_main.req_id 
                            INNER JOIN request_assigned ON request_assigned.req_id = request_main.req_id 
                            WHERE type = \'completed\' 
                            AND region = :region 
                            AND collector_id = :collector_id 
                            AND date >= :from 
                            AND date <= :to';
                }
        
                // Adjusting binding based on $from and $to values
                if ($from == "none") {
                    $from = '1970-01-01';  // Adjusted default date
                }
        
                if ($to == "none") {
                    $to = date('Y-m-d', strtotime('+1 month')); // Adjusted to next month
                }
        
                // Prepare and execute the query
                $this->db->query($sql);
                $this->db->bind(':region', $region);
                $this->db->bind(':from', $from);
                $this->db->bind(':to', $to);
        
                // Bind collector_id if provided
                if ($collector_id != "none") {
                    $this->db->bind(':collector_id', $collector_id);
                }
        
                // Fetch the result
                $result = $this->db->single();
                return $result;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }

        function getCreditsMonths_collector($region, $collector_id){
            try{
                if ($collector_id == "none") {
                    $this->db->query('SELECT *, MONTH(request_main.date) as month 
                                      FROM request_main 
                                      INNER JOIN request_completed 
                                      ON request_completed.req_id = request_main.req_id 
                                      WHERE type = \'completed\' AND region = :region');
                    $this->db->bind(':region', $region);
                } else {
                    $this->db->query('SELECT *, MONTH(request_main.date) as month 
                                      FROM request_main 
                                      INNER JOIN request_completed 
                                      ON request_completed.req_id = request_main.req_id
                                      INNER JOIN request_assigned
                                      ON request_assigned.req_id = request_main.req_id 
                                      WHERE type = \'completed\' AND region = :region
                                      AND collector_id= :collectorId');
                    $this->db->bind(':collectorId', $collector_id);                  
                    $this->db->bind(':region', $region);
                }
                $results = $this->db->resultSet();
                return $results;

            }catch(PDOException $e){
                die($e->getMessage());
                return false;
            }
        }
        
        

    
  

    }