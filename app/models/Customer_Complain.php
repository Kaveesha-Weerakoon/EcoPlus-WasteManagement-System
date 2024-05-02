<?php
  class Customer_Complain {

    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function complains($data){
        $id= $_SESSION['user_id'];
        $this->db->query('INSERT INTO customer_complains (customer_id,name,contact_no, region,subject,complaint,complain_title,complain_body) VALUES (:customer_id,:name,:contact_no,:region,:subject,:complaint,:complain_title,
        :complain_body)');
        // Bind values
  
        $this->db->bind(':customer_id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':complaint', $data['complain']);
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':complain_title', $data['complain_title']);
        $this->db->bind(':complain_body', $data['complain_body']);
        
        $result = $this->db->execute();
        
        if ($result) {
                return $result; 
        } else {
            // Handle the case where the user was not inserted into the 'users' table
            return false;
        }
    }

    public function updatecomplaint($data){
      $this->db->query('UPDATE customer_complains SET complaint =:complaint, complain_title = :complain_title, complain_body = :complain_body WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':complaint', $data['complaint']);
        $this->db->bind(':complain_title', $data['complain_title']);
        $this->db->bind(':complain_body', $data['complain_body']);

        $result2 = $this->db->execute();
        return $result2;
    }

    public function get_complain_byid($id){
      $this->db->query('SELECT * FROM customer_complains WHERE id=:id');
      $this->db->bind(':id', $id);
      
      $row = $this->db->single();

      // Check row
    return $row;
    
    }
  
    public function get_complains($id) {
        $this->db->query('SELECT * FROM customer_complains WHERE customer_id = :id ORDER BY customer_complains.date DESC');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
      
        return $results;
    }
  

    public function get_customer_complains(){

      $this->db->query('SELECT * FROM customer_complains  ORDER BY customer_complains.date DESC');
      $results = $this->db->resultSet();
      return $results;
  }

  public function get_customer_complains_with_image(){
    $this->db->query('SELECT customer_complains.*, customers.image 
                      FROM customer_complains 
                      INNER JOIN customers ON customer_complains.customer_id = customers.user_id
                      ORDER BY customer_complains.date DESC');
    $results = $this->db->resultSet();
    return $results;
  }


  public function get_customer_complaints_by_region($region){
    try{
      $this->db->query('SELECT customer_complains.* , customers.image
                        FROM customer_complains 
                        INNER JOIN customers 
                        ON customer_complains.customer_id = customers.user_id
                        WHERE customer_complains.region = :region
                        ORDER BY customer_complains.date DESC');
      $this->db->bind(':region', $region);
      $results = $this->db->resultSet();
      return $results;


    }catch (PDOException $e){
      return false;
    }
    



  }


 


  }