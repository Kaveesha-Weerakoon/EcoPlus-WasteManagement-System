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
        $this->db->bind(':contact_no', $data['region']);
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

   
}