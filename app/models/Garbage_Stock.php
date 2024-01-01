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
          $insertQuery = 'INSERT INTO garbage_confirmed (req_id, collector_id, plastic, polythene, metals, glass, paper_waste, electronic_waste, note)
                          VALUES (:req_id, :col_id, :plastic, :polythene, :metal, :glass, :paper, :electronic, :note)';
          $this->db->query($insertQuery);
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
            $updateQuery = 'UPDATE center_garbage
                            SET
                              current_plastic = current_plastic + :cur_plastic,
                              total_plastic = total_plastic + :tot_plastic,
                              current_polythene = current_polythene + :cur_polythene,
                              total_polythene = total_polythene + :tot_polythene,
                              current_metal = current_metal+ :cur_metal,
                              total_metal = total_metal + :tot_metal,
                              current_glass = current_glass + :cur_glass,
                              total_glass = total_glass+ :tot_glass,
                              current_paper = current_paper + :cur_paper,
                              total_paper = total_paper + :tot_paper,
                              current_electronic = current_electronic + :cur_electronic,
                              total_electronic = total_electronic + :tot_electronic
                            WHERE
                              center_id = :center_id;';

            $this->db->query($updateQuery);
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
            $this->db->bind(':center_id', $data['center_id']);

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
        echo 'Error: ' . $e->getMessage();
        return false;
      }

    }

    public function get_center_garbage_details($center_id){
      $this->db->query('SELECT * FROM center_garbage WHERE center_id = :center_id');
      $this->db->bind(':center_id', $center_id);
      $result = $this->db->resultSet();
  
      return $result;

    }

    public function get_confirmed_requests_by_region($region){
      $this->db->query('SELECT garbage_confirmed.* 
                        FROM garbage_confirmed
                        LEFT JOIN request_main ON garbage_confirmed.req_id = request_main.req_id
                        WHERE request_main.region = :region');
      $this->db->bind(':region', $region);
      $result = $this->db->resultSet();
  
      return $result;
    }

    public function get_current_quantities_of_garbage($center_id){
      $this->db->query('SELECT * FROM center_garbage WHERE center_id = :center_id');
      $this->db->bind(':center_id', $center_id);
      $result = $this->db->single();

      return $result;

    }

    public function release_garbage_stocks($data){
      $this->db->query('INSERT INTO released_stocks (center_id, plastic, polythene, metals, glass, paper_waste, electronic_waste, released_person, release_note)
                        VALUES (:center_id, :plastic, :polythene, :metals, :glass, :paper_waste, :electronic_waste, :released_person, :release_note)');
      $this->db->bind(':center_id', $data['center_id']);
      $this->db->bind(':plastic', $data['plastic']);
      $this->db->bind(':polythene', $data['polythene']);
      $this->db->bind(':metals', $data['metals']);
      $this->db->bind(':glass', $data['glass']);
      $this->db->bind(':paper_waste', $data['paper_waste']);
      $this->db->bind(':electronic_waste', $data['electronic_waste']);
      $this->db->bind(':released_person', $data['released_person']);
      $this->db->bind(':release_note', $data['release_note']);
      $result1 = $this->db->execute();

      if($result1){
        $updateQuery = 'UPDATE center_garbage
                        SET
                          current_plastic = current_plastic - :plastic,
                          current_polythene = current_polythene - :polythene,
                          current_metal = current_metal - :metals,
                          current_glass = current_glass - :glass,
                          current_paper = current_paper - :paper_waste,
                          current_electronic = current_electronic - :electronic_waste
                        WHERE
                          center_id = :center_id;';

        $this->db->query($updateQuery);
        $this->db->bind(':center_id', $data['center_id']);
        $this->db->bind(':plastic', $data['plastic']);
        $this->db->bind(':polythene', $data['polythene']);
        $this->db->bind(':metals', $data['metals']);
        $this->db->bind(':glass', $data['glass']);
        $this->db->bind(':paper_waste', $data['paper_waste']);
        $this->db->bind(':electronic_waste', $data['electronic_waste']);
        $result2=$this->db->execute();

        if($result2){
          return true;

        }else{
          return false;
        }

        
      }else{
        return false;
      }

    }


}  