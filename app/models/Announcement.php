<?php
  class Announcement {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllAnnouncements(){
        try{
          $this->db->query('SELECT * FROM annoucement ORDER BY date DESC');            
            $results = $this->db->resultSet();
            return $results;
        } 
        catch (PDOException $e) {
            return false;
      }
    }

    public function addAnnouncement($data){
      try{
        $this->db->query('INSERT INTO annoucement (img, text, header) VALUES (:image, :text, :header)');

        $this->db->bind(':image', $data['image']);
        $this->db->bind(':header', $data['header']);
        $this->db->bind(':text', $data['text']);
        $result = $this->db->execute();
      }
      catch (PDOException $e) {
        return false;
      }
    }

    public function deleteAnnouncement($id){
      try{$this->db->query('DELETE FROM annoucement WHERE id = :announcementId');
      $this->db->bind(':announcementId', $id);
    
      if($this->db->execute()){
        return true;
       }
       else{
        return false;
       }
      }
      catch (PDOException $e) {
        return false;
       }
    }
}