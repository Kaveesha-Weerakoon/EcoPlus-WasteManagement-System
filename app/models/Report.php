<?php
  class Report {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCompletedRequests($from = "none", $to = "none", $region = "none") {
        try {
            if ($region == "none") {
                $this->db->query('SELECT * FROM request_main WHERE type=\'completed\' AND date >= :from AND date <= :to');
            } else {
                $this->db->query('SELECT * FROM request_main WHERE type=\'completed\' AND region=:region AND date >= :from AND date <= :to');
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
                $this->db->query('SELECT * FROM request_main WHERE type=\'cancelled\' AND date >= :from AND date <= :to');
            } else {
                $this->db->query('SELECT * FROM request_main WHERE type=\'cancelled\' AND region=:region AND date >= :from AND date <= :to');
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
            
            // Adjusting binding based on $from and $to values
            if ($from == "none") {
                $this->db->bind(':from', '1970-01-01'); // Adjusted default date
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
    
    function getallRequests($from="none",$to="none",$region="none"){
        try {
            if ($region == "none") {
                $this->db->query('SELECT * FROM request_main WHERE date >= :from AND date <= :to');
            } else {
                $this->db->query('SELECT * FROM request_main WHERE  region=:region AND date >= :from AND date <= :to');
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
            }else {
                $this->db->bind(':to', $to);
            }
            $this->db->query('SELECT * FROM request_main ');
            $results = $this->db->resultSet();
            return $results;
        } catch (PDOException $e) {
            die($e);
            return false;
    }}

    function getCredits( $from = "none", $to = "none",$region = "none",) {
        try {
            if ($region == "none") {
                $this->db->query('SELECT SUM(credit_amount)  AS total_credits FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE type = \'completed\' AND date >= :from AND date <= :to');
            } else {
                $this->db->query('SELECT SUM(credit_amount) AS total_credits FROM request_main INNER JOIN request_completed ON request_completed.req_id = request_main.req_id WHERE region = :region AND date >= :from AND date <= :to');
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
    
          
}