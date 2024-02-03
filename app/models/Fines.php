<?php
    class Fines{
        private $db;

        public function __construct(){
          $this->db = new Database;
        }

        public function set_fine($data){
            try{
                $this->db->query("UPDATE fines
                                SET fine_amount = CASE 
                                    WHEN type = 'minimum_collect' THEN :min_collect
                                    WHEN type = 'no_response' THEN :no_response
                                    WHEN type = 'cancelling_assigned' THEN :cancel_assigned
                                END
                                WHERE type IN ('minimum_collect', 'no_response', 'cancelling_assigned');
                                ");
                $this->db->bind(':min_collect', $data['minimum_collect']);
                $this->db->bind(':no_response', $data['no_response']);
                $this->db->bind(':cancel_assigned', $data['cancelling_assigned']);
            
                
                $result = $this->db->execute();
                return $result;

            }catch (PDOException $e){
                return false;
            }
            
        }

        public function get_fine_details(){
            try{
                $this->db->query('SELECT * FROM fines');
                $results = $this->db->resultSet();

                return $results;  


            }catch(PDOException $e){
                return false;
            }
        }
    
    }
