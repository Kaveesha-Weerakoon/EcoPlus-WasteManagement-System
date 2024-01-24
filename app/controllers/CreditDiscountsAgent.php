<?php
  class CreditDiscountsAgent extends Controller {
    public function __construct(){
      $this->User_Model=$this->model('User');

   
        
    }


    public function index(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('credit_discount_agents/index', $data);
    }

    public function logout(){
      unset($_SESSION['agent_id']);
      unset($_SESSION['agent_email']);
      unset($_SESSION['agent_name']);
      session_destroy();
      redirect('users/login');
    }

}