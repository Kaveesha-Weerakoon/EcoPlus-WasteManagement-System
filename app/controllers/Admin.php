<?php
  class Admin extends Controller {
    public function __construct(){

      $this->adminModel=$this->model('Admins');

      if(!isLoggedIn('admin_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('admin/index', $data);
    }


    public function complain_customers(){
    
      $complains = $this->adminModel->get_customer_complains();
      $data = [
        'complains' => $complains
      ];
      
      $this->view('admin/complain_customers', $data);
    }

    public function logout(){
      unset($_SESSION['admin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
      session_destroy();
      redirect('users/login');
    }
   
  }