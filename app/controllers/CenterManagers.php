<?php
  class CenterManagers extends Controller {
    public function __construct(){
      if(!isLoggedIn('center_manager_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('center_managers/index', $data);
    }
    
    public function logout(){
      unset($_SESSION['center_manager_id']);
      unset($_SESSION['center_manager_email']);
      unset($_SESSION['center_manager_name']);
      session_destroy();
      redirect('users/login');
    }

    public function collectors(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('collectors/collector_main', $data);
    }
   
  }