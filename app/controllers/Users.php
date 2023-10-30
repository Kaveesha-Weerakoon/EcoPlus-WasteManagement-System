<?php
  class Users extends Controller {
    public function __construct(){
           $this->userModel=$this->model('User');
    }

    public function register(){
      // Check for POST
      if(isset($_SESSION['user_id']) ||isset($_SESSION['collector_id'])|| isset($_SESSION['center_manager_id']) ){
        redirect('pages');
     }
      else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
  
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data =[
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'contact_no' => trim($_POST['contact_no']),
            'address' => trim($_POST['address']),
            'city'=>trim($_POST['city']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'name_err' => '',
            'email_err' => '',
            'contact_no_err' => '',
            'address_err' => '',
            'city_err'=>'',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
  
           // Validate Email
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
  
          // Validate Contact no
          if(empty($data['contact_no'])){
            $data['contact_no_err'] = 'Pleae enter contact no';
          }
  
          // Validate Adress
          if(empty($data['address'])){
            $data['address_err'] = 'Pleae enter adress';
          }
  
          if(empty($data['city'])){
            $data['city_err'] = 'Pleae enter city';
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
  
          if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['city_err']) && empty($data['address_err'])){
            // Validated
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
  
            // Register User
            if($this->userModel->register($data)){
            
              redirect('users/login');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('users/register', $data);
          }
  
        } else {
          // Init data
          $data =[
            'name' => '',
            'email' => '',
            'contact_no' => '',
            'address' => '',
            'city'=>'',
            'password' => '',
            'confirm_password' => '',
  
            'name_err' => '',
            'email_err' => '',
            'contact_no_err' => '',
            'address_err' => '',
            'city_err'=>'',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
  
          // Load view
          $this->view('users/register', $data);
        }
      }
      
    }

    public function login(){
      if(isset($_SESSION['user_id']) ||isset($_SESSION['collector_id'])|| isset($_SESSION['center_manager_id'])  || isset($_SESSION['admin_id'])){
        if(isset($_SESSION['user_id'])){
          redirect('customers');
        }
        if(isset($_SESSION['collector_id'])){
          redirect('collectors');
        }
        if(isset($_SESSION['center_manager_id'])){
          redirect('centermanagers');
        }

        if(isset($_SESSION['admin_id'])){
          redirect('admin');
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
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }
         
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          }

          if($this->userModel->findUserByEmail($data['email'])){
            // User found
          } else {
            // User not found
            $data['email_err'] = 'No user found';
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            if($loggedInUser){
              if($loggedInUser->role=="customer"){
                $this->createUserSession($loggedInUser); 
              }
              else if($loggedInUser->role=="collector"){
                $this->createCollectorSession($loggedInUser);
              }
              else if($loggedInUser->role=="centermanager"){
                $this->createCenterManagerSession($loggedInUser);
              }
              else if($loggedInUser->role=="admin"){
                $this->createAdminSession($loggedInUser);
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
      $_SESSION['admin_id'] = $user->id;
      $_SESSION['admin_email'] = $user->email;
      $_SESSION['admin_name'] = $user->name;
      redirect('admin');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
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
  }