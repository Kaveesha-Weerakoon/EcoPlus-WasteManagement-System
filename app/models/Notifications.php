<?php
  class Notifications {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function get_center_Notification($center_id){
        try {
            $this->db->query('SELECT * FROM center_notification WHERE center_id = :id AND mark_as_read IN ("False") ORDER BY date_time DESC');
            $this->db->bind(':id', $center_id);          
            $results = $this->db->resultSet();
            return $results;

        } catch (PDOException $e) {
            return false;
        }


    }

    public function view_center_Notification($center_id){
        try {
            $this->db->query('UPDATE center_notification SET mark_as_read = :value WHERE center_id = :id AND mark_as_read IN ("False")');
            
            $this->db->bind(':value', 'True');
            $this->db->bind(':id', $center_id);
            
            $this->db->execute();
        
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            return false;
        }
    }

   
}