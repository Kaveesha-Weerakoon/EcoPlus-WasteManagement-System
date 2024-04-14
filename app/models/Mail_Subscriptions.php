<?php 
    class Mail_Subscriptions{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function save_subscription($data){
            try{
                $this->db->query("INSERT INTO mail_subscriptions (name , email) VALUES (:name, :email)");
                $this->db->bind(':name' , $data['name']);
                $this->db->bind(':email' , $data['email']);

                $result = $this->db->execute();

                if($result){
                    return true;

                }else{
                    return false;
                }



            }catch (PDOException $e) {
                echo 'An error occurred: ' . $e->getMessage();
                return false;

            }
    

        }

        public function get_mail_subscriptions(){
            try{
                $this->db->query('SELECT * FROM mail_subscriptions');
                $result = $this->db->resultSet();

                return $result;


            }catch (PDOException $e){
                return false;
            }
        }


    }
