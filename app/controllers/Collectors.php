<?php
  class Collectors extends Controller {
    public function __construct(){
      if(!isLoggedIn('collector_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('collectors/index', $data);
    }
    
    public function logout(){
      unset($_SESSION['collector_id']);
      unset($_SESSION['collector_email']);
      unset($_SESSION['collector_name']);
      session_destroy();
      redirect('users/login');
    }

    public function collector_assistants(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('collectors/collector_assistants', $data);
    }

    public function collector_assistants_add(){
      $data = [
        'name' => '',
        'nic' => '',
        'dob'=>''.
        'address' =>''
      ];
     
      $this->view('collectors/collector_assistants_add', $data);
    }
   
  }