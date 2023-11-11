<?php
  class Center {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function findCenterbyRegion($region){
        $this->db->query('SELECT * FROM center WHERE region = :region');
        $this->db->bind(':region', $region);
  
        $row = $this->db->single();
  
        // Check row
        if($this->db->rowCount() > 0){
          return true;
        } else {
          return false;
        }
    }  

    public function getallCenters(){
      $this->db->query('SELECT * FROM center');
      $results = $this->db->resultSet();
      return $results;
    }

    public function addCenter($data){
        $this->db->query('INSERT INTO center (region, address, district, center_manager_id, center_manager_name) VALUES (:region, :address, :district, :center_manager_id, :center_manager_name)');
       
        $centerManagers = $data['center_manager_data'];
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':center_manager_id', $centerManagers->user_id);
        $this->db->bind(':center_manager_name', $data['center_manager_name']->name);   
        $result = $this->db->execute();

        if ($result) {
            $this->db->query('SELECT `id` FROM `center` WHERE `region` = :desired_region');
            $this->db->bind(':desired_region', $data['region']);
            $result_1 = $this->db->single();

            if ($result_1) {
                $id = $result_1->id;

                $this->db->query('UPDATE `center_managers` SET `assinged` = :assigned, `assigned_center_id` = :assigned_center_id WHERE `user_id` = :center_manager_id');
                $this->db->bind(':assigned', "True");
                $this->db->bind(':assigned_center_id', $id);
                $this->db->bind(':center_manager_id', $centerManagers->user_id);
                $result_2 = $this->db->execute();

                if ($result_2) {
                    return true;
                } else {
                    return false;
                }
            }
            else {
              return false;
            }
        } else {
           return false;
         }
    }

    public function getCenterById($centerid){
      $this->db->query('SELECT * FROM center WHERE id = :id');
      $this->db->bind(':id', $centerid);
      
      $row = $this->db->single();
      
      // Check row
      if ($row !== false) {
          
          return $row;
      } else {
          // Query failed or no matching row found
          return false;
      }
    }

}