<?php
  class Customers extends Controller {
    public function __construct(){

      $this->customerModel=$this->model('Customer');

      if(!isLoggedIn('user_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/index', $data);
    }

    public function request_main(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/request_main', $data);
    }

    public function history(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/history', $data);
    }

    public function editprofile(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/edit_profile', $data);
    }
   
    public function complains(){
    
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
          'name' => trim($_POST['name']),
          'contact_no' => trim($_POST['contact_no']),
          'region' => trim($_POST['region']),
          'subject' => trim($_POST['subject']),
          'complain' => trim($_POST['complain']),
          'name_err' => '',
          'contact_no_err' => '',
          'region_err' => '',
          'subject_err' => '' ,
          'complain_err' => ''     
        ];

        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }
       
        // Validate Password
        if(empty($data['contact_no'])){
          $data['contact_no_err'] = 'Please enter contact no';
        }

        if(empty($data['region'])){
          $data['region_err'] = 'Pleae enter region';
        } 
        
        if(empty($data['subject'])){
          $data['subject_err'] = 'Pleae enter subject';
        }
        
        if(empty($data['complain'])){
          $data['complain_err'] = 'Pleae enter complain';
        }

        if(empty($data['name_err']) && empty($data['contact_no_err']) && empty($data['region_err']) && empty($data['subject_err']) && empty($data['complain_err']) ){
          if($this->customerModel->complains($data)){
            redirect('users/login');
          } else {
            die('Something went wrong');
          }
        }
        else{
              $this->view('customers/complains', $data);
             
        }
        die();
      }
      else
      $data =[
        'name' => '',
        'contact_no' => '',
        'region' => '',
        'subject' => '',
        'complain' => '',
        'name_err' => '',
        'contact_no_err' => '',
        'region_err' => '',
        'subject_err' => '' ,
        'complain_err' => ''     
      ];{
        $this->view('customers/complains', $data);
      }
     
    }

    public function request_collect(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/request_collect', $data);
    }

    public function transfer(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/transfer', $data);
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
   
  }