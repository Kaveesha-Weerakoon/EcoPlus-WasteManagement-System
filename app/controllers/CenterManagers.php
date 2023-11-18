<?php
  class CenterManagers extends Controller {

    public function __construct(){
      $this->userModel=$this->model('User');
      $this->collectorModel=$this->model('Collector');
      $this->center_model=$this->model('Center');
      $this->collector_complain_Model=$this->model('Collector_Complain');

      $this->centerworkerModel=$this->model('Center_Worker');
      if(!isLoggedIn('center_manager_id')){
        redirect('users/login');
      }
    }
    
    public function index(){

      $center=$this->center_model->getCenterById($_SESSION['center_id']);

      $data = [
        'center_id' => $center->id,
        'center_name' => $center->region
      ];
     
      $this->view('center_managers/index', $data);
    }
    
    public function logout(){
      unset($_SESSION['center_manager_id']);
      unset($_SESSION['center_manager_email']);
      unset($_SESSION['center_manager_name']);
      unset($_SESSION['center_id']);
      unset($_SESSION['cm_profile']);
      session_destroy();
      redirect('users/login');
    }

    public function collectors(){
      $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
      $data = [
        'collectors' => $collectors,
        'click_update' =>'',
        'update_success'=>'',
        'confirm_delete' =>'',
        'delete_success' =>'',
        'personal_details_click'=> '',
        'vehicle_details_click'=> ''
   
      ];
     
     
      $this->view('center_managers/collectors', $data);
    }

    public function collectors_complains(){
      $collector_complains=$this->collector_complain_Model->get_complains_byCenterID($_SESSION['center_id']);
      $data = [
        'collectors_complains' => $collector_complains,
      ];
     
     
      $this->view('center_managers/collectors_complains', $data);
    }

    public function collectors_add(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'name' =>trim($_POST['name']),
          'nic' => trim($_POST['nic']),
          'dob'=>trim($_POST['dob']),
          'contact_no'=>trim($_POST['contact_no']),
          'profile_name'=>trim($_POST['email']).'_'.$_FILES['profile_image']['name'],
          'address' =>trim($_POST['address']),
          'email'=>trim($_POST['email']),
          'vehicle_no'=>trim($_POST['vehicle_no']),
          'vehicle_type'=>trim($_POST['vehicle_type']),
          'registered'=>'',
          'password'=>trim($_POST['password']),
          'confirm_password'=>trim($_POST['confirm_password']),
          'center_name'=>'',

          'name_err' =>'',
          'nic_err' =>'',
          'dob_err' =>'',
          'contactNo_err' =>'',
          'address_err' =>'',
          'email_err'=>'', 
          'vehicleNo_err' =>'',
          'vehicleType_err' =>'',
          'password_err'=>'',
          'confirm_password_err'=>'',
          'profile_err'=>''
                
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
        }elseif($this->collectorModel->getCollectorByNIC($data['nic'])){
          $data['nic_err'] = 'NIC already exists';
        }

        //validate DOB
        if(empty($data['dob'])){
          $data['dob_err'] = 'Please enter dob';
        }

        //validate contact number
        if(empty($data['contact_no'])){
          $data['contactNo_err'] = 'Please enter contact no';
        }elseif (!preg_match('/^[0-9]{10}$/', $data['contact_no'])) {
          $data['contactNo_err'] = 'Please enter a valid contact number';
        }

        //validate address
        if(empty($data['address'])){
          $data['address_err'] = 'Please enter address';
        }elseif (strlen($data['address']) > 500) {
          $data['address_err'] = 'Address is too long ';
        }

        //validate vehicle number
        if(empty($data['vehicle_no'])){
          $data['vehicleNo_err'] = 'Please enter vehicle plate number';
        }elseif(!preg_match('/^[A-Z]{2,3}-[0-9]{4}$/', $data['vehicle_no'])){
          $data['vehicleNo_err'] = 'Please enter a valid vehicle plate number';
        }elseif($this->collectorModel->getCollectorByVehicleNo($data['vehicle_no'])){
          $data['vehicleNo_err'] = 'Vehicle have already registered';
        }

        //validate vehicle type
        if(empty($data['vehicle_type'])){
          $data['vehicleType_err'] = 'Please enter vehicle type';
        }elseif(strlen($data['address']) > 50){
          $data['vehicleType_err'] = 'Vehicle type is too long';
        }

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter an email';
        } else {
            // Check email format
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = 'Invalid email format';
            } else {
                // Check email length
                if(strlen($data['email']) > 255) { // You can adjust the maximum length as needed
                    $data['email_err'] = 'Email is too long';
                } else {
                    // Check email availability
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }
            }
        }

        //validate password
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

        if(empty($data['name_err']) && empty($data['nic_err']) && empty($data['dob_err']) && empty($data['contactNo_err'])&& empty($data['address_err']) && empty($data['email_err']) && empty($data['vehicleNo_err']) && empty($data['vehicleType_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          if ($_FILES['profile_image']['error'] == 4) {
            $data['profile_err'] = 'Upload a image';
        } else {
            if (uploadImage($_FILES['profile_image']['tmp_name'], $data['profile_name'], '/img/img_upload/collector/')) {
              $data['profile_err'] = '';
  
            } else {
              
                $data['profile_err'] = 'Error uploading the profile image';
            }
        }
        }


        if(empty($data['name_err']) && empty($data['nic_err']) && empty($data['dob_err']) && empty($data['contactNo_err'])&& empty($data['address_err']) && empty($data['email_err']) && empty($data['vehicleNo_err']) && empty($data['vehicleType_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['profile_err'])){
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $center=$this->center_model->getCenterById($_SESSION['center_id']);
            $data['center_name']=$center->region;
            if($this->collectorModel->register_collector($data)){
              $data['registered']='True';  
            
              $this->view('center_managers/collectors_add',$data);
            } else {
              die('Something went wrong');
            }
        }
        else{
          $this->view('center_managers/collectors_add', $data);

        }

      }
      else{
        $data = [
          'name' =>'',
          'nic' => '',
          'dob'=>'',
          'contact_no'=>'',
          'address' =>'',
          'email'=>'',
          'vehicle_no'=>'',
          'vehicle_type'=>'',
          'registered'=>'',
          'password'=>'',
          'confirm_password'=>'',

          'name_err' =>'',
          'nic_err' =>'',
          'dob_err' =>'',
          'contactNo_err' =>'',
          'address_err' =>'',
          'email_err'=>'', 
          'vehicleNo_err' =>'',
          'vehicleType_err' =>'',
          'password_err'=>'',
          'confirm_password_err'=>'',
          'profile_err'=>''
        ];
          
        $this->view('center_managers/collectors_add', $data);
      }
     
     
    }

    public function collectors_update($collectorId){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
            $data = [
                'collectors' => $collectors,
                'id'=> $collectorId,
                'name' =>trim($_POST['name']),
                'nic' => trim($_POST['nic']),
                'dob'=>trim($_POST['dob']),
                'contact_no'=>trim($_POST['contact_no']),
                'address' =>trim($_POST['address']),
                'vehicle_no'=>trim($_POST['vehicle_no']),
                'vehicle_type'=>trim($_POST['vehicle_type']),
                'click_update' =>'True',
                'update_success'=>'',
                'confirm_delete'=> '',
                'delete_success'=> '',
                'personal_details_click'=> '',
                'vehicle_details_click'=> '',
                
                'name_err' => '',
                'nic_err' => '',
                'dob_err'=>'',
                'contact_no_err'=>'',
                'address_err' =>'',
                'vehicle_no_err'=> '',
                'vehicle_type_err'=> ''
                
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
        }elseif($this->collectorModel->getCollectorByNIC_except($data['nic'] , $collectorId)){
          $data['nic_err'] = 'Already exists a collector under this NIC';
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

        //Validate Vehicle plate No
        if(empty($data['vehicle_no'])){
          $data['vehicle_no_err'] = 'Please enter vehicle plate number';
        }elseif(!preg_match('/^[A-Z]{2,3}-[0-9]{4}$/', $data['vehicle_no'])){
          $data['vehicle_no_err'] = 'Please enter a valid vehicle plate number';
        }elseif($this->collectorModel->getVehicleNo_except($data['vehicle_no'] , $collectorId)){
          $data['vehicle_no_err'] = 'Already exists a vehicle under this vehicle No';
        }

        //validate vehicle type
        if(empty($data['vehicle_type'])){
          $data['vehicle_type_err'] = 'Please enter vehicle type';
        }elseif(strlen($data['address']) > 50){
          $data['vehicle_type_err'] = 'Vehicle type is too long';
        }


        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) && empty($data['vehicle_no_err']) && empty($data['vehicle_type_err'])){
          if($this->collectorModel->update_collectors($data)){
            $data['update_success']='True';       
            $this->view('center_managers/collectors',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('center_managers/collectors', $data);
        }

        //$this->view('center_managers/collectors', $data);
      
      }
      else{

        $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
        $collector = $this->collectorModel->getCollector_ByID_view($collectorId);
        $data = [

          'collectors' => $collectors,
          'id'=> $collectorId,
          'name' => $collector->name,
          'nic' => $collector->nic,
          'dob'=> $collector->dob,
          'contact_no'=> $collector->contact_no,
          'address' => $collector->address,
          'vehicle_no'=> $collector->vehicle_no,
          'vehicle_type'=> $collector->vehicle_type,
          'click_update' =>'True',
          'update_success'=>'',
          'confirm_delete'=> '',
          'delete_success'=> '',
          'personal_details_click'=> '',
          'vehicle_details_click'=> '',

          'name_err' => '',
          'nic_err' => '',
          'dob_err'=>'',
          'contact_no_err'=>'',
          'address_err' =>'',
          'vehicle_no_err'=>'',
          'vehicle_type_err'=>''
          
        ];
        
        $this->view('center_managers/collectors', $data);

        
      }

     

    }


    public function collector_delete_confirm($collectorId){
        $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
        $data = [
          'collectors' => $collectors,
          'confirm_delete' => 'True',
          'delete_success' =>'',
          'click_update' =>'',
          'update_success'=>'',
          'personal_details_click'=> '',
          'vehicle_details_click'=> '',
          'collector_id' => $collectorId

        ];
      
      
        $this->view('center_managers/collectors', $data);
        
    }

    public function collector_delete($collectorId){

      $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
      $data = [
        'collectors' => $collectors,
        'click_update' =>'',
        'update_success'=>'',
        'confirm_delete'=> '',
        'personal_details_click'=> '',
        'vehicle_details_click'=> ''

      ];

      $collector = $this->collectorModel->getCollectorById($collectorId);
      if(empty($collector)){
        die('Collector not found');
      }
      else{
        if($this->collectorModel->delete_collectors($collectorId)){
          deleteImage("C:\\xampp\\htdocs\\ecoplus\\public\\img\\img_upload\\collector\\".$collector->image);
          $data['delete_success'] = 'True';
          $this->view('center_managers/collectors', $data);
        }
        else{
          die('Something went wrong');
        }

      }

    }

    public function personal_details_view($collectorId){
        $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
        $collector = $this->collectorModel->getCollector_ByID_view($collectorId);
        $data = [
          'collectors' => $collectors,
          'id'=> $collectorId,
          'name' => $collector->name,
          'email'=> $collector->email,
          'nic' => $collector->nic,
          'dob'=> $collector->dob,
          'contact_no'=> $collector->contact_no,
          'address' => $collector->address,
          'personal_details_click'=> 'True',
          'vehicle_details_click'=> '',
          'confirm_delete' => '',
          'delete_success' =>'',
          'click_update' =>'',
          'update_success'=>'',
          

        ];
      
      
        $this->view('center_managers/collectors', $data);

    }

    public function vehicle_details_view($collectorId){
      $collectors = $this->collectorModel->get_collectors_bycenterid($_SESSION['center_id']);
        $collector = $this->collectorModel->getCollector_ByID_view($collectorId);
        $data = [
          'collectors' => $collectors,
          'id'=> $collectorId,
          'name' => $collector->name,
          'vehicle_no'=> $collector->vehicle_no,
          'vehicle_type'=> $collector->vehicle_type,
          'vehicle_details_click'=> 'True',
          'personal_details_click'=> '',
          'confirm_delete' => '',
          'delete_success' =>'',
          'click_update' =>'',
          'update_success'=>'',
          

        ];
      
      
        $this->view('center_managers/collectors', $data);
  
    }

    public function center_workers(){


      $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
      $data = [
        'center_workers' => $center_workers,
        'center_worker_id'=>'',
        'click_update' =>'',
        'update_success'=>'',
        'confirm_delete' => '',
        'delete_success' =>''

      ];
     
     
      $this->view('center_managers/center_workers', $data);
    }

    public function center_workers_add(){
     
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
               'name' =>trim($_POST['name']),
               'nic' => trim($_POST['nic']),
               'dob'=>trim($_POST['dob']),
               'contact_no'=>trim($_POST['contact_no']),
               'address' =>trim($_POST['address']),
               'registered'=>'',
               
               'name_err' => '',
               'nic_err' => '',
               'dob_err'=>'',
               'contact_no_err'=>'',
               'address_err' =>''
               
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
        }elseif($this->centerworkerModel->getCenterWorkerByNIC($data['nic'])){
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
          $data['address_err'] = 'Please enter address';
        }elseif (strlen($data['address']) > 500) {
          $data['address_err'] = 'Address is too long ';
        }

        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) ){
          if($this->centerworkerModel->add_center_workers($data)){
            $data['registered']='True';       
            $this->view('center_managers/center_workers_add',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('center_managers/center_workers_add', $data);
        }
      
      }
      else{
        $data = [
          'name' => '',
          'nic' => '',
          'dob'=>'',
          'contact_no'=>'',
          'address' =>'',
          'registered'=>'',
          'name_err' => '',
          'nic_err' => '',
          'dob_err'=>'',
          'contact_no_err'=>'',
          'address_err' =>'',
          
        ];
        
        $this->view('center_managers/center_workers_add', $data);
      }

      
    }

    // public function center_workers_update_click($workerId){
    //   $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
    //   $center_wroker = $this->centerworkerModel->getCenterWorkerById($workerId);

    //   $data = [
    //     'center_workers' => $center_workers,
    //     'click_update' =>'True',
    //     'center_worker_id'=>$workerId,

    //     'name' => $center_wroker->name,
    //     'nic' => $center_wroker->nic,
    //     'dob'=> $center_wroker->dob,
    //     'contact_no'=> $center_wroker->contact_no,
    //     'address' => $center_wroker->address,
    //     'registered'=>'',

    //     'name_err' => '',
    //     'nic_err' => '',
    //     'dob_err'=>'',
    //     'contact_no_err'=>'',
    //     'address_err' =>''

    //   ];
      
      
    //   $this->view('center_managers/center_workers', $data);

    // }

    public function center_workers_update($workerId){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
            $data = [
                'center_workers' => $center_workers,
                'id'=> $workerId,
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
                'address_err' =>''
                
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
        }elseif($this->centerworkerModel->getCenterWorkersByNIC_except($data['nic'] , $workerId)){
          $data['nic_err'] = 'Already exists a center worker under this NIC';
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
          if($this->centerworkerModel->update_center_workers($data)){
            //die('sucess');
            $data['update_success']='True';       
            $this->view('center_managers/center_workers',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('center_managers/center_workers', $data);
        }

        //$this->view('center_managers/center_workers', $data);
      
      }
      else{

        $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
        $center_worker = $this->centerworkerModel->getCenterWorkerById($workerId);
        $data = [

          'center_workers' => $center_workers,
          'id'=> $workerId,
          'name' => $center_worker->name,
          'nic' => $center_worker->nic,
          'dob'=> $center_worker->dob,
          'contact_no'=> $center_worker->contact_no,
          'address' => $center_worker->address,
          'click_update' =>'True',
          'update_success'=>'',
          'confirm_delete'=> '',

          'name_err' => '',
          'nic_err' => '',
          'dob_err'=>'',
          'contact_no_err'=>'',
          'address_err' =>''
          
        ];
        
        $this->view('center_managers/center_workers', $data);

        
      }

     

    }

    public function center_workers_delete_confirm($workerId){
      $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
      $data = [
        'center_workers' => $center_workers,
        'confirm_delete' =>'True',
        'delete_success' =>'',
        'click_update' =>'',
        'update_success'=>'',
        'center_worker_id'=>$workerId

      ];

      $this->view('center_managers/center_workers', $data);
    } 


    public function center_workers_delete($workerId){

      $center_workers = $this->centerworkerModel->get_center_workers($_SESSION['center_id']);
      $data = [
        'center_workers' => $center_workers

      ];
      $center_worker = $this->centerworkerModel->getCenterWorkerById($workerId);
      if(empty($center_worker)){
        die('Center worker not found');
      }
      else{
        if($this->centerworkerModel->delete_center_workers($workerId)){
          $data['delete_success'] = 'True';
          $this->view('center_managers/center_workers', $data);
        }
        else{
          die('Something went wrong');
        }

      }

    }

   
  }

?>