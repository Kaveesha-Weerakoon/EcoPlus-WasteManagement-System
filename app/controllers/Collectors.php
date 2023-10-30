<?php
  class Collectors extends Controller {
    public function __construct(){

      $this->collectorModel=$this->model('Collector');
      $this->collector_assistantModel=$this->model('Collector_Assistant');

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

      $collector_assistants = $this->collector_assistantModel->get_collector_assistants($_SESSION['collector_id']);
      $data = [
        'collector_assistants' => $collector_assistants
      ];
     
      $this->view('collectors/collector_assistants', $data);
    }

    public function collector_assistants_add(){
     
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
          $data['address_err'] = 'Please enter adress';
        }

        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) ){
          if($this->collector_assistantModel->add_collector_assistants($data)){
            $data['completed']='True';        
            $this->view('collectors/collector_assistants_add',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('collectors/collector_assistants_add', $data);

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
          'address_err' =>''
        ];
        
        $this->view('collectors/collector_assistants_add', $data);
      }

      
    }

  
   
  }