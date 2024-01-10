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

}