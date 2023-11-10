<?php
  class Collectors extends Controller {
    public function __construct(){

      $this->collector_complain_Model=$this->model('Collector_Complain');
      $this->collectorModel=$this->model('Collector');
      $this->collector_assistantModel=$this->model('Collector_Assistant');
      $this->creditModel=$this->model('Credit_amount');

      if(!isLoggedIn('collector_id')){
        redirect('users/login');
      }
    }
    
    public function index(){

      $credit= $this->creditModel->get();
      $data = [
        'title' => 'TraversyMVC',
        'eco_credit_per'=>$credit
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

        //validate name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        } elseif (strlen($data['name']) > 255) {
          $data['name_err'] = 'Name is too long';
        }

        //validate NIC
        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }elseif(!(is_numeric($data['nic']) && (strlen($data['nic']) == 12)) && !preg_match('/^[0-9]{9}[vV]$/', $data['nic'])){
          $data['nic_err'] = 'Please enter a valid NIC';
        }elseif($this->collector_assistantModel->getCollectorAssisByNIC($data['nic'])){
          $data['nic_err'] = 'NIC already exists';
        }

        //validate DOB
        if(empty($data['dob'])){
          $data['dob_err'] = 'Please enter dob';
        }

        // Validate Contact no
        if(empty($data['contact_no'])){
          $data['contact_no_err'] = 'Please enter contact no';
        }elseif (!preg_match('/^[0-9]{10}$/', $data['contact_no'])) {
          $data['contact_no_err'] = 'Please enter a valid contact number';
        }

        // Validate Address
        if(empty($data['address'])){
          $data['address_err'] = 'Please enter adress';
        } elseif (strlen($data['address']) > 500) {
          $data['address_err'] = 'Address is too long ';
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

    public function collector_assistants_delete($assisId){
      $collector_assistant = $this->collector_assistantModel->getCollectorAssisById($assisId);
      if(empty($collector_assistant)){
        die('Center worker not found');
      }
      else{
        if($this->collector_assistantModel->delete_collector_assistants($assisId)){
          redirect('collectors/collector_assistants');
        }
        else{
          die('Something went wrong');
        }

      }
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
          'complain_err' => '' ,
          //'completed'=>''    
        ];
        
        /*if($data['completed']=='True'){
          $data['completed']=='';
          $this->view('collectors/complains', $data);
        }*/

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
          if($this->collector_complain_Model->complains($data)){
            $data['completed']="True";
            $this->view('collectors/complains', $data);
           
          } else {
            die('Something went wrong');
          }
        }
        else{     
              $this->view('collectors/complains', $data);         
        }
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
        'complain_err' => ''  ,
        'completed'=>''      
      ];{
        $this->view('collectors/complains', $data);
      }
     
    }
    
  
   
  }