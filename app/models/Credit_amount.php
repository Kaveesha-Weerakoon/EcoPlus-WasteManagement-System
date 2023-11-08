<?php
  class Credit_amount{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function update($data){


        /*$this->db->query('INSERT INTO credits_per_waste (plastic,polythene,metal,electronic, paper,glass) VALUES (:plastic,:polythene, :metal, :electronic,:paper,:glass)');*/

        $this->db->query('UPDATE credits_per_waste SET plastic=:plastic, polythene=:polythene, metal=:metal, electronic=:electronic, paper=:paper, glass=:glass WHERE id =:id');
       
        $this->db->bind(':id', 1);
        $this->db->bind(':plastic', $data['plastic_credit']);
        $this->db->bind(':metal', $data['metal_credit']);
        $this->db->bind(':polythene', $data['polythene_credit']);
        $this->db->bind(':glass', $data['glass_credit']);
        $this->db->bind(':electronic', $data['electronic_credit']);
        $this->db->bind(':paper', $data['paper_credit']);
       
        $result = $this->db->execute();
        return $result;
       
      }

      public function get(){
        $this->db->query('SELECT * FROM credits_per_waste WHERE id = :id');
        $this->db->bind(':id', 1);
  
        $row = $this->db->single();
  
        return $row;
      }

     
  
}
