<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
  class Admin extends Controller {
    
    private $mail;
    
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
      $this->Report_User_Model=$this->model('Report_User');
      $this->fine_model = $this->model('Fines');
      $this->Annoucement_Model=$this->model('Announcement');
      $this->garbage_Model=$this->model('Garbage_Stock');
      $this->MailSubscriptionModel = $this->model('Mail_Subscriptions');
      $this->Customer_Credit_Model = $this->model('Customer_Credit');

       //  $this->mail = new PHPMailer();
          //  $this->mail->isSMTP();
          //  $this->mail->Host = 'smtp.gmail.com';
          //  $this->mail->Port = 587;
          //  $this->mail->Username = 'ecoplusgroupproject@gmail.com';
          //  $this->mail->Password = 'zzruvawrzshhafbk';
          //  $this->mail->SMTPSecure = 'tls';
          //  $this->mail->SMTPAuth = true;
           

              // Setup PHPMailer
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'sandbox.smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        $this->mail->Username = 'f4ab65cd067d1f';
        $this->mail->Password = '111c78b575960b';


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
  
      $center_managers = $this->center_managerModel->get_center_managers();
      $customers = $this->customerModel->get_all();
      $collectors =$this->collector_model->get_collectors();
      $centers = $this->center_model->getallCenters();
      $agents  = $this->discount_agentModel->get_discount_agent();

      $jsonData = json_encode($centers );

      $fine_details = $this->fine_model->get_fine_details();
      $completedRequests=$this->Collect_Garbage_Model->getAllCompletedRequests();
      $totalRrequests=$this->requests_model->getTotalRequests();
      
      $total_collected=json_encode($this->Collect_Garbage_Model->getTotalGarbage());
   
      $data = [
        'completedRequests'=> $completedRequests,
        'totalRequests'=> $totalRrequests,
        'fines'=>$fine_details,
        'cm_count'=>count($center_managers),      
        'customer_count'=>count($customers),
        'collector_count'=>count( $collectors),
        'Total_collected'=>$total_collected,
        'agent_count'=>count($agents),
        'centers'=>$jsonData,
        'creditsGiven' => ($creditMonth->credit_amount !== null) ? $creditMonth->credit_amount : 0      ];

      foreach($fine_details as $fine ){
        if($fine){
          $fine_type = strtolower($fine->type);
          $data["{$fine_type}"] = $fine->fine_amount;
          $data["{$fine_type}_err"] ='';
        }
      }

      $this->view('admin/index', $data);
    }

    public function refund($id){
      $req=$this->requests_model->get_cancelled_request_by_id($id);
      $balance=$this->Customer_Credit_Model->get_customer_credit_balance($req->customer_id);
      $newbalance=$balance+$req->fine;
      $this->requests_model->refund( $req,$newbalance);
      header("Location: " . URLROOT . "/Admin"); 
    }

    public function complain_customers(){
    
      $complains = $this->customer_complain_Model->get_customer_complains_with_image();
      $data = [
        'complains' => $complains
      ];
      
      $this->view('admin/complain_customers', $data);
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
      if($cm_id->image=="profile.png"){

      }else{
        deleteImage("C:\\xampp\\htdocs\\ecoplus\\public\\img\\img_upload\\center_manager\\" . $cm_id->image);

      }
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
           'contact_no' => trim($_POST['contact_no']),
          'profile_image_name' => 'Profile.png',
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
       // Check if date of birth is empty
       if(empty($data['dob'])){
          $data['dob_err'] = 'Please enter dob';
        } else {
         // Calculate the age from date of birth
           $dob = new DateTime($data['dob']);
           $now = new DateTime();
           $age = $now->diff($dob)->y;

          // Check if age is less than 18
           if($age < 18) {
            $data['dob_err'] = 'You must be at least 18 years old.';
          }
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
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
      } elseif (strlen($data['password']) < 8 || strlen($data['password']) > 30) {
          $data['password_err'] = 'Password must be between 8 and 30 characters';
      } elseif (!preg_match('/[^\w\s]/', $data['password'])) {
          $data['password_err'] = 'Password must include at least one symbol';
      } elseif (!preg_match('/[A-Z]/', $data['password'])) {
          $data['password_err'] = 'Password must include at least one uppercase letter';
      } elseif (!preg_match('/[a-z]/', $data['password'])) {
          $data['password_err'] = 'Password must include at least one lowercase letter';
      } elseif (!preg_match('/[0-9]/', $data['password'])) {
          $data['password_err'] = 'Password must include at least one number';
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
          // // Validated
          // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          // if($this->center_managerModel->register_center_manager($data)){
          //   $data['registered']='True';        
          //   $this->view('admin/center_managers_add',$data);
          // } else {
          //   die('Something went wrong');
          // }


          $pw=$data['password'];
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          $selector = bin2hex(random_bytes(8));
          $token = random_bytes(32);
         
          $url = 'http://localhost/ecoplus/users/register_success_CMAdmin?selector='.$selector.'&validator='.bin2hex($token).'&email='.urlencode($data['email']);            
          //Expiration date will last for half an hour
          $expires = date("U") + 1800;
          if(!$this->userModel->deleteEmailCM_Admin($data['email'])){
            header("Location: " . URLROOT . "");        

          }
         
          
          $hashedToken = password_hash($token, PASSWORD_DEFAULT);
          $data['selector']=$selector;
          $data['hashedToken']=$hashedToken;
          $data['expires']=$expires;
          // Register User
          if($this->userModel->register_confirm_cm_admin($data)){
            
            $usersEmail = $data['email'];

      
            $subject = "Login to your account";
            $message = "<p>We recieved a login request.</p>";
            $message .= "<p>Here is your login link: </p>";
            $message .= "<a href='".$url."'>".$url."</a>";

            $this->mail->setFrom('ecoplusgroupproject@gmail.com');
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            $this->mail->addAddress( $usersEmail);

            if (!$this->mail->send()) {
              header("Location: " . URLROOT . "");        
          } else {
              $data['registered'] = 'True';        
              $this->view('admin/center_managers_add', $data);
          }
          

          
          }
           else {
            redirect('users/login');
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
      $centers = $this->center_model->getallCenters();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $center=trim($_POST['center-dropdown']);
        if($center!="none"){
           $customers = $this->customerModel->get_customer_by_region($center);

        }
        else{
          $center_id="none";
          $customers = $this->customerModel->get_all();

        }
         $data = [
            'customers' =>$customers,
            'delete_confirm'=>'',
            'fine'=>'',
            'centers'=> $centers,
            'center'=>$center
            ] ;
           
        $this->view('admin/customer_main', $data);

      }else{
        
        $data = [
            'customers' =>$customers,
            'delete_confirm'=>'',
            'fine'=>'',
            'centers'=> $centers,
          'center'=>''
        ];
        
        $this->view('admin/customer_main', $data);

    }}
    
     
    public function center($success=""){

      $centers = $this->center_model->getallCenters();
      $data = [
        'centers' =>$centers,
        'delete_center'=>'',
        'center_block'=>'',
        'Error'=>'',
        'Success'=>$success
      ];
       $this->view('admin/center_view', $data);
    }

    public function center_add($success="False"){
      
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
            'center_add_success'=>$success,
            'lattitude'=>trim($_POST['latittude']),
            'longitude'=>trim($_POST['longitude']),
            'radius'=>trim($_POST['radius']),
            'location_err'=>'',
            'location_success'=>'',
            

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
             header("Location: " . URLROOT . "/admin/center_add/True");        

            } else {
              $this->view('admin/center_add', $data);
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
          'center_add_success'=>$success,
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

    public function center_block($id){
  
      $center=$this->center_model->getCenterById($id);
     
      $requests=$this->requests_model->get_ongoing_request_by_center($center->region);
      if(empty($requests)){
        
        $requests2=$this->requests_model->get_nothandovered_request_by_center($center->region);
        
        if(empty($requests2)){
             $garbage_stock=$this->garbage_Model->get_current_gabage_stockbyid($id);
            
             if (
              $garbage_stock[0]->current_electronic == 0 &&
              $garbage_stock[0]->current_plastic == 0 &&
              $garbage_stock[0]->current_polythene == 0 &&
              $garbage_stock[0]->current_metal == 0 &&
              $garbage_stock[0]->current_glass == 0 &&
              $garbage_stock[0]->current_paper == 0) {
                var_dump($center->center_manager_id);
                $result= $this->center_managerModel->update_cm_to_na($center->center_manager_id);
                
                if($result){
                  $this->center_model->disable_center($id);
              
                  header("Location: " . URLROOT . "/admin/center/True"); 
                }else{
                  header("Location: " . URLROOT . "/admin/center/False"); 
                }
               

         }
             else{
              header("Location: " . URLROOT . "/admin/center/False"); 
             }
        }
        else{
          header("Location: " . URLROOT . "/admin/center/False");    
        }
      }else{
        header("Location: " . URLROOT . "/admin/center/False"); 

      
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

    public function collectors($collector_sucesss="False"){
      $collectors =$this->collector_model->get_collectors();
      $data = [
        'collectors' =>$collectors,
        'delete_confirm'=>'',
        'vehicle_details_click'=> '',
        'collector_success'=>$collector_sucesss
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
     
      header("Location: " . URLROOT . "/admin/collectors/True");        
    }

    public function complain_collectors(){
      $collector_complains= $this->collector_complain_Model->get_collector_complains_with_image();

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
      $total_garbage = $this->garbage_Model->get_total_garbage_by_centerId($center_id);
      $marked_holidays = $this->center_managerModel->get_marked_holidays($region);

      //var_dump($total_garbage);
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){  
        $data = [
          'center' =>$center,
          'not_assigned_cm'=>$na_center_managers,
          'change_cm'=>'',
          'no_of_collectors' =>$no_of_collectors,
          'no_of_workers'=>$no_of_workers,
          'center_manager' =>$center_manager,
          'total_requests'=>$total_requests,
          'total_garbage' => $total_garbage->total_garbage,
          'lattitude'=>trim($_POST['latittude']),
          'longitude'=>trim($_POST['longitude']),
          'radius'=>trim($_POST['radius']),
          'marked_holidays'=> $marked_holidays,
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
        'total_garbage' => $total_garbage->total_garbage,
        'marked_holidays'=> $marked_holidays,
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
       $total_garbage = $this->garbage_Model->get_total_garbage_by_centerId($center_id);

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
            'total_requests'=>$total_requests,
            'total_garbage' => $total_garbage->total_garbage,

          ];
        
          header("Location: " . URLROOT . "/admin/center_main/$center_id/$center->region");        

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
          'total_requests'=>$total_requests,
          'total_garbage' => $total_garbage->total_garbage
        ];
        $this->view('admin/center_main', $data);
      }
     
    }

    public function center_main_collectors($center_id){
      $collectors_in_center = $this->collector_model->get_collectors_bycenterid($center_id);
      $center=$this->center_model->getCenterById($center_id);
      $collector_assistants = $this->collector_assistants_Model->get_collector_assistants_by_centerId($center_id);
      
      $data =[
        'collectors_in_center' =>$collectors_in_center,
        'collector_assitants' => $collector_assistants,
        'center_id'=> $center_id,
        'center'=>$center
        
      ];
      //var_dump($data['collector_assitants']);
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

      $center_complaints= $this->center_complaints_model->get_center_complains_with_image();

      $data = [
        'complaints' => $center_complaints
      ];
      $this->view('admin/complain_centers', $data);
    }

    public function discount_agents($sucess="False"){

      $discount_agent = $this->discount_agentModel->get_discount_agent();
      $data = [
        'discount_agents' => $discount_agent,
        'confirm_delete' =>'',
        'assigned'=>'',
        'success'=>$sucess,
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
          'contact_no' => trim($_POST['contact_no']),
          'profile_image_name' => 'profile.png',
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
      
  
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['address_err']) ){
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

    public function discount_agent_view($id){      
        
      $agent=$this->discount_agentModel->getDiscountAgentByID2($id);
      $discouts=$this->discount_agentModel->getDiscountByAgent($id);
      $credit_log=$this->discount_agentModel->getCreditlog($id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data=[
            'agent'=>$agent,
            'discounts'=>$discouts,
            'new_balance'=>'',
            'credit'=>trim($_POST['credit_value']),
            'credit_log'=>$credit_log,
          ];

        $center_managers = $this->center_managerModel->get_center_managers();
        $data['new_balance'] = (float)($agent->credits + $data['credit']);
        $agent=$this->discount_agentModel->addcredits($data);

        header("Location: " . URLROOT . "/admin/discount_agent_view/$id");        
      }else{
        $data=[
          'agent'=>$agent,
          'discounts'=>$discouts,
          'credit_log'=>$credit_log,
        ];
  
        $this->view('admin/discountagentmain', $data);
      }
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
    
      header("Location: " . URLROOT . "/admin/discount_agents/True");        
    }   
    
    public function discount_agent_block($id){
      $this->discount_agentModel->block($id);
      header("Location: " . URLROOT . "/admin/discount_agents");        
    }
    
    public function discount_agent_unblockuser($id){

      $this->discount_agentModel->unblock($id);
      header("Location: " . URLROOT . "/admin/discount_agents");        
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

    public function addadmins($success="False"){

      if(isset($_SESSION['superadmin_id']) ){

        $admins=$this->adminModel->get_all();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        $data=[
          'admin'=>$admins,
          'success'=>$success,
          'confirm_delete'=>''
          
        ];    
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->view('admin/admins', $data);
      }       
      else{   
        $data=[
          'admin'=>$admins,
          'success'=>$success,
          'confirm_delete'=>''
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
         'contact_no' => trim($_POST['contact_no']),
        'profile_image_name' => "profile.png",
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
      
      

        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_no_err']) && empty($data['nic_err']) && empty($data['address_err']) && empty($data['dob_err']) ){
          // Validated
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          if($this->adminModel->register_admin($data)){
            header("Location: " . URLROOT . "/admin/addadmins");        

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

    public function reportusers(){
      $centers = $this->center_model->getallCenters();
      $allcustomers = $this->customerModel->get_all();

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
        $collectors= $this->Report_User_Model->getCollectors($fromDate,$toDate,$center);
        $customers= $this->Report_User_Model->getCustomers($fromDate,$toDate,$center);
        $collectorassistants= $this->Report_User_Model->getCollectorassistants($fromDate,$toDate,$center);
        $centerworkers= $this->Report_User_Model->getCenterworkers($fromDate,$toDate,$center);
        $allcustomers=
           $data = [     
            'to'=>$toDate,
            'from'=>$fromDate,     
            'centers'=> $centers,
            'center'=>$center, 
            'collectors'=>count($collectors),
            'customers'=>count($customers),
            'centerworkers'=>count($centerworkers),
            'collectorassistants'=>count($collectorassistants),
            'allcustomers'=>  $customers
          ];     
            $this->view('admin/reportusers', $data);

      
      }
      else{

        $collectors= $this->Report_User_Model->getCollectors();
        $customers= $this->Report_User_Model->getCustomers();
        $collectorassistants= $this->Report_User_Model->getCollectorassistants();
        $centerworkers= $this->Report_User_Model->getCenterworkers();
    
        $data = [          
          'to'=>'none',
          'from'=>'none',
          'centers'=> $centers,          
          'center'=>'All',
          'collectors'=>count($collectors),
          'customers'=>count($customers),
          'centerworkers'=>1,
          'collectorassistants'=>count($centerworkers),
          'allcustomers'=>  $allcustomers,
          'allcustomers'=>  $customers
        ];
          $this->view('admin/reportusers', $data);

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
        $totalRequests=count($completedRequests)+count($cancelledRequests)+count($ongoingRequests);
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
          'totalRequests'=>  $totalRequests,
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
        $totalRequests=count($completedRequests)+count($cancelledRequests)+count($ongoingRequests);
        $centers = $this->center_model->getallCenters();
        $credits=$this->Report_Model->getCredits();
        $creditByMonth=$this->Report_Model->getCreditsMonths();
        $collectedWasteByMonth=$this->Report_Model->getCollectedGarbage();
        $handoveredWasteByMonth=$this->Report_Model->getHandOveredGarbage();
        $selledWasteByMonth=$this->Report_Model->getSelledGarbage();
      
        $data=[
          'completedRequests'=> count($completedRequests),
          'cancelledRequests'=> count($cancelledRequests),
          'ongoingRequests'=> count($ongoingRequests),
          'totalRequests'=>  $totalRequests,
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

    public function admin_delete($id) {
      $admin_by_id = $this->adminModel->getAdminByID($id);
      $this->adminModel->admin_delete($id);
      $admin = $this->adminModel->get_all();
     
      if($admin_by_id->image=="profile.png"){

      }else{
        deleteImage("C:\\xampp\\htdocs\\ecoplus\\public\\img\\img_upload\\Admin\\" . $admin_by_id->image);
      }
      
      $data = [
        'admin' => $admin,
        'confirm_delete' =>'',
        'success'=>'True',
        'admin_id'=>$id,
        'personal_details_click'=>''
      ];
      header("Location: " . URLROOT . "/admin/addadmins/True");        

      $this->view('admin/admins', $data);
    }

    public function edit_profile(){

      if(isset($_SESSION['admin_id'])){
        $admin_id =  $_SESSION['admin_id'];
        $admin = $this->adminModel->getAdminByID($admin_id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
          
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
            'id' => $admin_id,
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'profile_image_name' => $_SESSION['admin_email'].'_'.$_FILES['profile_image']['name'],
            'address' => trim($_POST['address']),
            'contactno' => trim($_POST['contactno']),
            'current'=>'',
            'new_pw'=>'',
            're_enter_pw'=>'',
            'current_err'=>'',
            'new_pw_err'=>'',
            're_enter_pw_err'=>'',
            'change_pw_success'=>'',
            'name_err'=>'',
            'address_err'=>'',
            'contactno_err' =>'',
            'city_err'=>'',
            'profile_err'=>'',
            'success_message'=>''
          ];

          if (empty($data['name'])) {
            $data['name_err'] = 'Please Enter a Name';
          } elseif (strlen($data['name']) > 200) {
            $data['name_err'] = 'Name should be at most 200 characters';
          }
    
          if (empty($data['contactno'])) {
            $data['contactno_err'] = 'Please Enter a Contact No';
          } elseif (!preg_match('/^\d{10}$/', $data['contactno'])) {
            $data['contactno_err'] = 'Contact No should be 10 digits ';
          }

          if (empty($data['address'])) {
            $data['address_err'] = 'Please Enter an Address';
          } elseif (strlen($data['address']) > 200) {
            $data['address_err'] = 'Address should be at most 200 characters';
          }

          if(empty($data['name_err']) && empty($data['contactno_err'])  && empty($data['address_err'])){
            
            if ($_FILES['profile_image']['error'] == 4) {
            
                if($this->adminModel->editprofile($data)){
                  $data['success_message']="Profile Details Updated Successfully";
                  $data['change_pw_success']='True';
                  $data['profile_err'] = '';
                

                }else{
                  die('Something went wrong');
                }
                
            } else {
              $old_image_path = 'C:/xampp/htdocs/ecoplus/public/img/img_upload/Admin/' . $admin->image;    
              if (updateImage($old_image_path, $_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/Admin/')) {
            
                if($this->adminModel->editprofile_withimg($data)){
                  $data['success_message']="Profile Details Updated Successfully";
                  $data['change_pw_success']='True';
                  $data['profile_err'] = '';

                }else{
                  die('Something went wrong');
                }
              
              
            
              } else {
                  $data['profile_err'] = 'Error uploading the profile image';
                  $this->view('admin/editprofile', $data); 
              }

              //$this->view('admin/editprofile', $data);
            
            }
          }

          $this->view('admin/editprofile', $data);

        }
        else{
          
          $data=[
            'id' => $admin_id,
            'name' => $_SESSION['admin_name'],
            'email' => $_SESSION['admin_email'],
            'address' => $admin->address,
            'contactno' => $admin->contact_no,
            'current'=>'',
            'new_pw'=>'',
            're_enter_pw'=>'',
            'current_err'=>'',
            'new_pw_err'=>'',
            're_enter_pw_err'=>'',
            'change_pw_success'=>'',
            'name_err'=>'',
            'address_err'=>'',
            'contactno_err' =>'',
            'city_err'=>'',
            'profile_err'=>'',
            'success_message'=>''


          ];

          $this->view('admin/editprofile', $data);


        }

      } else if(isset($_SESSION['superadmin_id'])){


        $data=[
          'id' => $_SESSION['superadmin_id'],
          'name' => $_SESSION['admin_name'],
          'email' => $_SESSION['admin_email'],
          'current'=>'',
          'new_pw'=>'',
          're_enter_pw'=>'',
          'current_err'=>'',
          'new_pw_err'=>'',
          're_enter_pw_err'=>'',
          'change_pw_success'=>'',
          'success_message'=>''

        ];

        $this->view('admin/editprofile', $data);
      }

      
    }

    public function change_password(){

      if(isset($_SESSION['admin_id'])){

        $admin_id =  $_SESSION['admin_id'];
        $admin = $this->adminModel->getAdminByID($admin_id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
          $data=[
            
            'id'=> $admin_id,
            'name'=> $_SESSION['admin_name'],
            'email' => $_SESSION['admin_email'],
            'address' => $admin->address,
            'contactno' => $admin->contact_no,         
            'current'=>trim($_POST['current']),
            'new_pw'=>trim($_POST['new_pw']),
            're_enter_pw'=>trim($_POST['re_enter_pw']),
            'current_err'=>'',
            'new_pw_err'=>'',
            're_enter_pw_err'=>'',
            'change_pw_success'=>'',
            'name_err'=>'',
            'address_err'=>'',
            'contactno_err' =>'',
            'profile_err'=>'',
            'success_message'=>'',      
   
          ];
    
  
          if (empty($data['current'])) {
            $data['current_err'] = 'Please enter current password';
          }
        

          if (empty($data['new_pw'])) {
            $data['new_pw_err'] = 'Please Enter New Password';
          } elseif (strlen($data['new_pw']) < 8 || strlen($data['new_pw']) > 30) {
              $data['new_pw_err'] = 'New password must be between 8 and 30 characters';

          } elseif (!preg_match('/[^\w\s]/', $data['new_pw'])) {
              $data['new_pw_err'] = 'New password must include at least one symbol';

          } elseif (!preg_match('/[A-Z]/', $data['new_pw'])) {
              $data['new_pw_err'] = 'New password must include at least one uppercase letter';

          } elseif (!preg_match('/[a-z]/', $data['new_pw'])) {
              $data['new_pw_err'] = 'New password must include at least one lowercase letter';

          } elseif (!preg_match('/[0-9]/', $data['new_pw'])) {
            $data['new_pw_err'] = 'New password must include at least one number';
          }


          if (empty($data['re_enter_pw'])) {
            $data['re_enter_pw_err'] = 'Please confirm new password';
          } elseif (strlen($data['re_enter_pw']) < 8 || strlen($data['re_enter_pw']) > 30) {
              $data['re_enter_pw_err'] = 'Confirmed password must be between 8 and 30 characters';

          } elseif (!preg_match('/[^\w\s]/', $data['re_enter_pw'])) {
              $data['re_enter_pw_err'] = 'Confirmed password must include at least one symbol';

          } elseif (!preg_match('/[A-Z]/', $data['re_enter_pw'])) {
              $data['re_enter_pw_err'] = 'Confirmed password must include at least one uppercase letter';

          } elseif (!preg_match('/[a-z]/', $data['re_enter_pw'])) {
              $data['re_enter_pw_err'] = 'Confirmed password must include at least one lowercase letter';

          } elseif (!preg_match('/[0-9]/', $data['re_enter_pw'])) {
            $data['re_enter_pw_err'] = 'Confirmed password must include at least one number';
          }
        
    
          if(empty($data['new_pw_err']) && empty($data['current_err']) && empty($data['re_enter_pw_err'])) {
              
                  if($this->userModel->pw_check($_SESSION['admin_id'],$data['current'])){
                    if($data['new_pw'] != $data['re_enter_pw']){
                      $data['new_pw_err'] = 'Passwords does not match';
                    }
                    else{
                      if($this->userModel->change_pw($_SESSION['admin_id'],$data['re_enter_pw'])){
                        $data['success_message']="Password changed successfully";
                        $data['change_pw_success']='True';
                        $this->view('admin/editprofile', $data);
                      }
                    }
                  }
                  else{
                    $data['current_err'] = 'Invalid password';
                  }
                      
            }
      
            $this->view('admin/editprofile', $data);
        }
        else{
          $data = [
            'name'=>'',
            'userid'=>'',
            'email'=>'',
            'contactno'=>'',
            'address'=>'',
            'current'=>'',
            'new_pw'=>'',
            're_enter_pw'=>'',
            'current_err'=>'',
            'new_pw_err'=>'',
            're_enter_pw_err'=>'',
            'change_pw_success'=>'',
            'name_err'=>'',
            'address_err'=>'',
            'contactno_err' =>'',
            'profile_err'=>'',
            'success_message'=>'',          
          

          ];
          $this->view('admin/editprofile', $data);
  
        }


      }elseif(isset($_SESSION['superadmin_id'])){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
          $data=[
            
            'id'=> $_SESSION['superadmin_id'],
            'name'=> $_SESSION['admin_name'],
            'email' => $_SESSION['admin_email'],      
            'current'=>trim($_POST['current']),
            'new_pw'=>trim($_POST['new_pw']),
            're_enter_pw'=>trim($_POST['re_enter_pw']),
            'current_err'=>'',
            'new_pw_err'=>'',
            're_enter_pw_err'=>'',
            'change_pw_success'=>'',
            'name_err'=>'',
            'profile_err'=>'',
            'success_message'=>'',      
   
          ];
    
  
          if (empty($data['current'])) {
            $data['current_err'] = 'Please enter current password';
          }
        

          if (empty($data['new_pw'])) {
            $data['new_pw_err'] = 'Please Enter New Password';
          } elseif (strlen($data['new_pw']) < 8 || strlen($data['new_pw']) > 30) {
              $data['new_pw_err'] = 'New password must be 8-30 characters long';

          } elseif (!preg_match('/[^\w\s]/', $data['new_pw'])) {
              $data['new_pw_err'] = 'New password must include at least one symbol';

          } elseif (!preg_match('/[A-Z]/', $data['new_pw'])) {
              $data['new_pw_err'] = 'New password must include at least one uppercase letter';

          } elseif (!preg_match('/[a-z]/', $data['new_pw'])) {
              $data['new_pw_err'] = 'New password must include at least one lowercase letter';

          }elseif (!preg_match('/[0-9]/', $data['new_pw'])) {
            $data['new_pw_err'] = 'New password must include at least one number';
          }


          if (empty($data['re_enter_pw'])) {
            $data['re_enter_pw_err'] = 'Please confirm new password';
          } elseif (strlen($data['re_enter_pw']) < 8 || strlen($data['re_enter_pw']) > 30) {
              $data['re_enter_pw_err'] = 'Confirmed password must be 8-30 characters long';

          } elseif (!preg_match('/[^\w\s]/', $data['re_enter_pw'])) {
              $data['re_enter_pw_err'] = 'Confirmed password must include at least one symbol';

          } elseif (!preg_match('/[A-Z]/', $data['re_enter_pw'])) {
              $data['re_enter_pw_err'] = 'Confirmed password must include at least one uppercase letter';

          } elseif (!preg_match('/[a-z]/', $data['re_enter_pw'])) {
              $data['re_enter_pw_err'] = 'Confirmed password must include at least one lowercase letter';

          } elseif (!preg_match('/[0-9]/', $data['re_enter_pw'])) {
            $data['re_enter_pw_err'] = 'Confirmed password must include at least one number';
          }
        
    
          if(empty($data['new_pw_err']) && empty($data['current_err']) && empty($data['re_enter_pw_err'])) {
              
                  if($this->userModel->pw_check($_SESSION['superadmin_id'],$data['current'])){
                    if($data['new_pw'] != $data['re_enter_pw']){
                      $data['new_pw_err'] = 'Passwords does not match';
                    }
                    else{
                      if($this->userModel->change_pw($_SESSION['superadmin_id'],$data['re_enter_pw'])){
                        $data['success_message']="Password changed successfully";
                        $data['change_pw_success']='True';
                        $this->view('admin/editprofile', $data);
                      }
                    }
                  }
                  else{
                    $data['current_err'] = 'Invalid password';
                  }
                      
            }
      
            $this->view('admin/editprofile', $data);
        }
        else{
          $data = [
            'name'=>'',
            'userid'=>'',
            'email'=>'',
            'current'=>'',
            'new_pw'=>'',
            're_enter_pw'=>'',
            'current_err'=>'',
            'new_pw_err'=>'',
            're_enter_pw_err'=>'',
            'change_pw_success'=>'',
            'name_err'=>'',
            'profile_err'=>'',
            'success_message'=>'',          
          

          ];
          $this->view('admin/editprofile', $data);
  
        }

      }



    }

    public function announcements(){
      $Announcements=$this->Annoucement_Model->getAllAnnouncements();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){     
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Get the current date and time
          $currentDateTime = new DateTime();
          $formattedDateTime = $currentDateTime->format('Y-m-d_H-i-s');
          $imageNameWithDateTime = $formattedDateTime . '_' . $_FILES['cameraupload']['name'];
  
          $data=[
              'annoucements'=>$Announcements,
              'text'=>$_POST['text'],
              'header'=>$_POST['header'],
              'image'=>$imageNameWithDateTime,
               'header_err'=>'',
               'text_err'=>'',
               'image_err'=>''
          ];

          if (empty($data['text'])) {
            $data['text_err'] = 'Please enter a text';
           } elseif (strlen($data['text']) > 600 && strlen($data['text']) <20 ) {
             $data['text_err'] = 'Text should be at most 300 characters';
           }  
           
           if (empty($data['header'])) {
            $data['header_err'] = 'Please enter a text';
           } elseif (strlen($data['header']) > 55 && strlen($data['text']) <10 ) {
             $data['header_err'] = 'Header should be at most 55 characters';
           }  
           
           if (empty($data['image'])) {
            $data['image_err'] = 'Please enter a text';
           } 

           if(empty($data['image_err']) && empty($data['header_err']) && empty($data['text_err']) ){
            if (uploadImage($_FILES['cameraupload']['tmp_name'], $data['image'], '/img/img_upload/Annoucement/')) {
              $Announcements=$this->Annoucement_Model->addAnnouncement($data);  
              redirect('admin/announcements');

            } 
            else{
              redirect('admin/announcements');

            }

           }
  
  
          die($data['text']." ".$data['header']." ".$data['image']);
  
          $this->view('admin/announcement', $data);
  
      } else {
          $data=[
              'annoucements'=>$Announcements,
              'text'=>'',
              'header'=>'',
              'image'=>''
          ];
  
          // Load the view with the data
          $this->view('admin/announcement', $data);
      }
    }

    public function deleteAnnouncement($id){
      $this->Annoucement_Model->deleteAnnouncement($id);   
      redirect('admin/announcements');
    }
  
    public function waste_handover($region){
      $center=$this->center_model->getCenterByRegion($region);
      $confirmed_requests = $this->garbage_Model->get_confirmed_requests_by_region($region);
      $data =[
        'confirmed_requests'=>$confirmed_requests,
        'center_region'=> $region,
        'center'=> $center
      ];

      $this->view('admin/center_main_waste_handover', $data);
    }

    public function stock_releases($region){
      $center=$this->center_model->getCenterByRegion($region);
      $release_details = $this->garbage_Model->get_release_details($center->id);

      $data =[
        'release_details'=>$release_details,
        'center_region'=> $region,
        'center'=> $center
      ];

      $this->view('admin/center_main_stock_releases', $data);

    }

    public function center_main_garbage_stock($region){
      $center=$this->center_model->getCenterByRegion($region);
      $current_quantities = $this->garbage_Model->get_current_quantities_of_garbage($center->id);
      

      $data =[
        'current_polythene'=>$current_quantities->current_polythene,
        'current_plastic'=>$current_quantities->current_plastic,
        'current_glass'=>$current_quantities->current_glass,
        'current_paper'=>$current_quantities->current_paper,
        'current_electronic'=>$current_quantities->current_electronic,
        'current_metals'=>$current_quantities->current_metal,
        'center_region'=> $region,
        'center'=> $center
       

      ];

      $this->view('admin/center_main_garbage_stock', $data);

    }

    public function mail_subscriptions(){

      $subscriptions = $this->MailSubscriptionModel->get_mail_subscriptions();

      $data= [
        'subscriptions' => $subscriptions
      ];

      $this->view('admin/mail_subscriptions', $data);

    }

  
}