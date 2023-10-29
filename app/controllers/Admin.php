<?php
  class Admin extends Controller {
    public function __construct(){
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
    
    public function logout(){
      unset($_SESSION['admin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
      session_destroy();
      redirect('users/login');
    }
   
  }