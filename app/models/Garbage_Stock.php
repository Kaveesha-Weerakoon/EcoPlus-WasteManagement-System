<?php
  class Garbage_Stock{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function garbage_details_confirm($data){
      try {
        $this->db->query('UPDATE request_completed SET added = "yes" WHERE req_id = :req_id');
        $this->db->bind(':req_id', $data['req_id']);
        $result1=$this->db->execute();

        if($result1){
          $insertQuery1 = 'INSERT INTO garbage_confirmed (req_id, collector_id, plastic, ploythene, metal, glass, paper, electronic, note)
                          VALUES (:req_id, :col_id, :plastic, :polythene, :metal, :glass, :paper, :electronic, :note)';
          $this->db->query($insertQuery1);
          $this->db->bind(':req_id', $data['req_id']);
          $this->db->bind(':col_id', $data['collector_id']);
          $this->db->bind(':plastic', $data['plastic_quantity']);
          $this->db->bind(':polythene', $data['polythene_quantity']);
          $this->db->bind(':metal', $data['metals_quantity']);
          $this->db->bind(':glass', $data['glass_quantity']);
          $this->db->bind(':paper', $data['paper_waste_quantity']);
          $this->db->bind(':electronic', $data['electronic_waste_quantity']);
          $this->db->bind(':note', $data['note']);

          $result2=$this->db->execute();

          if($result2){
            $insertQuery2 = 'INSERT INTO center_garbage (center_id, region, current_plastic, total_plastic, current_polythene, total_polythene, current_metal, total_metal,
                            current_glass, total_glass, current_paper, total_paper, current_electronic, total_electronic )
                            VALUES (:center_id, :region, :cur_plastic, :tot_plastic, :cur_polythene, :tot_polythene, :cur_metal, :tot_metal,
                                    :cur_glass, :tot_glass, :cur_paper, :tot_paper, :cur_electronic, :tot_electronic )';
            $this->db->query($insertQuery2);
            $this->db->bind(':center_id', $data['center_id']);
            $this->db->bind(':region', $data['region']);
            $this->db->bind(':cur_plastic', $data['plastic_quantity']);
            $this->db->bind(':tot_plastic', $data['plastic_quantity']);
            $this->db->bind(':cur_polythene', $data['polythene_quantity']);
            $this->db->bind(':tot_polythene', $data['polythene_quantity']);
            $this->db->bind(':cur_metal', $data['metals_quantity']);
            $this->db->bind(':tot_metal', $data['metals_quantity']);
            $this->db->bind(':cur_glass', $data['glass_quantity']);
            $this->db->bind(':tot_glass', $data['glass_quantity']);
            $this->db->bind(':cur_paper', $data['paper_waste_quantity']);
            $this->db->bind(':tot_paper', $data['paper_waste_quantity']);
            $this->db->bind(':cur_electronic', $data['electronic_waste_quantity']);
            $this->db->bind(':tot_electronic', $data['electronic_waste_quantity']);

            $result3=$this->db->execute();

            if($result3){
              return true;
            }else{
              return false;
            }


          }else{
            return false;
          }


        }else{
          return false;
        }

        
      } catch (PDOException $e) {
          return false;
      }

    }

}  