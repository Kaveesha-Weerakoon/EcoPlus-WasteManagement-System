<?php
  class CenterManagers extends Controller {
    public function __construct(){

      $this->centerworkerModel=$this->model('Center_Worker');
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

    public function center_workers(){


      $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
      $data = [
        'center_workers' => $center_workers
      ];
     
     
      $this->view('center_managers/center_workers', $data);
    }

    public function center_workers_add(){
     
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
               'name' =>trim($_POST['name']),
               'nic' => trim($_POST['nic']),
               'dob'=>trim($_POST['dob']),
               'contact_no'=>trim($_POST['contact_no']),
               'address' =>trim($_POST['address']),
               'completed'=>'',
               
               'name_err' => '',
               'nic_err' => '',
               'dob_err'=>'',
               'contact_no_err'=>'',
               'address_err' =>''
               
        ];

        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }

        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }

        if(empty($data['dob'])){
          $data['dob_err'] = 'Please enter dob';
        }

        // Validate Contact no
        if(empty($data['contact_no'])){
          $data['contact_no_err'] = 'Please enter contact no';
        }

        // Validate Adress
        if(empty($data['address'])){
          $data['address_err'] = 'Please enter address';
        }

        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) ){
          if($this->centerworkerModel->add_center_workers($data)){
            $data['completed']='True';       
            $this->view('center_managers/center_workers_add',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('center_managers/center_workers_add', $data);
        }
      
      }
      else{
        $data = [
          'name' => '',
          'nic' => '',
          'dob'=>'',
          'contact_no'=>'',
          'address' =>'',
          'completed'=>'',
          'name_err' => '',
          'nic_err' => '',
          'dob_err'=>'',
          'contact_no_err'=>'',
          'address_err' =>'',
          'completed' =>''
        ];
        
        $this->view('center_managers/center_workers_add', $data);
      }

      
    }

   
  }