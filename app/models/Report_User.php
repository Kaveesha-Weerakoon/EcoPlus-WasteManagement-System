<?php
  class Report_User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
    
    public function getCollectors($from = "none", $to = "none", $region = "none"){  
        try {
        if ($region == "none") {
            $this->db->query('SELECT * FROM collectors c JOIN users u ON c.user_id = u.id WHERE c.created_at >= :from AND c.created_at <= :to');
        
        } else {
            $this->db->query('SELECT * FROM collectors c JOIN users u  ON c.user_id= u.id WHERE  c.center_name=:region AND c.created_at >= :from AND c.created_at <= :to');
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
        return false;
    }}

    public function getCustomers($from = "none", $to = "none", $region = "none"){ try {
        if ($region == "none") {
            $this->db->query('SELECT * FROM customers c JOIN users u ON c.user_id = u.id WHERE c.joined_date >= :from AND c.joined_date <= :to');
        
        } else {
            $this->db->query('SELECT * FROM customers c JOIN users u  ON c.user_id= u.id WHERE  c.city=:region AND c.joined_date >= :from AND c.joined_date <= :to');
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
        return false;
    }}

    public function getCollectorassistants($from = "none", $to = "none", $region = "none"){    
    try{if ($region == "none") {
        $this->db->query('SELECT * FROM collector_assistants c JOIN collectors co ON co.user_id= c .collector_id WHERE c.created_at >= :from AND c.created_at <= :to');
    
    } else {
        $this->db->query('SELECT * FROM collector_assistants c JOIN collectors co  ON co.user_id= c .collector_id WHERE  co.center_name=:region AND c.created_at >= :from AND c.created_at <= :to');
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
    return $results;}catch (PDOException $e) {
        return false;
    }}
    
    public function getCenterworkers($from = "none", $to = "none", $region = "none"){     
      try{
         if ($region == "none") {
             $this->db->query('SELECT * FROM center_workers c JOIN center ce ON ce.id = c.center_id WHERE c.created_at >= :from AND c.created_at <= :to');
         } else {
           $this->db->query('SELECT * FROM center_workers c JOIN center ce ON ce.id = c.center_id WHERE ce.region = :region AND c.created_at >= :from AND c.created_at <= :to');
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
      }  catch (PDOException $e) {
        return false;
    }
    }}