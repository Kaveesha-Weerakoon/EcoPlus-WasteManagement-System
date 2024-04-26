<?php
  class Users extends Controller {
    public function __construct(){
           $this->userModel=$this->model('User');
           $this->center_managerModel=$this->model('Center_Manager');
           $this->collectorModel=$this->model('Collector');
           $this->customerModel=$this->model('Customer');
           $this->discount_agentModel=$this->model('Discount_Agent');
           $this->Center_Model=$this->model('Center');
           $this->Admin_Model=$this->model('Admins');

          }
          public function index(){
            header("Location: " . URLROOT);      
          }
          
    public function register(){
      // Check for POST
      $centers = $this->Center_Model->getallCenters();
      $jsonData = json_encode($centers);

      if(isset($_SESSION['user_id']) ||isset($_SESSION['collector_id'])|| isset($_SESSION['center_manager_id']) ){
        redirect('pages');
     }
      else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
  
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data =[
            'name' => trim($_POST['name']),
            'email_reg' => trim($_POST['email_reg']),
            'contact_no' => trim($_POST['contact_no']),
            'address' => trim($_POST['address']),
            'city'=>trim($_POST['city']),
            'password_reg' => trim($_POST['password_reg']),
            'confirm_password' => trim($_POST['confirm_password']),
            'profile_image_name' => trim($_POST['email_reg']).'_'.$_FILES['profile_image']['name'],
            'centers'=>$jsonData,
            'centers2'=>$centers ,
            'name_err' => '',
            'email_reg_err' => '',
            'contact_no_err' => '',
            'address_err' => '',
            'city_err'=>'',
            'password_reg_err' => '',
            'confirm_password_err' => '',
            'profile_err'=>'',
            'profile_upload_error'=>'' ,
            'reg'=>'True',
            'email'=>'',
            'email_err'=>'' ,
            'password'=>'',
             'password_err'=>'',
             'email_err' => '',  'center_err'=>''

          ];

          if ($_FILES['profile_image']['error'] == 4) {
            $data['profile_image_name'] ='Profile.png';

        } else {
            if (uploadImage($_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/customer/')) {
              $data['profile_err'] = '';
  
            } else {
                $data['profile_err'] = 'Error uploading the profile image';
            }
        }
  
           // Validate Email
           if(empty($data['email_reg'])){
            $data['email_reg_err'] = 'Please enter an email';
        } else {
            // Check email format
            if(!filter_var($data['email_reg'], FILTER_VALIDATE_EMAIL)){
                $data['email_reg_err'] = 'Invalid email format';
            } else {
                // Check email length
                if(strlen($data['email_reg']) > 255) { // You can adjust the maximum length as needed
                    $data['email_reg_err'] = 'Email is too long';
                } else {
                    // Check email availability
                    if($this->userModel->findUserByEmail($data['email_reg'])){
                        $data['email_reg_err'] = 'Email is already taken';
                    }
                }
            }
        }
        
          // Validate Name
          if (empty($data['name'])) {
            $data['name_err'] = 'Please enter a name';
        } elseif (strlen($data['name']) > 255) {
            $data['name_err'] = 'Name is too long';
        }
        
          // Validate Contact no
          if (empty($data['contact_no'])) {
            $data['contact_no_err'] = 'Please enter a contact number';
        } elseif (!preg_match('/^[0-9]{10}$/', $data['contact_no'])) {
            $data['contact_no_err'] = 'Please enter a valid contact number';
        }
         
          // Validate Adress
          if (empty($data['address'])) {
            $data['address_err'] = 'Please enter an address';
          } elseif (strlen($data['address']) > 500) {
            $data['address_err'] = 'Address is too long ';
          }
        
          if (empty($data['city'])) {
            $data['city_err'] = 'Please enter a city';
          } elseif (strlen($data['city']) > 500) {
             $data['city_err'] = 'City name is too long';
        }
        


          if (empty($data['password_reg'])) {
            $data['password_reg_err'] = 'Please enter password';
          } elseif (strlen($data['password_reg']) < 8 || strlen($data['password_reg']) > 30) {
              $data['password_reg_err'] = 'password must be between 8 and 30 characters';

          } elseif (!preg_match('/[^\w\s]/', $data['password_reg'])) {
              $data['password_reg_err'] = 'password must include at least one symbol';

          } elseif (!preg_match('/[A-Z]/', $data['password_reg'])) {
              $data['password_reg_err'] = 'password must include at least one uppercase letter';

          } elseif (!preg_match('/[a-z]/', $data['password_reg'])) {
              $data['password_reg_err'] = 'password must include at least one lowercase letter';

          } elseif (!preg_match('/[0-9]/', $data['password_reg'])) {
            $data['password_reg_err'] = 'password must include at least one number';
          }

  
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Please confirm password';
          } else {
            if($data['password_reg'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Passwords do not match';
            }
          }

          if($data['city']=="default"){
            $data['center_err']="Select a region";
          }
  
          if(empty($data['center_err']) && empty($data['email_reg_err']) && empty($data['name_err']) && empty($data['password_reg_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['city_err']) && empty($data['address_err'])&& empty($data['profile_err'])){
            // Validated
            $pw=$data['password_reg'];
            $data['password_reg'] = password_hash($data['password_reg'], PASSWORD_DEFAULT);
         
            // Register User
            if($this->userModel->register($data)){
             
              $loggedInUser = $this->userModel->login($data['email_reg'], $pw);
              $customer=$this->customerModel->get_customer($loggedInUser->id);
              if($customer->image==''){
                $_SESSION['customer_profile'] = "Profile.png";
              }
              else{
                $_SESSION['customer_profile'] = $customer->image;
              }
              $this->createnewUserSession($loggedInUser); 
                
            
              }
             else {
              redirect('users/login');
            }
          } else {
            // Load view with errors
            $this->view('users/login', $data);
          }
  
        } else {
        
          $data =[
            'name' => '',
            'email_reg' => '',
            'contact_no' => '',
            'address' => '',
            'city'=>'',
            'password_reg' => '',
            'confirm_password' => '',
            'centers'=>$jsonData,
            'centers2'=>$centers ,
            'name_err' => '',
            'email_reg_err' => '',
            'contact_no_err' => '',
            'address_err' => '',
            'city_err'=>'',
            'confirm_password_err' => '',
            'password_reg_err'=>'',  
            'profile_err'=>'',
            'profile_upload_error'=>'',
            'reg'=>'True',
            'password'=>'',
            'email'=>'',
            'password'=>'',
            'password_err'=>'',
            'email_err' => '',
            'center_err'=>''
 
          ];
  
          // Load view
          $this->view('users/login', $data);
        }
      }
      
    }

    public function login(){
       // Check for POST
       $centers = $this->Center_Model->getallCenters();
       $jsonData = json_encode($centers);
      if(isset($_SESSION['user_id']) ||isset($_SESSION['collector_id'])|| isset($_SESSION['center_manager_id'])  || isset($_SESSION['admin_id']) || isset($_SESSION['agent_id']) ){
        if(isset($_SESSION['user_id'])){
          redirect('customers');
        }
        if(isset($_SESSION['collector_id'])){
          redirect('collectors');
        }
        if(isset($_SESSION['center_manager_id'])){
          redirect('centermanagers');
        }

        if(isset($_SESSION['admin_id'])||$_SESSION['super_admin_id']){
          redirect('admin');
        }

        if(isset($_SESSION['agent_id'])){
          redirect('CreditDiscountsAgent');
        }
      }
      else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',  
            'name' => '',
            'contact_no' => '',
            'address' => '',
            'city'=>'',
            'confirm_password' => '',
            'centers'=>$jsonData,
            'centers2'=>$centers ,
            'email_reg'=>'',
            'password_reg'=>'',
            'confirm_password_reg'=>'',
            'name_err' => '',
            'email_reg_err'=>'',
            'contact_no_err' => '',
            'address_err' => '',
            'city_err'=>'',
            'confirm_password_err' => '',
            'password_reg_err'=>'',   
            'profile_err'=>'',
            'profile_upload_error'=>'' ,
            'reg'=>'False',
            'center_err'=>''
          ];
          // Validate Email
          if(empty($data['email'])){ 
            $data['email_err'] = 'Please enter email';
          }
          else {
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
              $data['email_err'] = 'Invalid email format';
           }
           else{
            if($this->userModel->findUserByEmail($data['email'])){
              // User found
            } else {
              // User not found
              $data['email_err'] = 'User not found';
            }
          }
          }
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter the password';
          }

          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            if($loggedInUser){
              if($loggedInUser->role=="customer"){
                $customer=$this->customerModel->get_customer($loggedInUser->id);
                if($customer->blocked==TRUE){
                      $data['email_err'] = 'Your Account has been Blocked Contact Our Team';
                      $this->view('users/login', $data);
                }
                else{
                  if($customer->image==''){
                    $_SESSION['customer_profile'] = "profile.png";
                  }
                  else{
                    $_SESSION['customer_profile'] = $customer->image;
                  }
                  $this->createUserSession($loggedInUser); 
                
                } 
              }
              
              else if($loggedInUser->role=="collector"){
                $collector = $this->collectorModel->getCollectorById($loggedInUser->id);
                $_SESSION['center_id'] = $collector->center_id;
                $_SESSION['center'] = $collector->center_name;
                $_SESSION['collector_profile'] = $collector->image;
                $this->createCollectorSession($loggedInUser);
              }
              else if($loggedInUser->role=="centermanager"){
                $center_manager = $this->center_managerModel->getCenterManagerByID($loggedInUser->id);
                if($center_manager->assinged=='No'){
                  $data['email_err'] = 'You are not assigned';
                  $this->view('users/login', $data);
                }
                else{
                  $_SESSION['center_id'] = $center_manager->assigned_center_id;
                  $_SESSION['cm_profile'] = $center_manager->image;
                  $this->createCenterManagerSession($loggedInUser);
                }
                
              }
              else if($loggedInUser->role=="admin" || $loggedInUser->role=="superadmin"){
                $admin = $this->Admin_Model->getAdminByID($loggedInUser->id);
                $_SESSION['admin_profile'] = $admin->image;

                $this->createAdminSession($loggedInUser);
                
              }

             else if($loggedInUser->role=="discountagent"){
                $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($loggedInUser->id);

                $this->createDiscountAgentSession($loggedInUser);
                $_SESSION['agent_profile'] = $agent_by_id->image;
              }
              
            } else {
              $data['password_err'] = 'Password incorrect';
  
              $this->view('users/login', $data);
            }
          } else {
            // Load view with errors
            $this->view('users/login', $data);
          }
        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '', 

            'name' => '',
            'contact_no' => '',
            'address' => '',
            'city'=>'',
            'password' => '',
            'confirm_password' => '',
            'centers'=>$jsonData,
            'centers2'=>$centers ,
            'email_reg'=>'',
            'password_reg'=>'',
            'confirm_password_reg'=>'',
            'name_err' => '',
            'email_reg_err'=>'',
            'contact_no_err' => '',
            'address_err' => '',
            'city_err'=>'',
            'confirm_password_err' => '',
            'password_reg_err'=>'',  
            'profile_err'=>'',
            'profile_upload_error'=>'',
            'reg'=>'False',
            'center_err'=>''
          ];
          $this->view('users/login', $data);
        }
      }
     
    }

 

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('customers');
    } 
    
    public function createnewUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('customers/True');
    }

    public function createCollectorSession($user){
      $_SESSION['collector_id'] = $user->id;
      $_SESSION['collector_email'] = $user->email;
      $_SESSION['collector_name'] = $user->name;
      redirect('collectors');
    }

    public function createCenterManagerSession($user){
      $_SESSION['center_manager_id'] = $user->id;
      $_SESSION['center_manager_email'] = $user->email;
      $_SESSION['center_manager_name'] = $user->name;
    
      redirect('centermanagers');
    }

    public function createAdminSession($user){
      if($user->role=="superadmin"){
        $_SESSION['superadmin_id'] = $user->id;
        $_SESSION['admin_email'] = $user->email;
        $_SESSION['admin_name'] = $user->name;
      }
      if($user->role=="admin"){
        $_SESSION['admin_id'] = $user->id;
        $_SESSION['admin_email'] = $user->email;
        $_SESSION['admin_name'] = $user->name;
      }
      redirect('admin');

    }

    public function createDiscountAgentSession($user){
      $_SESSION['agent_id'] = $user->id;
      $_SESSION['agent_email'] = $user->email;
      $_SESSION['agent_name'] = $user->name;
      redirect('CreditDiscountsAgent');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      unset($_SESSION['customer_profile']);
      session_destroy();
      redirect('users/login');
    }

    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }

    public function resetpassword(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          // Init data
          $data = [
              'email' => trim($_POST['email']),
              'email_err' => ''    
          ];
  
          // Validate Email
          if(empty($data['email'])){
              $data['email_err'] = 'Please enter email';
          } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
              $data['email_err'] = 'Invalid email format';
          } elseif(!$this->userModel->findUserByEmail($data['email'])){
              // User not found
              $data['email_err'] = 'User not found';
          }
  
          $this->view('users/resetpassword', $data);
      } else {
          // Init data
          $data = [
              'email' => '',
              'email_err' => ''       
          ];
          $this->view('users/resetpassword', $data);
      }
  }
}