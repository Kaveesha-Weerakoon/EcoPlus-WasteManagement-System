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
        } }catch (PDOException $e) {
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
        $this->db->query('INSERT INTO credits_transfer (sender_id,sender_image, receiver_id, receiver_image, date, time, transfer_amount) VALUES (:sender_id,:sender_image, :receiver_id, :receiver_image, :date, :time, :transfer_amount)');
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':sender_image', $sender_image);
        $this->db->bind(':receiver_id', $receiver_id);
        $this->db->bind(':receiver_image', $receiver_image);
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $this->db->bind(':transfer_amount', $transfer_amount);

        return $this->db->execute();
        }catch (PDOException $e) {
            return false;
        }
    }

    public function get_transaction_history($user_id) {
        try{
        $this->db->query('SELECT * FROM credits_transfer WHERE sender_id = :user_id OR receiver_id = :user_id ORDER BY CONCAT(date, " ", time) DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }catch (PDOException $e) {
        return false;
    }
    }

}











?>