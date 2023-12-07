<?php
  class Collectors extends Controller {
    public function __construct(){

      $this->collector_complain_Model=$this->model('Collector_Complain');
      $this->collectorModel=$this->model('Collector');
      $this->collector_assistantModel=$this->model('Collector_Assistant');
      $this->creditModel=$this->model('Credit_amount');
      $this->collector_complain_Model=$this->model('Collector_Complain');
      $this->userModel=$this->model('User');
      $this->Request_Model=$this->model('Request');
      $this->Customer_Credit_Model=$this->model('Customer_Credit');

      if(!isLoggedIn('collector_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $credit= $this->creditModel->get();
      $data = [
        'title' => 'TraversyMVC',
        'eco_credit_per'=>$credit
      ];
     
      $this->view('collectors/index', $data);
    }
    
    public function logout(){
      unset($_SESSION['collector_id']);
      unset($_SESSION['collector_email']);
      unset($_SESSION['collector_name']);
      unset($_SESSION['center_id']);
      unset($_SESSION['center']);
      unset($_SESSION['collector_profile']);
      session_destroy();
      redirect('users/login');
    }

    public function collector_assistants(){

      $collector_assistants = $this->collector_assistantModel->get_collector_assistants($_SESSION['collector_id']);
      $data = [
        'collector_assistants' => $collector_assistants,
        'assistant_id'=>'',
        'confirm_delete' =>'',
        'delete_success'=>'',
        'confirm_update' => '',
        'update_success'=>''
        
      ];
     
      $this->view('collectors/collector_assistants', $data);
    }

    public function collector_assistants_add(){
     
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
        } elseif (strlen($data['name']) > 255) {
          $data['name_err'] = 'Name is too long';

        }

        //validate NIC
        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }elseif(!(is_numeric($data['nic']) && (strlen($data['nic']) == 12)) && !preg_match('/^[0-9]{9}[vV]$/', $data['nic'])){
          $data['nic_err'] = 'Please enter a valid NIC';
        }elseif($this->collector_assistantModel->getCollectorAssisByNIC($data['nic'])){
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
          $data['address_err'] = 'Please enter adress';
        } elseif (strlen($data['address']) > 500) {
          $data['address_err'] = 'Address is too long ';
        }

        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) ){
          if($this->collector_assistantModel->add_collector_assistants($data)){
            $data['registered']='True';        
            $this->view('collectors/collector_assistants_add',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('collectors/collector_assistants_add', $data);

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
          'address_err' =>''
        ];
        
        $this->view('collectors/collector_assistants_add', $data);
      }

      
    }

    public function collector_assistants_delete_confirm($assisId){
      $collector_assistants = $this->collector_assistantModel->get_collector_assistants($_SESSION['collector_id']);
      $data = [
        'collector_assistants' => $collector_assistants,
        'confirm_delete' =>'True',
        'collector_assistant_id'=>$assisId,
        'delete_success'=>'',
        'confirm_update' =>'',
        'update_success'=> ''
      ];
     
      $this->view('collectors/collector_assistants', $data);
    } 

    public function collector_assistants_delete($assisId){
      $collector_assistants = $this->collector_assistantModel->get_collector_assistants($_SESSION['collector_id']);
      $data = [
        'collector_assistants' => $collector_assistants,
        'delete_success'=>'',
        'confirm_delete' =>'',
        'confirm_update' =>'',
        'update_success'=> ''

      ];
      $collector_assistant = $this->collector_assistantModel->getCollectorAssisById($assisId);
      if(empty($collector_assistant)){
        die('Center worker not found');
      }
      else{
        if($this->collector_assistantModel->delete_collector_assistants($assisId)){
          $data['delete_success']='True';
          $this->view('collectors/collector_assistants',$data);
        }
        else{
          die('Something went wrong');
        }

      }
    }

    public function complains(){
    
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
          'name' => trim($_POST['name']),
          'contact_no' => trim($_POST['contact_no']),
          'region' => '',
          'subject' => trim($_POST['subject']),
          'complain' => trim($_POST['complain']),
          'name_err' => '',
          'contact_no_err' => '',
          'region_err' => '',
          'subject_err' => '' ,
          'complain_err' => '' ,
          'completed'=>  '',
          'center_id'=>''
        ];
        
        /*if($data['completed']=='True'){
          $data['completed']=='';
          $this->view('collectors/complains', $data);
        }*/

        if(empty($data['name'])){
          $data['name_err'] = 'Please enter the name';
        }
       
        // Validate Password
        if (empty($data['contact_no'])) {
          $data['contact_no_err'] = 'Please enter the contact no';
      } elseif (!preg_match('/^\d{10}$/', $data['contact_no'])) {
          $data['contact_no_err'] = 'Invalid contact no';
      }
          
        if(empty($data['subject'])){
          $data['subject_err'] = 'Please enter subject';
        }
        
        if(empty($data['complain'])){
          $data['complain_err'] = 'Please enter complain';
        }

        if(empty($data['name_err']) && empty($data['contact_no_err']) && empty($data['region_err']) && empty($data['subject_err']) && empty($data['complain_err']) ){
          
          $data['center_id']=$_SESSION['center_id'];
          $data['region']=$_SESSION['center'];
          if($this->collector_complain_Model->complains($data)){
            $data['completed']="True";
            $this->view('collectors/complains', $data);
           
           
          } else {
            die('Something went wrong');
          }
        }
        else{     
              $this->view('collectors/complains', $data);         
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
        $this->view('collectors/complains', $data);
      }
     
    }

    public function collector_assistants_update($assisId){
  
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $collector_assistants = $this->collector_assistantModel->get_collector_assistants($_SESSION['collector_id']);
            $data = [
               'collector_assistants' => $collector_assistants,
               'id' => $assisId,
               'name' =>trim($_POST['name']),
               'nic' => trim($_POST['nic']),
               'dob'=>trim($_POST['dob']),
               'contact_no'=>trim($_POST['contact_no']),
               'address' =>trim($_POST['address']),
               'confirm_update' =>'True',
               'update_success'=>'',
               'confirm_delete'=>'',
               'delete_success'=>'',
               'completed'=>'',
               'name_err' => '',
               'nic_err' => '',
               'dob_err'=>'',
               'contact_no_err'=>'',
               'address_err' =>''            
        ];
  
        //validate name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        } elseif (strlen($data['name']) > 255) {
          $data['name_err'] = 'Name is too long';
        }
  
        //validate NIC
        if(empty($data['nic'])){
          $data['nic_err'] = 'Please enter NIC';
        }elseif(!(is_numeric($data['nic']) && (strlen($data['nic']) == 12)) && !preg_match('/^[0-9]{9}[vV]$/', $data['nic'])){
          $data['nic_err'] = 'Please enter a valid NIC';
        }elseif($this->collector_assistantModel->getCollectorAssisByNIC_except($data['nic'] , $assisId)){
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
          $data['address_err'] = 'Please enter adress';
        } elseif (strlen($data['address']) > 500) {
          $data['address_err'] = 'Address is too long ';
        }
  
        if(empty($data['address_err']) && empty($data['contact_no_err']) && empty($data['dob_err']) && empty($data['nic_err']) && empty($data['name_err']) ){
          if($this->collector_assistantModel->update_collector_assistants($data)){
            $data['update_success']='True';        
            $this->view('collectors/collector_assistants',$data);
          } else {
            die('Something went wrong');
          }
        }
        else{
          $this->view('collectors/collector_assistants',$data);
        }
      }

 
      else{
        $ass = $this -> collector_assistantModel -> getCollectorAssisById($assisId);
        $collector_assistants = $this->collector_assistantModel->get_collector_assistants($_SESSION['collector_id']);

        $data = [
          'collector_assistants' => $collector_assistants,
          'id' => $assisId,
          'name' => $ass->name,
          'nic' => $ass->nic,
          'dob'=> $ass->dob,
          'contact_no'=> $ass->contact_no,
          'address' => $ass->address,
          'confirm_update' =>'True',
          'update_success'=> '',
          'confirm_delete'=>'',
          'delete_success'=>'',

          'name_err' => '',
          'nic_err' =>'',
          'dob_err'=> '',
          'contact_no_err'=> '',
          'address_err' => ''
        ];
        
        $this->view('collectors/collector_assistants', $data);
      }
    }

    public function editprofile(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id=$_SESSION['collector_id']; 
        $user=$this->collectorModel->getCollectorById($id);

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data=[
          'name'=>trim($_POST['name']),
         'userid'=>'',
         'email'=>'',
         'profile_image_name' => $_SESSION['collector_email'].'_'.$_FILES['profile_image']['name'],
         'contactno'=>trim($_POST['contactno']),
         'address'=>trim($_POST['address']),
         'city'=>'',
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
         'success_message'=>''];

        
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
                $this->collectorModel->editprofile($data);
                $data['success_message']="Profile Details Updated Successfully";
                $data['change_pw_success']='True';
                $data['profile_err'] = '';
           } else {
             $old_image_path = 'C:/xampp/htdocs/ecoplus/public/img/img_upload/collector/' . $user->image;    
            if (updateImage($old_image_path, $_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/collector/')) {
              $this->collectorModel->editprofile_withimg($data);
              $data['success_message']="Profile Details Updated Successfully";
              $data['change_pw_success']='True';
              $data['profile_err'] = '';
            
            } else {
                $data['profile_err'] = 'Error uploading the profile image';
                $this->view('collectors/editprofile', $data); 
            }
            
          }
        }

        $this->view('collectors/editprofile', $data);
       }
       else{ 

        $data=['name'=>'',
        'userid'=>'',
        'email'=>'',
        'contactno'=>'',
        'address'=>'',
        'city'=>'',
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
        'success_message'=>''];

        $id=$_SESSION['collector_id']; 
        $user=$this->collectorModel->getCollectorById($id);
        $data['name']=$_SESSION['collector_name'];
        $data['contactno']=$user->contact_no;
        $data['address']=$user->address;
        $this->view('collectors/editprofile', $data);
       }
  
   
    }

   public function change_password(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); $data=[
        'name'=>'',
        'userid'=>'',
        'email'=>'',
        'contactno'=>'',
        'address'=>'',
        'city'=>'',
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
        'city_err'=>'' ,
        'profile_err'=>'',
        'success_message'=>''
      ];


      $id=$_SESSION['collector_id']; 
      $user=$this->collectorModel->getCollectorById($id);
      $data['name']=$_SESSION['collector_name'];
      $data['contactno']=$user->contact_no;
      $data['address']=$user->address;
   

      if (empty($data['current'])) {
        $data['current_err'] = 'Please Enter Current Password';
    }
    
    if (empty($data['new_pw'])) {
        $data['new_pw_err'] = 'Please Enter New Password';
    } elseif (strlen($data['new_pw']) < 6) {
        $data['new_pw_err'] = 'New Password must be at least 6 characters';
    }
    
    if (empty($data['re_enter_pw'])) {
        $data['re_enter_pw_err'] = 'Please Confirm New Password';
    } elseif (strlen($data['re_enter_pw']) < 6) {
        $data['re_enter_pw_err'] = 'Confirmed Password must be at least 6 characters';
    }

    if(empty($data['new_pw_err']) && empty($data['current_err']) && empty($data['re_enter_pw_err'])) {
         
            if($this->userModel->pw_check($_SESSION['collector_id'],$data['current'])){
              if($data['new_pw']!=$data['re_enter_pw']){
                $data['new_pw_err'] = 'Passwords Does not match';
              }
              else{
                if($this->userModel->change_pw($_SESSION['collector_id'],$data['re_enter_pw'])){
                  $data['success_message']="Password Changed Successfully";
                  $data['change_pw_success']='True';
                  $this->view('collectors/editprofile', $data);
                }
              }
            }
            else{
              $data['current_err'] = 'Invalid Password';
            }
                 
      }

      $this->view('collectors/editprofile', $data);
      }
      else{
        $data = [
          'name'=>'',
          'userid'=>'',
          'email'=>'',
          'contactno'=>'',
          'address'=>'',
          'city'=>'',
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
        $this->view('customers/editprofile', $data);

      }

   }

   public function request_assinged(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $assinged_Requests=$this->Request_Model->get_assigned_request_by_collector( $_SESSION['collector_id'] );
      $jsonData = json_encode($assinged_Requests);
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       $data = [
        'assigned_requests' => $assinged_Requests,
        'jsonData' => $jsonData,
        'request_id'=>trim($_POST['id']),
        'reason'=>trim($_POST['reason']),
        'cancelled_by'=>'Collector',
        'assinged'=>'Yes',
        'collector_id'=>($_SESSION['collector_id'])
      ];
      if (empty($data['reason']) || str_word_count($data['reason']) > 200) {
        $this->view('collectors/request_assinged', $data);

      } else {
        $this->Request_Model->cancel_request($data);
        $this->request_cancelled();
      }

    }
    else{
      $assinged_Requests=$this->Request_Model->get_assigned_request_by_collector( $_SESSION['collector_id'] );
      $jsonData = json_encode($assinged_Requests);
      $data = [
        'assigned_requests' => $assinged_Requests,
        'jsonData' => $jsonData,
      ];
     
      $this->view('collectors/request_assinged', $data);
    }
    
   }

   public function request_completed(){
    $data = [
      'title' => 'TraversyMVC',
    ];
   
    $this->view('collectors/request_completed', $data);
   }

   public function request_cancelled(){

    $cancelled_requests=$this->Request_Model->get_cancelled_request_by_collector($_SESSION['collector_id']);
    $data = [
      'cancelled_requests' => $cancelled_requests,
    ];
   
    $this->view('collectors/request_cancelled', $data);
   }

   public function enterWaste_And_GenerateEcoCredits($req_id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $collector_id = $_SESSION['user_id'];
        $creditAmount = $this->Customer_Credit_Model->get_customer_credit_balance($customer_id);

        $data = [
            'req_id'=>$req_id,
            'collector_id' => $collector_id,
            'polythene' => $_POST['Polythene'],
            'plastic' => $_POST['Plastic'],
            'glass' => $_POST['Glass'],
            'paper_waste' => $_POST['Paper_Waste'],
            'electronic_waste' => $_POST['Electronic_Waste'],
            'metals' => $_POST['Metals'],
            'credit_Amount'=> $creditAmount,
            'note' => $_POST['note'],
            'popup' => ''
         
        ];

        /*if ( ) {
           } else {
        }*/
        } else {
          //$collector_id = $_SESSION['user_id'];
          //$creditAmount = $this->collectorModel->get_customer_credit_balance($customer_id);
          $data = [
          'req_id'=>$req_id,
          //'collector_id' => $collector_id,
          'polythene' =>'',
          'plastic' => '',
          'glass' => '',
          'paper_waste' => '',
          'electronic_waste' => '',
          'metals' => '',
          'credit_Amount'=> '',
          'note' => '',
          'popup' => 'True'
          ];
          $this->view('collectors/request_assinged', $data);
        } 
}



  
  }




  