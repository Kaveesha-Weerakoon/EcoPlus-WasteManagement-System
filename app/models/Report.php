<?php
  class Report {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCompletedRequests($from = "none", $to = "none", $region = "none") {
        try {
            if ($region == "none") {
                $this->db->query('SELECT * FROM request_main rm JOIN request_completed rq ON rm.req_id=rq.req_id WHERE rm.type=\'completed\' AND rq.completed_datetime >= :from AND rq.completed_datetime <= :to');
            } else {
                $this->db->query('SELECT * FROM request_main rm JOIN request_completed rq ON rm.req_id=rq.req_id WHERE rm.type=\'completed\' AND rm.region=:region AND rq.completed_datetime >= :from AND rq.completed_datetime <= :to');
                $this->db->bind(':region', $region);
            }
            
    
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
            return $results;
        } catch (PDOException $e) {
            die($e);
            return false;
        }
    }
    
    public function getCancelledRequests($from="none",$to="none",$region="none"){
        try {
            if ($region == "none") {
                $this->db->query('SELECT * FROM request_main rm join request_cancelled rc on rm.req_id=rc.req_id WHERE type=\'cancelled\' AND rc.cancelled_time >= :from AND rc.cancelled_time <= :to');
            } else {
                $this->db->query('SELECT * FROM request_main rm join request_cancelled rc on rm.req_id=rc.req_id WHERE type=\'cancelled\' AND region=:region AND rc.cancelled_time >= :from AND rc.cancelled_time <= :to');
                $this->db->bind(':region', $region);
            }

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
    
    function getonGoingRequests($from="none",$to="none",$region="none"){
        try {
            if ($region == "none") {
                $this->db->query("SELECT * FROM request_main WHERE (type='incoming' OR type='assigned') AND date >= :from AND date <= :to");
            } else {
                $this->db->query("SELECT * FROM request_main WHERE (type='incoming' OR type='assigned') AND region=:region AND date >= :from AND date <= :to");
                $this->db->bind(':region', $region);
            }
            
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
    
    function getallRequests($from = "none", $to = "none", $region = "none") {
        try {
            if ($region == "none") {
                $sql = 'SELECT * FROM request_main WHERE date >= :from AND date <= :to';
            } else {
                $sql = 'SELECT * FROM request_main WHERE region=:region AND date >= :from AND date <= :to';
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
            if ($region != "none") {
                $this->db->bind(':region', $region);
            }
            $this->db->bind(':from', $from);
            $this->db->bind(':to', $to);
    
            $results = $this->db->resultSet();
            return $results;
        } catch (PDOException $e) {
            // Handle the exception gracefully, log the error or display a user-friendly message
            die($e->getMessage()); // Displaying the error message for now
            return false;
        }
    }
    
    function getCredits( $from = "none", $to = "none",$region = "none") {
        try {
            if ($region == "none") {
                $this->db->query('SELECT SUM(credit_amount)  AS total_credits FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\' AND request_completed.completed_datetime>= :from AND request_completed.completed_datetime <= :to');
            } else {
                $this->db->query('SELECT SUM(credit_amount) AS total_credits FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\' AND region = :region AND request_completed.completed_datetime >= :from AND request_completed.completed_datetime <= :to');
                $this->db->bind(':region', $region);
            }
    
            // Adjusting binding based on $from and $to values
            if ($from == "none") {
                $from = '1970-01-01';  // Adjusted default date
            }
    
            if ($to == "none") {
                $to = date('Y-m-d', strtotime('+1 month')); // Adjusted to next month
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

    function getCreditsMonths($region = "none") {
        try {
            if ($region == "none") {
                $this->db->query('SELECT *, MONTH(request_main.date) as month FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\'');
            } else {
                $this->db->query('SELECT *, MONTH(request_main.date) as month FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\' AND region = :region');
                $this->db->bind(':region', $region);
            }
            $results = $this->db->resultSet();
            return $results;
        } catch (PDOException $e) {
            return false;
        }
    }
    function getCollectedGarbage($from = "none", $to = "none", $region = "none") {
        try {
            if ($region == "none") {
                $sql = 'SELECT SUM(Plastic) as plastic, SUM(Polythene) as polythene, SUM(Glass) as glass, SUM(Paper_Waste) as paperwaste, SUM(Electronic_Waste) as electronicwaste, SUM(Metals) as metals FROM request_main JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE date >= :from AND date <= :to';
            } else {
                $sql = 'SELECT SUM(Plastic) as plastic, SUM(Polythene) as polythene, SUM(Glass) as glass, SUM(Paper_Waste) as paperwaste, SUM(Electronic_Waste) as electronicwaste, SUM(Metals) as metals FROM request_main JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE region = :region AND date >= :from AND date <= :to';
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
            if ($region != "none") {
                $this->db->bind(':region', $region);
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
    
    function getHandOveredGarbage($from = "none", $to = "none", $region = "none") {
        try {
            if ($region == "none") {
                $sql = 'SELECT SUM(Plastic) as plastic, SUM(Polythene) as polythene, SUM(Glass) as glass, SUM(Paper_Waste) as paperwaste, SUM(Electronic_Waste) as electronicwaste, SUM(Metals) as metals FROM request_main JOIN garbage_confirmed ON garbage_confirmed.req_id = request_main.req_id WHERE date >= :from AND date <= :to';
            } else {
                $sql = 'SELECT SUM(Plastic) as plastic, SUM(Polythene) as polythene, SUM(Glass) as glass, SUM(Paper_Waste) as paperwaste, SUM(Electronic_Waste) as electronicwaste, SUM(Metals) as metals FROM request_main JOIN garbage_confirmed ON garbage_confirmed.req_id = request_main.req_id WHERE region = :region AND date >= :from AND date <= :to';
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
            if ($region != "none") {
                $this->db->bind(':region', $region);
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
    
    function getSelledGarbage($from = "none", $to = "none", $region = "none") {
        try {
            if ($region == "none" ) {
                $sql = 'SELECT SUM(income) AS income, SUM(Plastic) as plastic, SUM(Polythene) as polythene, SUM(Glass) as glass, SUM(Paper_Waste) as paperwaste, SUM(Electronic_Waste) as electronicwaste, SUM(Metals) as metals FROM released_stocks WHERE released_date_time >= :from AND released_date_time <= :to';

            } else {
                $sql = 'SELECT SUM(income) AS income, SUM(Plastic) as plastic, SUM(Polythene) as polythene, SUM(Glass) as glass, SUM(Paper_Waste) as paperwaste, SUM(Electronic_Waste) as electronicwaste, SUM(Metals) as metals FROM released_stocks WHERE center_id = :region AND released_date_time >= :from AND released_date_time <= :to';
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
            if ($region != "none") {
                $this->db->bind(':region', $region);
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