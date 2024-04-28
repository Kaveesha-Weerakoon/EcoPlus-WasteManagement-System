<?php
  class Customer_Credit {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get customer's credit balance by user_id
    public function get_customer_credit_balance($user_id) {
        try{
         
        $this->db->query('SELECT credit_amount FROM customer_credits WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $result = $this->db->single();
     
        if ($result) {
            return $result->credit_amount;
        } else {
            return 0; 
        } 
        }catch (PDOException $e) {
            return false;
        }
    }

    public function update_credit_balance($user_id, $new_balance) {
        try{
        $this->db->query('UPDATE customer_credits SET credit_amount = :new_balance WHERE user_id = :user_id');
        $this->db->bind(':new_balance', $new_balance);
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
        }catch (PDOException $e) {
          
            return false;
        }
    }


    public function record_credit_transfer($sender_id,$sender_image, $receiver_id, $receiver_image, $date, $time, $transfer_amount) {
        try{
        $this->db->query('INSERT INTO credits_transfer (sender_id, receiver_id, transfer_amount) VALUES (:sender_id, :receiver_id, :transfer_amount)');
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id);

        $this->db->bind(':transfer_amount', $transfer_amount);

        return $this->db->execute();
        }catch (PDOException $e) {
            return false;
        }
    }

    public function get_transaction_history($user_id) {
        try{
        $this->db->query('
        SELECT 
        credits_transfer.*, 
        c.image AS sender_img, 
        c2.image AS receiver_img
        FROM 
        credits_transfer
         LEFT JOIN 
         customers c ON c.user_id = credits_transfer.sender_id 
             LEFT JOIN 
         customers c2 ON c2.user_id = credits_transfer.receiver_id
             WHERE 
        credits_transfer.sender_id = :user_id OR credits_transfer.receiver_id = :user_id 
            ORDER BY 
        CONCAT(credits_transfer.date, " ", credits_transfer.time) DESC;
    
       ');


        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
     } catch (PDOException $e) {
         return false;
     }
    }

}











?>