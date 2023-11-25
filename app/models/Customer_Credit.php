<?php
  class Customer_Credit {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

   

    // Get customer's credit balance by user_id
    public function get_customer_credit_balance($user_id) {
        $this->db->query('SELECT credit_amount FROM customer_credits WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $result = $this->db->single();

        if ($result) {
            return $result->credit_amount;
        } else {
            return 0; 
        }
    }


    public function update_credit_balance($user_id, $new_balance) {
        $this->db->query('UPDATE customer_credits SET credit_amount = :new_balance WHERE user_id = :user_id');
        $this->db->bind(':new_balance', $new_balance);
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
    }
}











?>