<?php
  class Customers extends Controller {
    public function __construct(){

      $this->customer_complain_Model=$this->model('Customer_Complain');
      $this->creditModel=$this->model('Credit_amount');
      $this->customerModel=$this->model('Customer');
      if(!isLoggedIn('user_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $data = [
        'title' => 'TraversyMVC',
        'pop'=>''
      ];
     
      $this->view('customers/index', $data);
    }
    
    public function viewprofile(){
      $data = [
        'title' => 'TraversyMVC',
        'pop'=>'True',
        'name'=>'',
        'userid'=>'',
        'email'=>'',
        'contactno'=>'',
        'address'=>'',
        'city'=>''
      ];
      $id=$_SESSION['user_id']; 
      $user=$this->customerModel->get_customer($id);
      $data['name']=$_SESSION['user_name'];
      $data['userid']=$_SESSION['user_id'];
      $data['email']=$_SESSION['user_email'];
      $data['contactno']=$user->mobile_number;
      $data['address']=$user->address;
      $data['city']=$user->city;
      $this->view('customers/index', $data);
     
    }

    public function request_main(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/request_main', $data);
    }

    public function request_completed(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/request_completed', $data);
    }

    public function request_cancelled(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/request_cancelled', $data);
    }

    public function history(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/history', $data);
    }

    public function history_complains(){
      $id=$_SESSION['user_id']; 
      $complains = $this->customer_complain_Model->get_complains($id);

      $data = [
        'complains' => $complains
      ];
     
      $this->view('customers/history_complains', $data);
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
          'complain_err' => '' ,
          'completed'=>''    
        ];
        
        if($data['completed']=='True'){
          $data['completed']=='';
          $this->view('customers/complains', $data);
        }

        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }
       
        // Validate Password
        if(empty($data['contact_no'])){
          $data['contact_no_err'] = 'Please enter contact no';
        }

        if(empty($data['region'])){
          $data['region_err'] = 'Please enter region';
        } 
        
        if(empty($data['subject'])){
          $data['subject_err'] = 'Please enter subject';
        }
        
        if(empty($data['complain'])){
          $data['complain_err'] = 'Please enter the complain';
        }

        if(empty($data['name_err']) && empty($data['contact_no_err']) && empty($data['region_err']) && empty($data['subject_err']) && empty($data['complain_err']) ){
          if($this->customer_complain_Model->complains($data)){
            $data['completed']="True";
            $this->view('customers/complains', $data);
           
          } else {
            die('Something went wrong');
          }
        }
        else{     
              $this->view('customers/complains', $data);         
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
      $data = [];
     
     
      $this->view('customers/transfer', $data);
    }

    public function credit_per_waste(){
       $credit= $this->creditModel->get();
      $data = [
        'title' => 'TraversyMVC',
        'eco_credit_per'=>$credit
      ];
      $this->view('customers/credits_per_waste', $data);
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
   
  }