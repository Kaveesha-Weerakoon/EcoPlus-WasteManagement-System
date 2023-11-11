<?php
  class Admin extends Controller {
    public function __construct(){

      $this->adminModel=$this->model('Admins');
      $this->userModel=$this->model('User');
      $this->creditModel=$this->model('Credit_amount');
      $this->customerModel=$this->model('Customer');
      $this->center_managerModel=$this->model('Center_Manager');
      $this->customer_complain_Model=$this->model('Customer_Complain');

      if(!isLoggedIn('admin_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $data = [
        'pop_eco_credits' => '',
      ];
     
      $this->view('admin/index', $data);
    }

    public function pop_eco_credit(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'pop_eco_credits' => 'True',
        'plastic_credit' =>trim($_POST['plastic']),
        'polythene_credit'=>trim($_POST['polythene']),
        'paper_credit'=>trim($_POST['paper']),
        'glass_credit'=>trim($_POST['glass']),
        'electronic_credit'=>trim($_POST['electronic']),
        'metal_credit'=>trim($_POST['metal']),
        'plastic_credit_err'=>'',
        'polythene_credit_err'=>'',
        'paper_credit_err'=>'',
        'electronic_credit_err'=>'',
        'metal_credit_err'=>'',
        'glass_credit_err'=>''
      ];

      if(empty($data['plastic_credit'])){
        $data['plastic_credit_err'] = 'Please enter name';  
       
      }

      if(empty($data['polythene_credit'])){
        $data['polythene_credit_err'] = 'Please enter NIC'; 
      }

      if(empty($data['paper_credit'])){
        $data['paper_credit_err'] = 'Please enter dob'; 
      }

      // Validate Contact no
      if(empty($data['electronic_credit'])){
        $data['electronic_credit_err'] = 'Please enter contact no';   
      }

      if(empty($data['metal_credit'])){
        $data['metal_credit_err'] = 'Please enter contact no'; 
      }

      if(empty($data['glass_credit_err'])){
        $data['glass_credit_err'] = 'Please enter contact no';  
      }

      if(!empty($data['metal_credit']) &&  !empty($data['plastic_credit']) &&  !empty($data['polythene_credit']) &&  !empty($data['glass_credit'])  &&  !empty($data['paper_credit'])  &&  !empty($data['electronic_credit']) ){
        if($this->creditModel->update($data)){
          /*$data['completed']='True';  */      
          $this->view('admin/index',$data);
        } else {
          die('Something went wrong');
        }

      }
      else{
        $this->view('admin/index', $data);
      }
    
      $this->view('admin/index', $data);

      }
      else{

        $credit= $this->creditModel->get();
        $data = [
           'pop_eco_credits'=>'True',
           'credit' => $credit,
           'plastic_credit' =>$credit->plastic,
           'polythene_credit'=>$credit->polythene,
           'paper_credit'=>$credit->paper,
           'glass_credit'=>$credit->glass,
           'electronic_credit'=>$credit->electronic,
           'metal_credit'=>$credit->metal
        ];
       
        $this->view('admin/index', $data);

      }
    }


    public function complain_customers(){
    
      $complains = $this->customer_complain_Model->get_customer_complains();
      $data = [
        'complains' => $complains
      ];
      
      $this->view('admin/complain_customers', $data);
    }


    public function complain_delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){     

        if($this->customerModel->deletecomplain($id)){
          redirect('./');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('$url');
      }
    }
    

    public function center_managers(){

      $center_managers = $this->center_managerModel->get_center_managers();
      $data = [
        'center_managers' => $center_managers 
      ];
     
      $this->view('admin/center_managers', $data);
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
          'registered'=>''   
        ];

        /*if($data['completed']=='True'){
          $data['completed']=='';
          $this->view('customers/complains', $data);
        }*/

        if(empty($data['email'])){
          $data['email_err'] = 'Please enter an email';
        } else {
          if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $data['email_err'] = 'Invalid email format';
          } 
          else{
            if($this->userModel->findUserByEmail($data['email'])){
              $data['email_err'] = 'Email is already taken';
            }
          }   
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }
        elseif (strlen($data['name']) > 255) {
          $data['name_err'] = 'name is too long ';
        }

        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }
        elseif (strlen($data['nic']) !== 12) {
          $data['nic_err'] = 'Please enter a valid nic number';
      }

        if(empty($data['dob'])){
          $data['dob_err'] = 'Please enter dob';
        }

        // Validate Contact no
        if (empty($data['contact_no'])) {
          $data['contact_no_err'] = 'Please enter a contact number';
      } elseif (!preg_match('/^[0-9]{10}$/', $data['contact_no'])) {
          $data['contact_no_err'] = 'Please enter a valid contact number';
      }
      

        // Validate Adress
        if(empty($data['address'])){
          $data['address_err'] = 'Please enter an address';
        }
        elseif (strlen($data['address']) > 255) {
          $data['address_err'] = 'address is too long ';
        }
            // Validate Password
            if(empty($data['password'])){
              $data['password_err'] = 'Please enter password';
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
             
              if($this->center_managerModel->register_center_manager($data)){
                $data['registered']='True';        
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
          'registered'=>''  
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

    public function customers(){
      
      $customers = $this->customerModel->get_all();
      $data = [
        'customers' =>$customers
      ];
     
      $this->view('admin/customer_main', $data);
    }

    public function center(){
      $data = [
        'customers' =>'$customers'
      ];
       $this->view('admin/center_view', $data);
    }

    public function center_add(){

      $na_center_managers = $this->center_managerModel->get_not_assisgned_center_managers();
      $data = [
        'customers' => $na_center_managers
      ];
       $this->view('admin/center_add', $data);
    }
   
  }