<?php

    class Center_Complaints{

        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function submit_complaint($data){
            try{
                $this->db->query('INSERT INTO center_complaints (center_id, region, center_manager_id, center_manager_name, subject, complaint, contact_no)
                                    VALUES (:center_id, :region, :cm_id, :cm_name, :subject, :complaint, :contact_no )');
                $this->db->bind(':center_id', $data['center_id']);
                $this->db->bind(':region', $data['region']);
                $this->db->bind(':cm_id', $data['cm_id']);
                $this->db->bind(':cm_name', $data['name']);
                $this->db->bind(':subject', $data['subject']);
                $this->db->bind(':complaint', $data['complaint']);
                $this->db->bind(':contact_no', $data['contact_no']);
                $result = $this->db->execute();
        
                if ($result) {
                        return $result; 
                } else {
                    
                    return false;
                }
                

            }catch (PDOException $e) {
                return false;
            }

        }






    }