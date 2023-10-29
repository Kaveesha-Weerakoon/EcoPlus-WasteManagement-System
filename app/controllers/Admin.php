<?php
  class Admin extends Controller {
    public function __construct(){

      $this->adminModel=$this->model('Admins');
      $this->userModel=$this->model('User');

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

    public function center_managers(){

      $center_managers = $this->customerModel->get_center_managers();
      $data = [
        'center_managers ' => $center_managers 
      ];
     
      $this->view('admin/history_complains', $data);
    }

    public function center_managers_add(){
     
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
          'name' => trim($_POST['name']),
          'contact_no' => trim($_POST['contact_no']),
          'nic' => trim($_POST['nic']),
          'address' => trim($_POST['address']),
          'dob' => trim($_POST['dob']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'contact_no_err' => '',
          'nic_err' => '',
          'address_err' => '' ,
          'dob_err' => '' ,
          'email_err' => '' ,
          'password_err' => '' ,
          'complain_err' => '' ,
          'confirm_password_err'=>'' ,
          'completed'=>''   
        ];

        /*if($data['completed']=='True'){
          $data['completed']=='';
          $this->view('customers/complains', $data);
        }*/

        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        if(empty($data['nic'])){
          $data['nic_err'] = 'Pleae enter NIC';
        }

        if(empty($data['dob'])){
          $data['dob_err'] = 'Pleae enter dob';
        }

        // Validate Contact no
        if(empty($data['contact_no'])){
          $data['contact_no_err'] = 'Pleae enter contact no';
        }

        // Validate Adress
        if(empty($data['address'])){
          $data['address_err'] = 'Pleae enter adress';
        }
            // Validate Password
            if(empty($data['password'])){
              $data['password_err'] = 'Pleae enter password';
            } elseif(strlen($data['password']) < 6){
              $data['password_err'] = 'Password must be at least 6 characters';
            }
    
            // Validate Confirm Password
            if(empty($data['confirm_password'])){
              $data['confirm_password_err'] = 'Please confirm password';
            } else {
              if($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Passwords do not match';
              }
            }

            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['dob_err'])){
              // Validated
               $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
             
              if($this->adminModel->register_center_manager($data)){
                $data['completed']='True';        
                $this->view('admin/center_managers_add',$data);
              } else {
                die('Something went wrong');
              }
            }
            else{
              $this->view('admin/center_managers_add', $data);
            }
            

      }
      else{
        
        $data = [
          'name' =>'',
          'contact_no' => '',
          'nic' => '',
          'address' => '',
          'dob' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'contact_no_err' => '',
          'nic_err' => '',
          'address_err' => '' ,
          'dob_err' => '' ,
          'email_err' => '' ,
          'password_err' => '' ,
          'complain_err' => '' ,
          'confirm_password_err'=>'',
          'completed'=>''  
        ];
        $this->view('admin/center_managers_add', $data);
      }
    
      }

 
      public function logout(){
      unset($_SESSION['admin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
      session_destroy();
      redirect('users/login');
    }
   
  }