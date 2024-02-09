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
          return $row;//True was there
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
        $this->db->query('INSERT INTO center (region,district,center_manager_id,center_manager_name,lat,longi,radius) VALUES (:region,:district, :center_manager_id, :center_manager_name,:lat,:longi,:radius)');
       
        $centerManagers = $data['center_manager_data'];
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':lat', $data['lattitude']);
        $this->db->bind(':longi', $data['longitude']);
        $this->db->bind(':radius', $data['radius']);

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

                // if ($result_2) {
                //     return true;
                // } else {
                //     return false;
                // }
                if ($result_2) {
                  $this->db->query('INSERT INTO center_garbage (center_id,region) VALUES (:center_id, :region)');
                  $this->db->bind(':center_id', $id);
                  $this->db->bind(':region', $data['region']);
                  $result_3 = $this->db->execute();

                  if ($result_3) {
                    return true;
                  }else{
                    return false;
                  }

                } else{
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

    public function getCenterByRegion($region){
      $this->db->query('SELECT * FROM center WHERE region = :region');
      $this->db->bind(':region', $region);
      
      $result = $this->db->single();
      return $result;

    }

    public function changeCentermanager($centerid,$center_manager,$assigning_manager_name){
      try{
      $sql = 'UPDATE center SET center_manager_id = :newManagerId, center_manager_name = :newManagerName WHERE id = :centerId';

      $this->db->query($sql);
      $this->db->bind(':newManagerId',$center_manager->user_id);
      $this->db->bind(':newManagerName', $assigning_manager_name->name);
      $this->db->bind(':centerId', $centerid);
 
      $result= $this->db->execute();   
     }
     catch (PDOException $e) {
      return false;
     }
    }

    public function changeCenterLocation($data,$centerid){
      try{
        $sql = 'UPDATE center SET lat = :lat, longi = :longi,radius = :radius WHERE id =:id';
  
        $this->db->query($sql);
        $this->db->bind(':radius',$data['radius']);
        $this->db->bind(':longi', $data['longitude']);
        $this->db->bind(':lat', $data['lattitude']);
        $this->db->bind(':id', $centerid);

        $result= $this->db->execute();   
        if($result){
           return true;
        }
        else{
          return false;
        }
       }
       catch (PDOException $e) {
        die($e);
        return false;
       }
    }

    public function delete_center($center_id){
      $this->db->query('DELETE FROM center WHERE id = :id ');
      $this->db->bind(':id', $center_id);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        return true; 
      } else {
        return false; 
      }
    }

}