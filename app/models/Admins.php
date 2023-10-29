<?php
  class Admins {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function get_customer_complains(){

        $this->db->query('SELECT * FROM customer_complains  ORDER BY customer_complains.date DESC');
        $results = $this->db->resultSet();
        return $results;
    }
}