<?php
  class Collect_Garbage{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

   
    public function insert($data){
      $this->db->query('INSERT INTO request_completed (req_id, Polythene, Plastic, Glass, Paper_Waste, Electronic_Waste, Metals, credit_amount, note, added) VALUES (:req_id, :Polythene, :Plastic, :Glass, :Paper_Waste, :Electronic_Waste, :Metals, :credit_amount, :note, :added)');
      
      $this->db->bind(':req_id', $data['req_id']);
      $this->db->bind(':Polythene', $data['polythene_quantity']);
      $this->db->bind(':Plastic', $data['plastic_quantity']);
      $this->db->bind(':Glass', $data['glass_quantity']);
      $this->db->bind(':Paper_Waste', $data['paper_waste_quantity']);
      $this->db->bind(':Electronic_Waste', $data['electronic_waste_quantity']);
      $this->db->bind(':Metals', $data['metals_quantity']);
      $this->db->bind(':credit_amount', $data['credit_Amount']);
      $this->db->bind(':note', $data['note']);
      $addedValue = isset($data['added']) ? $data['added'] : 'no';
      $this->db->bind(':added', $addedValue);

      $result = $this->db->execute();
      if ($result) {
        $this->db->query('UPDATE request_main SET type = :type WHERE req_id = :req_id');
        $this->db->bind(':type', 'completed');
        $this->db->bind(':req_id', $data['req_id']);
        
        $updateResult = $this->db->execute();
         if($updateResult){
          return $updateResult;
         }
         else{
          return false;
         }

        }

      
      
  }

  
}