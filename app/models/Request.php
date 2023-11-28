<?php
  class Request {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function request_insert($data){

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
        $result = $this->db->execute();
    }

    public function get_request_current($user_id){
        $this->db->query('SELECT * FROM request_main WHERE customer_id = :customer_id AND type IN ("incoming", "assigned")') ;
        $this->db->bind(':customer_id', $user_id);
        
        $results = $this->db->resultSet();
        
        return $results;
    }

    public function get_request_by_id($req_id){

      $this->db->query('SELECT * FROM request_main  WHERE id = :workerId');
      $this->db->bind(':workerId', $req_id);
      $row = $this->db->single();
      return $row;
    }

    public function cancel_request($data) {
      $this->db->query('INSERT INTO request_cancelled (req_id, cancelled_by, reason) VALUES (:req_id, :cancelled_by, :reason)');
      $this->db->bind(':req_id', $data['request_id']);
      $this->db->bind(':cancelled_by', $data['cancelled_by']);
      $this->db->bind(':reason', $data['reason']);
      $insertResult = $this->db->execute();
  
      if ($insertResult) {
          $this->db->query('UPDATE request_main SET type = :type WHERE req_id = :req_id');
          $this->db->bind(':type', 'cancelled');
          $this->db->bind(':req_id', $data['request_id']);
          $updateResult = $this->db->execute();
  
          return $updateResult;
      } else {
          return false;
      }
    }

    public function get_cancelled_request($customer_id){
      $this->db->query('
        SELECT request_main.*, request_cancelled.*
        FROM request_main
        LEFT JOIN request_cancelled ON request_main.req_id = request_cancelled.req_id
        WHERE request_main.customer_id = :customer_id AND request_main.type = :type
     ');

      $this->db->bind(':customer_id', $customer_id);
      $this->db->bind(':type', 'cancelled');
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

   
}