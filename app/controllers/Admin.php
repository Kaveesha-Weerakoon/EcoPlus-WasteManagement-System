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
      $this->collector_assistants_Model=$this->model('collector_Assistant');
      $this->center_workers_model=$this->model('Center_Worker');
      $this->requests_model=$this->model('Request');
      $this->center_complaints_model=$this->model('Center_Complaints');
      $this->discount_agentModel=$this->model('Discount_Agent');
      $this->collect_garbage_Model=$this->model('Collect_Garbage');
      $this->garbage_types_model = $this->model('Garbage_types');
      $this->Collect_Garbage_Model=$this->model('Collect_Garbage');
      $this->Report_Model=$this->model('Report');
      $this->fine_model = $this->model('Fines');
      

      if(!isLoggedIn('admin_id')  && !isLoggedIn('superadmin_id')){
        redirect('users/login');
     
      }
    }

    public function logout(){
      unset($_SESSION['admin_id']);
      unset($_SESSION['superadmin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
       session_destroy();
      redirect('users/login');
 }

    public function index(){
      $creditMonth=$this->Collect_Garbage_Model->getTotalCreditsGivenInMonth();
      $credit= $this->creditModel->get();
      $center_managers = $this->center_managerModel->get_center_managers();
      $customers = $this->customerModel->get_all();
      $collectors =$this->collector_model->get_collectors();
      $centers = $this->center_model->getallCenters();
      $jsonData = json_encode($centers );

      $fine_details = $this->fine_model->get_fine_details();
      $completedRequests=$this->Collect_Garbage_Model->getAllCompletedRequests();
      $totalRrequests=$this->requests_model->getTotalRequests();
     
      $data = [
        'completedRequests'=> $completedRequests,
        'totalRequests'=> $totalRrequests,
        'fines'=>$fine_details,
        'cm_count'=>count($center_managers),      
        'customer_count'=>count($customers),
        'collector_count'=>count( $collectors),
        'centers'=>$jsonData,
        'creditsGiven'=>$creditMonth->credit_amount 
      ];

      foreach($fine_details as $fine ){
        if($fine){
          $fine_type = strtolower($fine->type);
          $data["{$fine_type}"] = $fine->fine_amount;
          $data["{$fine_type}_err"] ='';
        }
      }

      $this->view('admin/index', $data);
    }

    public function complain_customers(){
    
      $complains = $this->customer_complain_Model->get_customer_complains_with_image();
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

    public function get_customer_fined_requests($customer_id){
      
      $fined_requests= $this->customerModel->get_fined_requests($customer_id);
      $customers = $this->customerModel->get_all();
      $completed_requests=$this->Collect_Garbage_Model->get_complete_request_relevent_customer($customer_id);

      $data = [
        'customers' =>$customers,
        'fined_requests'=>$fined_requests,
        'delete_confirm'=>'',
        'completed_requests'=>$completed_requests,
        'fine'=>'True'
      ];
     
      $this->view('admin/customer_main', $data);

    }

    public function blockuser($id){
      $this->customerModel->block($id);
      header("Location: " . URLROOT . "/admin/customers");        
    }
    
    public function unblockuser($id){

      $this->customerModel->unblock($id);
      header("Location: " . URLROOT . "/admin/customers");        
    }

    public function customers(){
      
      $customers = $this->customerModel->get_all();
      $data = [
        'customers' =>$customers,
        'delete_confirm'=>'',
        'fine'=>''

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
            'radius'=>trim($_POST['radius']),
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
          'location_err'=>'',
          'radius'=>''
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
            'radius'=>trim($_POST['radius']),
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
    // header("Location: " . URLROOT . "/customers/.$url.");        

    public function center_main($center_id, $region){
      $center=$this->center_model->getCenterById($center_id);
      $center_manager = $this->center_managerModel->getCenterManagerBy_centerId($center_id);
      $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
      $no_of_collectors = $this->collector_model->get_no_of_Collectors($center_id);
      $no_of_workers = $this->center_workers_model->get_no_of_center_workers($center_id);
      $total_requests = $this->requests_model->get_total_requests_by_region($region);
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){  
        $data = [
          'center' =>$center,
          'not_assigned_cm'=>$na_center_managers,
          'change_cm'=>'',
          'no_of_collectors' =>$no_of_collectors,
          'no_of_workers'=>$no_of_workers,
          'center_manager' =>$center_manager,
          'total_requests'=>$total_requests,
          'lattitude'=>trim($_POST['latittude']),
          'longitude'=>trim($_POST['longitude']),
          'radius'=>trim($_POST['radius']),
          'center_id'=>$center_id,
          'region'=> $region
      ];
      if($this->center_model->changeCenterLocation($data,$center_id)){
        header("Location: " . URLROOT . "/admin/center_main/".$center_id."/".$region);        
      } else {
        die('Something went wrong');
      }
      $this->view('admin/center_main', $data);        
      }
      else{
        
      $data = [
        'center' =>$center,
        'not_assigned_cm'=>$na_center_managers,
        'change_cm'=>'',
        'no_of_collectors' =>$no_of_collectors,
        'no_of_workers'=>$no_of_workers,
        'center_manager' =>$center_manager,
        'total_requests'=>$total_requests,
        'lattitude'=>'',
        'longitude'=>'',
        'radius'=>'',
        'center_id'=>$center_id,
          'region'=> $region
      ];
      
      $this->view('admin/center_main', $data);        
    }
    }

    public function center_main_change_cm($center_id){       
       $center=$this->center_model->getCenterById($center_id);
       $no_of_collectors = $this->collector_model->get_no_of_Collectors($center_id);
       $total_requests = $this->requests_model->get_total_requests_by_region($center->region);
       $no_of_workers = $this->center_workers_model->get_no_of_center_workers($center_id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
  
        $data = [
          'center' =>$center,
          'not_assigned_cm'=>$na_center_managers,
          'change_cm'=>'True',
          'center_manager'=>trim($_POST['centerManager']),
        ];
        if($data['center_manager']=='default'){  
          header("Location: " . URLROOT . "/admin/center_main/".$center_id."/".$center->region);        
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
            'no_of_collectors' =>$no_of_collectors,
            'no_of_workers'=>$no_of_workers,
            'total_requests'=>$total_requests
          ];
          $this->center_main($center_id, $center->region);
        }
        
      }else{
        $center=$this->center_model->getCenterById($center_id);
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
        $center=$this->center_model->getCenterById($center_id);
        $center_manager = $this->center_managerModel->getCenterManagerBy_centerId($center_id);
        $na_center_managers = $this->center_managerModel->get_Non_Assigned_CenterManger();
     
        $data = [
          'center' =>$center,
          'not_assigned_cm'=>$na_center_managers,
          'change_cm'=>'True',
          'no_of_collectors' =>$no_of_collectors,
          'no_of_workers'=>$no_of_workers,
          'center_manager' =>$center_manager,
          'total_requests'=>$total_requests
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

    public function completed_requests($region){
      $completed_requests = $this->collect_garbage_Model->get_completed_requests_bycenter($region);
      $center=$this->center_model->getCenterByRegion($region);

      $data =[
        'center_region'=> $region,
        'center'=> $center,
        'completed_requests'=> $completed_requests
      ];

      $this->view('admin/center_main_request_completed', $data);

    }

    public function complaint_centers(){

      $center_complaints= $this->center_complaints_model->get_center_complaints();

      $data = [
        'complaints' => $center_complaints
      ];
      $this->view('admin/complain_centers', $data);
    }

    public function discount_agents(){

      $discount_agent = $this->discount_agentModel->get_discount_agent();
      $data = [
        'discount_agents' => $discount_agent,
        'confirm_delete' =>'',
        'assigned'=>'',
        'success'=>'',
        'click_update' =>'',
        'update_success'=>'',
        'confirm_delete'=> '',
        'personal_details_click'=>''
      ];
     
      $this->view('admin/discount_agents', $data);
    }
  
    public function discount_agent_add(){
       
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
          'name' => trim($_POST['name']),
          'profile' => $_FILES['profile_image'],
          'contact_no' => trim($_POST['contact_no']),
          'profile_image_name' => trim($_POST['email']).'_'.$_FILES['profile_image']['name'],
          'address' => trim($_POST['address']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'contact_no_err' => '',
          'address_err' => '' ,
          'email_err' => '' ,
          'password_err' => '' ,
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
  
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['address_err'])){
          if ($_FILES['profile_image']['error'] == 4) {
            $data['profile_err'] = 'Upload a image';
        } else {
            if (uploadImage($_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/credit_discount_agent/')) {
              $data['profile_err'] = '';
  
            } else {
                $data['profile_err'] = 'Error uploading the profile image';
            }
        }
        }
  
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['address_err']) && empty($data['profile_err'])){
          // Validated
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          if($this->discount_agentModel->register_discount_agent($data)){
            $data['registered']='True';        
            $this->view('admin/discount_agent_add',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
         
          $this->view('admin/discount_agent_add', $data);
        }
  
  
      }
      else{
        
        $data = [
          'name' =>'',
          'profile'=>'',
          'contact_no' => '',
          'address' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'contact_no_err' => '',
          'address_err' => '' ,
          'email_err' => '' ,
          'profile_err'=>'',
          'password_err' => '' ,
          'confirm_password_err'=>'',
          'registered'=>'' ,         
          'profile_upload_error'=>''   
  
        ];
        $this->view('admin/discount_agent_add', $data);
      }
    
    }
  
    public function discount_agent_delete_confirm($id){
      $discount_agent = $this->discount_agentModel->get_discount_agent();
      $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($id);
      if($agent_by_id){
        $data = [
          'discount_agents' => $discount_agent,
          'confirm_delete' =>'True',
          'discount_agent_id'=>$id,
          'personal_details_click'=>'',
          'success'=>'' 
        ];
      }
      else{
        $data = [
          'discount_agents' => $discount_agent,
          'confirm_delete' =>'True',
          'discount_agent_id'=>$id,
          'success'=>''
        ];
      }
    
     
      $this->view('admin/discount_agents', $data);
    }

    public function discount_agent_delete($id) {
      $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($id);
      $this->discount_agentModel->discount_agent_delete($id);
      $discount_agent = $this->discount_agentModel->get_discount_agent();
      deleteImage("C:\\xampp\\htdocs\\ecoplus\\public\\img\\img_upload\\credit_discount_agent\\" . $agent_by_id->image);
      $data = [
        'discount_agents' => $discount_agent,
        'confirm_delete' =>'',
        'success'=>'True',
        'personal_details_click'=>''
      ];
    
      $this->view('admin/discount_agents', $data);
    }

    public function get_collector_assistants($collector_id){
      $collector_assistants = $this->collector_assistants_Model->get_collector_assistants_bycolid($collector_id);

      $data=[
        'collector_assistants'=> $collector_assistants
      ];

      $this->view('admin/center_main_collectors', $data);
    }

    public function garbage_types($success="False"){

      $garbage_types = $this->garbage_types_model->get_all();

      $data=[
        'garbage_types'=> $garbage_types,
        'click_update'=>'',
        'update_success'=>$success
        
      ];

      $this->view('admin/garbage_types_view', $data);

    }

    public function garbage_types_update($id){
      $garbage_types = $this->garbage_types_model->get_all();

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
          'id'=> $id,
          'garbage_types'=> $garbage_types,
          'garbage_type'=> trim($_POST['garbage_type']),
          'credit_per_waste_quantity' => trim($_POST['credit_per_waste_quantity']),
          'approximate_amount'=> trim($_POST['approximate_amount']),
          'minimum_amount'=> trim($_POST['minimum_amount']),
          'selling_price'=> trim($_POST['selling_price']),
          'click_update'=> 'True',
          'update_success'=>'',
          'garbage_type_err'=>'',
          'credit_per_waste_quantity_err'=>'',
          'approximate_amount_err'=>'',
          'minimum_amount_err'=>'',
          'selling_price_err'=>''

        ];

        //validate garbage type
        if(empty($data['garbage_type'])){
          $data['garbage_type_err'] = 'Please enter garbage type';
        }elseif(strlen($data['garbage_type']) > 50) {
          $data['garbage_type_err'] = 'Garbage type is too long';
        }

        //validate credit per waste quantity
        if(empty($data['credit_per_waste_quantity'])){
          $data['credit_per_waste_quantity_err'] = 'Please enter credits per waste quantity';
        }elseif(!(is_numeric($data['credit_per_waste_quantity']))){
          $data['credit_per_waste_quantity_err'] = 'Please enter a numeric value';
        } elseif (!filter_var($data['credit_per_waste_quantity'], FILTER_VALIDATE_INT) || $data['credit_per_waste_quantity'] <= 0 ) {
          $data['credit_per_waste_quantity_err'] = 'Credit value should be a positive whole number';
        }

        //validate approximate amount
        if(empty($data['approximate_amount'])){
          $data['approximate_amount_err'] = 'Please enter approximate amount';
        }elseif(!(is_numeric($data['approximate_amount']))){
          $data['approximate_amount_err'] = 'Please enter a numeric value';
        }elseif (!preg_match('/^\d+(\.\d{1})?$/', $data['approximate_amount']) || $data['approximate_amount'] <= 0) {
          $data['approximate_amount_err'] = 'Please enter a positive value up to 1 decimal place';
        }elseif($data['approximate_amount'] <= $data['minimum_amount']){
          $data['approximate_amount_err'] = 'Approximate amount must exceed the minimum amount';
        }

        //validate minimum amount
        if(empty($data['minimum_amount'])){
          $data['minimum_amount_err'] = 'Please enter minimum amount';
        }elseif(!(is_numeric($data['minimum_amount']))){
          $data['minimum_amount_err'] = 'Please enter a numeric value';
        }elseif (!preg_match('/^\d+(\.\d{1})?$/', $data['minimum_amount']) || $data['minimum_amount'] <= 0) {
          $data['minimum_amount_err'] = 'Please enter a positive value up to 1 decimal place';
        }elseif($data['minimum_amount'] >= $data['approximate_amount']){
          $data['minimum_amount_err'] = 'Minimum amount should not exceed the approximate value';
        }

        //validate sell price
        if(empty($data['selling_price'])){
          $data['selling_price_err'] = 'Please enter selling price';
        }elseif(!(is_numeric($data['selling_price']))){
          $data['selling_price_err'] = 'Please enter a numeric value';
        }elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $data['selling_price']) || $data['selling_price'] <= 0) {
          $data['selling_price_err'] = 'Please enter a positive value up to 2 decimal places';
        }

        if(empty($data['garbage_type_err']) && empty($data['credit_per_waste_quantity_err']) && empty($data['approximate_amount_err']) && 
        empty($data['minimum_amount_err']) && empty($data['selling_price_err'])){
          if($this->garbage_types_model->update_garbage_types($data)){
         
            header("Location: " . URLROOT . "/admin/garbage_types/True");        

          } else {
            die('Something went wrong');
          }

        }else{
          $this->view('admin/garbage_types_view', $data);

        }

      }else{
        
        $garbage_types = $this->garbage_types_model->get_all();
        $garbage_type = $this->garbage_types_model->get_details_by_id($id);

        $data =[
          'id'=> $id,
          'garbage_types'=> $garbage_types,
          'garbage_type'=> $garbage_type->name,
          'credit_per_waste_quantity' => $garbage_type->credits_per_waste_quantity,
          'approximate_amount'=> $garbage_type->approximate_amount,
          'minimum_amount'=> $garbage_type->minimum_amount,
          'selling_price'=> $garbage_type->selling_price,
          'click_update'=> 'True',
          'update_success'=>'',
          'garbage_type_err'=>'',
          'credit_per_waste_quantity_err'=>'',
          'approximate_amount_err'=>'',
          'minimum_amount_err'=>'',
          'selling_price_err'=>''

        ];

        $this->view('admin/garbage_types_view', $data);
      }
    }

    public function set_fine(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $fine_details = $this->fine_model->get_fine_details();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
          'minimum_collect'=> trim($_POST['minimum_collect']),
          'no_response' => trim($_POST['no_response']),
          'cancelling_assigned' => trim($_POST['cancelling_assigned']),
          'minimum_collect_err' => '',
          'no_response_err' => '',
          'cancelling_assigned_err' => ''
        ];
       
        foreach($fine_details as $fine ){
          
          if($fine){
            $fine_type = strtolower($fine->type);

            if(empty($data["{$fine_type}"])){
              $data["{$fine_type}_err"] = 'Please enter selling price';
            }elseif(!(is_numeric($data["{$fine_type}"]))){
              $data["{$fine_type}_err"] = 'Please enter a numeric value';
            }elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $data["{$fine_type}"]) || $data["{$fine_type}"] < 0) {
              $data["{$fine_type}_err"] = 'Please enter a positive value up to 2 decimal places';
            }
          }
        }

        if(empty($data['minimum_collect_err']) && empty($data['no_response_err']) && empty($data['cancelling_assigned_err']) ){  
          if($this->fine_model->set_fine($data)){
            header("Location: " . URLROOT . "/admin/index");  
          }
          else{ 
            header("Location: " . URLROOT . "/admin/index");  
          }

        }else{
          header("Location: " . URLROOT . "/admin/index");  

        }
        $this->view('admin/index', $data); 
      }
      else{

       
        $fine_details = $this->fine_model->get_fine_details();

        foreach($fine_details as $fine ){
          if($fine){
            $fine_type = strtolower($fine->type);
            $data["{$fine_type}"] = $fine->fine_amount;
            $data["{$fine_type}_err"] ='';
          }
        }

        $this->view('admin/index', $data);

      }

    }

    public function addadmins(){

      if(isset($_SESSION['superadmin_id']) ){

        $admins=$this->adminModel->get_all();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        $data=[
          'admin'=>$admins
        ];    
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->view('admin/admins', $data);
      }       
      else{   
        $data=[
          'admin'=>$admins
        ];
         $this->view('admin/admins', $data);
        } 
     }else{
      header("Location: " . URLROOT . "/admin");        

     }
    }  
    
    public function addadmins2(){
      if(isset($_SESSION['superadmin_id']) ){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data=[ 'name' => trim($_POST['name']),
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
         'profile_upload_error'=>''   ];    

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

        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }
        elseif (strlen($data['name']) > 255) {
          $data['name_err'] = 'name is too long ';
        }

        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }elseif(!(is_numeric($data['nic']) && (strlen($data['nic']) == 12)) && !preg_match('/^[0-9]{9}[vV]$/', $data['nic'])){
          $data['nic_err'] = 'Please enter a valid NIC';
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
            if (uploadImage($_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/Admin/')) {
              $data['profile_err'] = '';
  
            } else {
                $data['profile_err'] = 'Error uploading the profile image';
            }
        }
        }

        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['dob_err']) && empty($data['profile_err'])){
          // Validated
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          if($this->adminModel->register_admin($data)){
            $data['registered']='True';        
            $this->view('admin/admins_add', $data);
          } else {
            header("Location: " . URLROOT . "/admin");        
          }
        }
        else{
         
          $this->view('admin/admins_add', $data);
        }

        $this->view('admin/admins_add', $data);
        }       
       else{
        $data=[  'name' =>'',
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
        'profile_upload_error'=>''   ]; 
        $this->view('admin/admins_add', $data);
      } 
     }else{
      header("Location: " . URLROOT . "/admin");        
  
     }
    }
    
    public function reports(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){     
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $center=trim($_POST['center-dropdown']);
        if($center!="none"){
          $center2=$this->center_model->findCenterbyRegion($center);
           $center_id=$center2->id;
        }
        else{
          $center_id="none";

        }
        $fromDate= trim($_POST['fromDate']);
        $toDate= trim($_POST['toDate']);
        
        if($toDate==""){
          $toDate="none";
        } 

        if($fromDate==""){
          $fromDate="none";
        }
       
        $completedRequests=$this->Report_Model->getCompletedRequests($fromDate,$toDate,$center);
        $cancelledRequests=$this->Report_Model->getCancelledRequests($fromDate,$toDate,$center);
        $ongoingRequests=$this->Report_Model->getonGoingRequests($fromDate,$toDate,$center);
        $totalRequests=$this->Report_Model->getallRequests($fromDate,$toDate,$center);
        $credits=$this->Report_Model->getCredits($fromDate,$toDate,$center);
        $centers = $this->center_model->getallCenters();
        $creditByMonth=$this->Report_Model->getCreditsMonths($center);
        $collectedWasteByMonth=$this->Report_Model->getCollectedGarbage($fromDate,$toDate,$center);
        $handoveredWasteByMonth=$this->Report_Model->getHandOveredGarbage($fromDate,$toDate,$center);
        $selledWasteByMonth=$this->Report_Model->getSelledGarbage($fromDate,$toDate,$center_id);

        $data=[
          'completedRequests'=> count($completedRequests),
          'cancelledRequests'=> count($cancelledRequests),
          'ongoingRequests'=> count($ongoingRequests),
          'totalRequests'=> count($totalRequests),
          'centers'=> $centers,
          'center'=>$center,
          'to'=>$toDate,
          'from'=>$fromDate,
          'credits'=> $credits->total_credits,
          'creditsByMonth1'=>  $creditByMonth,
          'collectedWasteByMonth'=>$collectedWasteByMonth,
          'handoveredWasteByMonth'=>$handoveredWasteByMonth,
          'selledWasteByMonth'=>$selledWasteByMonth

        ];
        $this->view('admin/report', $data);

      }
      else{
        $completedRequests=$this->Report_Model->getCompletedRequests();
        $cancelledRequests=$this->Report_Model->getCancelledRequests();
        $ongoingRequests=$this->Report_Model->getonGoingRequests();
        $totalRequests=$this->Report_Model->getallRequests();
        $centers = $this->center_model->getallCenters();
        $credits=$this->Report_Model->getCredits();
        $creditByMonth=$this->Report_Model->getCreditsMonths();
        $collectedWasteByMonth=$this->Report_Model->getCreditsMonths();
        $collectedWasteByMonth=$this->Report_Model->getCollectedGarbage();
        $handoveredWasteByMonth=$this->Report_Model->getHandOveredGarbage();
        $selledWasteByMonth=$this->Report_Model->getSelledGarbage();
        $data=[
          'completedRequests'=> count($completedRequests),
          'cancelledRequests'=> count($cancelledRequests),
          'ongoingRequests'=> count($ongoingRequests),
          'totalRequests'=> count($totalRequests),
          'centers'=> $centers,
          'center'=>'All',
          'to'=>'none',
          'from'=>'none',    
          'credits'=> $credits->total_credits,
          'creditsByMonth1'=>  $creditByMonth,
          'collectedWasteByMonth'=>$collectedWasteByMonth,
          'handoveredWasteByMonth'=>$handoveredWasteByMonth,
          'selledWasteByMonth'=>$selledWasteByMonth

        ];
        
        $this->view('admin/report', $data);

      }
    }

    public function admin_delete_confirm($id){
      $admin = $this->adminModel->get_all();
      $admin_by_id = $this->adminModel->getAdminByID($id);
      if($admin_by_id){
        $data = [
          'admin' => $admin,
          'confirm_delete' =>'True',
          'admin_id'=>$id,
          'personal_details_click'=>'',
          'success'=>'' 
        ];
      }
      else{
        $data = [
          'admin' => $admin,
          'admin_id'=>$id,
          'confirm_delete' =>'True',
          'discount_agent_id'=>$id,
          'success'=>''
        ];
      }
    
     
      $this->view('admin/admins', $data);
    }

    public function admin_delete($id) {
      $admin_by_id = $this->adminModel->getAdminByID($id);
      $this->adminModel->admin_delete($id);
      $admin = $this->adminModel->get_all();
      deleteImage("C:\\xampp\\htdocs\\ecoplus\\public\\img\\img_upload\\Admin\\" . $admin_by_id->image);
      $data = [
        'admin' => $admin,
        'confirm_delete' =>'',
        'success'=>'True',
        'admin_id'=>$id,
        'personal_details_click'=>''
      ];
    
      $this->view('admin/admins', $data);
    }

    public function edit_profile(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){     
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data=[];
        $this->view('admin/editprofile', $data);

      }
      else{
        $data=[];
        $this->view('admin/editprofile', $data);

      }
    }


  
  }