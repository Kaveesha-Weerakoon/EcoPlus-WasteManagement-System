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
      // $this->collector_assistants_Model=$this->model('collector_assistants');
      $this->center_workers_model=$this->model('Center_Worker');
      $this->requests_model=$this->model('Request');

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
      $credit= $this->creditModel->get();
      $center_managers = $this->center_managerModel->get_center_managers();
      $customers = $this->customerModel->get_all();
      $collectors =$this->collector_model->get_collectors();
      $centers = $this->center_model->getallCenters();
      $jsonData = json_encode($centers );
      $data = [
        'pop_eco_credits' => '',
        'credit' => $credit,
        'plastic_credit' =>$credit->plastic,
        'polythene_credit'=>$credit->polythene,
        'paper_credit'=>$credit->paper,
        'glass_credit'=>$credit->glass,
        'electronic_credit'=>$credit->electronic,
        'metal_credit'=>$credit->metal,
        'cm_count'=>count($center_managers),      
        'customer_count'=>count($customers),
        'collector_count'=>count( $collectors),
        'centers'=>$jsonData

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
        $data['plastic_credit_err'] = 'Please enter a value';  
       
      }

      if(empty($data['polythene_credit'])){
        $data['polythene_credit_err'] = 'Please enter a value'; 
      }

      if(empty($data['paper_credit'])){
        $data['paper_credit_err'] = 'Please enter a value'; 
      }

      // Validate Contact no
      if(empty($data['electronic_credit'])){
        $data['electronic_credit_err'] = 'Please enter a value';   
      }

      if(empty($data['metal_credit'])){
        $data['metal_credit_err'] = 'Please enter a value'; 
      }

      if(empty($data['glass_credit_err'])){
        $data['glass_credit_err'] = 'Please enter a value';  
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
        'success'=>'',
        'click_update' =>'',
        'update_success'=>'',
        'confirm_delete'=> '',
        'personal_details_click'=>''
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
          'success'=>'',
          'personal_details_click'=>'',
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
        'success'=>'True',
        'personal_details_click'=>''
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
          'profile_err'=>'',
          'confirm_password_err'=>'' ,
          'registered'=>'',
           'profile_upload_error'=>''   
        ];

    
     
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
        if ($_FILES['profile_image']['error'] == 4) {
          $data['profile_err'] = 'Upload a image';
     
        }

        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['dob_err'])){
          if ($_FILES['profile_image']['error'] == 4) {
            $data['profile_err'] = 'Upload a image';
        } else {
            if (uploadImage($_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/center_manager/')) {
              $data['profile_err'] = '';
  
            } else {
                $data['profile_err'] = 'Error uploading the profile image';
            }
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

    public function center_managers_update($managerId){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $center_managers = $this->center_managerModel->get_center_managers();
            $data = [
                'center_managers' => $center_managers,
                'id'=> $managerId,
                'name' =>trim($_POST['name']),
                'nic' => trim($_POST['nic']),
                'dob'=>trim($_POST['dob']),
                'contact_no'=>trim($_POST['contact_no']),
                'address' =>trim($_POST['address']),
                'click_update' =>'True',
                'update_success'=>'',
                'confirm_delete'=> '',          
                'name_err' => '',
                'nic_err' => '',
                'dob_err'=>'',
                'contact_no_err'=>'',
                'address_err' =>'',
                'personal_details_click'=>'',
                'success'=>''  
            ];

        //validate name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }elseif (strlen($data['name']) > 255) {
          $data['name_err'] = 'Name is too long';
        }

        //validate NIC
        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }elseif(!(is_numeric($data['nic']) && (strlen($data['nic']) == 12)) && !preg_match('/^[0-9]{9}[vV]$/', $data['nic'])){
          $data['nic_err'] = 'Please enter a valid NIC';
        }elseif($this->center_managerModel->getCenterManagerByNIC_except($data['nic'] , $managerId)){
          $data['nic_err'] = 'Already exists a center manager under this NIC';
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
          $data['address_err'] = 'Please enter address';
        }elseif (strlen($data['address']) > 500) {
          $data['address_err'] = 'Address is too long ';
        }

        
        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) ){
          if($this->center_managerModel->update_center_managers($data)){
            $data['update_success']='True';       
            $this->view('admin/center_managers',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('admin/center_managers', $data);
        }

        //$this->view('admin/center_managers', $data);
      
      }
      else{

        $center_managers = $this->center_managerModel->get_center_managers();
        $center_manager = $this->center_managerModel->getCenterManager_ByID_view($managerId);
        $data = [

          'center_managers' => $center_managers,
          'id'=> $managerId,
          'name' => $center_manager->name,
          'nic' => $center_manager->nic,
          'dob'=> $center_manager->dob,
          'contact_no'=> $center_manager->contact_no,
          'address' => $center_manager->address,
          'click_update' =>'True',
          'update_success'=>'',
          'confirm_delete'=> '',
          'personal_details_click'=>'',
          'success'=>'' ,
          'name_err' => '',
          'nic_err' => '',
          'dob_err'=>'',
          'contact_no_err'=>'',
          'address_err' =>''
          
        ];
        
        $this->view('admin/center_managers', $data);

        
      }

     
    }

    public function cm_personal_details_view($managerId){
      $center_managers = $this->center_managerModel->get_center_managers();
      $center_manager = $this->center_managerModel->getCenterManager_ByID_view($managerId);
      $data = [
        'center_managers' => $center_managers,
        'id'=> $managerId,
        'name' => $center_manager->name,
        'email'=> $center_manager->email,
        'nic' => $center_manager->nic,
        'dob'=> $center_manager->dob,
        'contact_no'=> $center_manager->contact_no,
        'address' => $center_manager->address,
        'image'=>$center_manager->image,
        'personal_details_click'=> 'True',
        'confirm_delete' => '',
        'success' =>'',
        'click_update' =>'',
        'update_success'=>'',
        

      ];
    
    
      $this->view('admin/center_managers', $data);

  }

    public function customers(){
      
      $customers = $this->customerModel->get_all();
      $data = [
        'customers' =>$customers,
        'delete_confirm'=>''
      ];
     
      $this->view('admin/customer_main', $data);
    }

    public function customerdelete_confirm($id){
      $customers = $this->customerModel->get_all();
      $data = [
        'customers' =>$customers,
        'delete_confirm'=>'True',
        'id'=>$id
      ];
     
      $this->view('admin/customer_main', $data);
    }

    public function customerdelete($id){   
      $this->customerModel->deletecustomer($id);
      $customers = $this->customerModel->get_all();
      $data = [
        'customers' =>$customers,
        'delete_confirm'=>'',

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
            'district' =>trim($_POST['district']),
            'region' =>trim($_POST['region']),
            'center_manager'=>trim($_POST['centerManager']),
            'district_err' =>'',
            'region_err' =>'',
            'center_manager_err'=>'',
            'center_manager_data'=>'',
            'center_manager_name'=>'',
            'center_add_success'=>'',
            'lattitude'=>trim($_POST['latittude']),
            'longitude'=>trim($_POST['longitude']),
            'location_err'=>'',
            'location_success'=>''

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
        if (empty($data['lattitude']) || empty($data['longitude'])) {
          $data['location_err'] = 'Location Error';
          }
         else{ 
            $data['location_success'] = 'Success';        
        }
        if( $data['center_manager']=='default'){
          $this->view('admin/center_add', $data);
        }

        
        if(empty($data['region_err']) &&  empty($data['district_err']) && empty($data['location_err'] ) && empty($data['center_manager_err'] )){
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
          'center_add_success'=>'',
          'lattitude'=>'',
          'longitude'=>'',
          'longitude_err'=>'',
          'lattitude_err'=>'',
          'location_success'=>'',
          'location_err'=>''
        ];
         $this->view('admin/center_add', $data);
      }
      
    }

    public function center_add_confirm(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
        $data =[
            'center_managers' => $na_center_managers,
            'district' =>trim($_POST['district']),
            'region' =>trim($_POST['region']),
            'center_manager'=>trim($_POST['centerManager']),
            'district_err' =>'',
            'region_err' =>'',
            'center_manager_err'=>'',
            'center_manager_data'=>'',
            'center_manager_name'=>'',
            'center_add_success'=>'',
            'lattitude'=>trim($_POST['latittude']),
            'longitude'=>trim($_POST['longitude']),
            'location_err'=>'',
            'location_success'=>''

        ];
          $data['location_success']='Success';
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
        'collectors' =>$collectors,
        'delete_confirm'=>'',
        'vehicle_details_click'=> ''
      ];
     
      $this->view('admin/collectors', $data);
    }

    public function collectorsdelete_confirm($id){
      $collectors =$this->collector_model->get_collectors();
         $data=[
          'collectors' =>$collectors,
           'delete_confirm'=>'True',
           'id'=>$id
         ];
         $this->view('admin/collectors', $data);
    }

    public function collectordelete($id){   
      $this->collector_model->delete_collectors($id);
      $collectors =$this->collector_model->get_collectors();
      $data = [
        'collectors' =>$collectors,
        'delete_confirm'=>'',

      ];
     
      $this->view('admin/collectors', $data);
    }

    public function vehicle_details_view($collectorId){
        $collectors =$this->collector_model->get_collectors();
        $collector = $this->collector_model->getCollector_ByID_view($collectorId);
        $data = [
          'collectors' => $collectors,
          'id'=> $collectorId,
          'name' => $collector->name,
          'vehicle_no'=> $collector->vehicle_no,
          'vehicle_type'=> $collector->vehicle_type,
          'vehicle_details_click'=> 'True',
          // 'confirm_delete' => '',
          // 'delete_success' =>'',
          // 'click_update' =>'',
          // 'update_success'=>'',
          

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

    public function center_main($center_id, $region){
      $center=$this->center_model->getCenterById($center_id);
      $center_manager = $this->center_managerModel->getCenterManagerBy_centerId($center_id);
      $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
      $no_of_collectors = $this->collector_model->get_no_of_Collectors($center_id);
      $no_of_workers = $this->center_workers_model->get_no_of_center_workers($center_id);
      $total_requests = $this->requests_model->get_total_requests_by_region($region);

      $data = [
        'center' =>$center,
        'not_assigned_cm'=>$na_center_managers,
        'change_cm'=>'',
        'no_of_collectors' =>$no_of_collectors,
        'no_of_workers'=>$no_of_workers,
        'center_manager' =>$center_manager,
        'total_requests'=>$total_requests
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

    public function center_main_collectors($center_id){
      $collectors_in_center = $this->collector_model->get_collectors_bycenterid($center_id);
      $center=$this->center_model->getCenterById($center_id);
      // $collector_assistants = $this->collector_assistants_Model->get_collector_assistants_bycolid($collectorId);
      
      $data =[
        'collectors_in_center' =>$collectors_in_center,
        'center_id'=> $center_id,
        'center'=>$center
        
      ];

      $this->view('admin/center_main_collectors', $data);

    }

    public function center_main_workers($center_id){
      $workers_in_center = $this->center_workers_model->get_workers_by_centerid($center_id);
      $center=$this->center_model->getCenterById($center_id);

      $data =[
        'workers_in_center' => $workers_in_center,
        'center'=> $center
        
      ];

      $this->view('admin/center_main_workers', $data);

    }

    public function incoming_requests($region){
      $incoming_requests = $this->requests_model->get_incoming_request($region);
      $center=$this->center_model->getCenterByRegion($region);

      $data =[
        'incoming_requests'=> $incoming_requests,
        'center_region'=> $region,
        'center'=> $center
      ];

      $this->view('admin/center_main_request_incoming', $data);

    }

    public function assigned_requests($region){
      $assigned_requests = $this->requests_model->get_assigned_request_by_center($region);
      $center=$this->center_model->getCenterByRegion($region);

      $data =[
        'assigned_requests'=> $assigned_requests,
        'center_region'=> $region,
        'center'=> $center

      ];

      $this->view('admin/center_main_request_assigned', $data);

    }

    public function cancelled_requests($region){
      $cancelled_requests = $this->requests_model->get_cancelled_request_bycenter($region);
      $center=$this->center_model->getCenterByRegion($region);

      $data =[
        'cancelled_requests'=> $cancelled_requests,
        'center_region'=> $region,
        'center'=> $center
      ];

      $this->view('admin/center_main_request_cancelled', $data);

    }

  
  }