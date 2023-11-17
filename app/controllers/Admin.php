<?php
  class Admin extends Controller {
    public function __construct(){

      $this->adminModel=$this->model('Admins');
      $this->userModel=$this->model('User');
      $this->creditModel=$this->model('Credit_amount');
      $this->customerModel=$this->model('Customer');
      $this->center_managerModel=$this->model('Center_Manager');
      $this->customer_complain_Model=$this->model('Customer_Complain');
      $this->center_model=$this->model('Center');
      $this->collector_model=$this->model('Collector');
      $this->collector_complain_Model=$this->model('Collector_Complain');

      if(!isLoggedIn('admin_id')){
        redirect('users/login');
      }
    }

    public function logout(){
      unset($_SESSION['admin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
       session_destroy();
      redirect('users/login');
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
        'center_managers' => $center_managers,
        'confirm_delete' =>'',
        'assigned'=>'',
        'success'=>''
      ];
     
      $this->view('admin/center_managers', $data);
    }

    public function center_managers_delete_confirm($id){
      $center_managers = $this->center_managerModel->get_center_managers();
      $centermanger = $this->center_managerModel->getCenterManagerByID($id);
      if($centermanger){
        $data = [
          'center_managers' => $center_managers,
          'confirm_delete' =>'True',
          'assigned'=> $centermanger->assinged,
          'center_manager_id'=>$id,
          'success'=>''
        ];
      }
      else{
        $data = [
          'center_managers' => $center_managers,
          'confirm_delete' =>'True',
          'assigned'=> '',
          'center_manager_id'=>$id,
          'success'=>''
        ];
      }
    
     
      $this->view('admin/center_managers', $data);
    }

    public function center_managers_delete($id) {
      $cm_id = $this->center_managerModel->getCenterManagerByID($id);
      $this->center_managerModel->delete_centermanager($id);
      $center_managers = $this->center_managerModel->get_center_managers();
      deleteImage("C:\\xampp\\htdocs\\ecoplus\\public\\img\\img_upload\\center_manager\\" . $cm_id->image);
      $data = [
        'center_managers' => $center_managers,
        'confirm_delete' =>'',
        'assigned'=>'',
        'success'=>'True'
      ];
    
      $this->view('admin/center_managers', $data);
    }

    public function center_managers_add(){
     
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
          'name' => trim($_POST['name']),
          'profile' => $_FILES['profile_image'],
           'contact_no' => trim($_POST['contact_no']),
          'profile_image_name' => trim($_POST['email']).'_'.$_FILES['profile_image']['name'],
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
          'profile_err'=>'error',
          'confirm_password_err'=>'' ,
          'registered'=>'',
           'profile_upload_error'=>''   
        ];

        if ($_FILES['profile_image']['error'] == 4) {
          $data['profile_err'] = 'Upload a image';
      } else {
          if (uploadImage($_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/center_manager/')) {
            $data['profile_err'] = '';

          } else {
              $data['profile_err'] = 'Error uploading the profile image';
          }
      }
     
       //validate email
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

        //validate NIC
        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }elseif(!(is_numeric($data['nic']) && (strlen($data['nic']) == 12)) && !preg_match('/^[0-9]{9}[vV]$/', $data['nic'])){
          $data['nic_err'] = 'Please enter a valid NIC';
        }elseif($this->center_managerModel->getCenterManagerByNIC($data['nic'])){
          $data['nic_err'] = 'NIC already exists';
        }

        //validate DOB
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

        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['dob_err']) && empty($data['profile_err'])){
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
          'profile'=>'',
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
          'profile_err'=>'',
          'password_err' => '' ,
          'complain_err' => '' ,
          'confirm_password_err'=>'',
          'registered'=>'' ,         
          'profile_upload_error'=>''   

        ];
        $this->view('admin/center_managers_add', $data);
      }
    
    }

    public function customers(){
      
      $customers = $this->customerModel->get_all();
      $data = [
        'customers' =>$customers
      ];
     
      $this->view('admin/customer_main', $data);
    }

    public function center(){

      $centers = $this->center_model->getallCenters();
      $data = [
        'centers' =>$centers,
        'delete_center'=>''
      ];
       $this->view('admin/center_view', $data);
    }

    public function center_add(){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
        $data =[
            'center_managers' => $na_center_managers,
            'address' => trim($_POST['address']),
            'district' =>trim($_POST['district']),
            'region' =>trim($_POST['region']),
            'center_manager'=>trim($_POST['centerManager']),
            'address_err' => '',
            'district_err' =>'',
            'region_err' =>'',
            'center_manager_err'=>'',
            'center_manager_data'=>'',
            'center_manager_name'=>'',
            'center_add_success'=>''
        ];

        if(empty($data['address'])){
          $data['address_err']='Please enter a address';
        }

        if(empty($data['district'])){
          $data['district_err']='Please enter a district';
        }

        if(empty($data['region'])){
          $data['region_err']='Please enter a region';
        }
        else{
          if($this->center_model->findCenterbyRegion($data['region'])){
            $data['region_err'] = 'Region already exists';
        }
        }

        if( $data['center_manager']=='default'){
          $this->view('admin/center_add', $data);
        }
        
        if(empty($data['region_err']) &&  empty($data['address_err']) && empty($data['district_err'] ) && empty($data['center_manager_err'] )){
            
            $data['center_manager_data']=$this->center_managerModel->getCenterManagerByID($data['center_manager']);
            $data['center_manager_name']=$this->userModel->findUserById($data['center_manager']);

            if($this->center_model->addcenter($data)){
              $data['center_add_success']='True';
              $this->view('admin/center_add', $data);
            } else {
              die('Something went wrong');
            }
        }
        else{
          $this->view('admin/center_add', $data);
        }
      }
      else{
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
        $data = [
          'center_managers' => $na_center_managers,
          'address' => '',
          'district' =>'',
          'center_manager'=>'',
          'region' =>'',
          'address_err' => '',
          'district_err' =>'',
          'region_err' =>'',
          'center_manager_err'=>'',
          'center_add_success'=>''
        ];
         $this->view('admin/center_add', $data);
      }
      
    }

    public function center_delete($center_id){
      $centers = $this->center_model->getallCenters();
      $data = [
        'centers' =>$centers,
        'delete_center'=>'True',
        'center_id'=>$center_id,
        
      ];
       $this->view('admin/center_view', $data);
    }

    public function center_delete_confirm($center_id){
      $center = $this->center_model->getCenterById($center_id);
      $centers = $this->center_model->getallCenters();

      $collectors = $this->collector_model->get_collectors_bycenterid($center_id);
    
      foreach ($collectors as $collector) {
            $this->userModel->deleteuser($collector->user_id);
      }

      $this->center_managerModel->Remove_Assign($center->center_manager_id);
      $this->center_model->delete_center($center_id);

      $data = [ 
        'centers' =>$centers,
        'delete_center'=>''
      ];
       $this->center();
    }

    public function collectors(){
      $collectors =$this->collector_model->get_collectors();
      $data = [
        'collectors' =>$collectors
      ];
     
      $this->view('admin/collectors', $data);
    }

    public function complain_collectors(){

      $collector_complains= $this->collector_complain_Model->get_complains();

      $data = [
        'complains' => $collector_complains
      ];
      $this->view('admin/complain_collectors', $data);
    }

    public function center_main($center_id){
      $center=$this->center_model->getCenterById($center_id);
      $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();

      $data = [
        'center' =>$center,
        'not_assigned_cm'=>$na_center_managers,
        'change_cm'=>''
      ];
      $this->view('admin/center_main', $data);
    }

    public function center_main_change_cm($center_id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
        $center=$this->center_model->getCenterById($center_id);
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
  
        $data = [
          'center' =>$center,
          'not_assigned_cm'=>$na_center_managers,
          'change_cm'=>'True',
          'center_manager'=>trim($_POST['centerManager']),
        ];
        if($data['center_manager']=='default'){
          $this->view('admin/center_main', $data);
        }
        else{

          $assining_manger = $this->center_managerModel->getCenterManagerByID($data['center_manager']);
          $old_manager = $this->center_managerModel->getCenterManagerByID($center->center_manager_id);
          $assigning_manager_name=$this->userModel->findUserById($data['center_manager']);

          $this->center_model->changeCentermanager($center->id,$assining_manger,$assigning_manager_name );
          $result=$this->center_managerModel->change_center_managers($assining_manger,$old_manager,$center_id );
          if( $result){
            $center=$this->center_model->getCenterById($center_id);
          }   
          $data = [
            'center' =>$center,
            'not_assigned_cm'=>$na_center_managers,
            'change_cm'=>'',
            'center_manager'=>trim($_POST['centerManager']),
          ];
          $this->center_main($center_id);
        }
        
      }else{
        $center=$this->center_model->getCenterById($center_id);
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
  
        $data = [
          'center' =>$center,
          'not_assigned_cm'=>$na_center_managers,
          'change_cm'=>'True'
        ];
        $this->view('admin/center_main', $data);
      }
     
    }
   
  }