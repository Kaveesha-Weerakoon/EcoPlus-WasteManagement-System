<?php

  class Customers extends Controller {
    public function __construct(){

      $this->customer_complain_Model=$this->model('Customer_Complain');
      $this->creditModel=$this->model('Credit_amount');
      $this->customerModel=$this->model('Customer'); 
      $this->userModel=$this->model('User');
      $this->center_model=$this->model('Center');
      $this->customerModel=$this->model('Customer');
      $this->Customer_Credit_Model=$this->model('Customer_Credit');
      $this->Request_Model=$this->model('Request');
      $this->Collect_Garbage_Model=$this->model('Collect_Garbage');

      if(!isLoggedIn('user_id')){
        redirect('users/login');
      }
    }
    
    public function index(){
      $balance = $this->Customer_Credit_Model->get_customer_credit_balance($_SESSION['user_id']);
      $data = [
        'title' => 'TraversyMVC',
        'pop'=>'',
        'credit_balance'=>$balance 
      ];
     
      $this->view('customers/index', $data);
    }
      
    public function viewprofile(){
      $data = [
        'title' => 'TraversyMVC',
        'pop'=>'True',
        'name'=>'',
        'userid'=>'',
        'email'=>'',
        'contactno'=>'',
        'address'=>'',
        'city'=>''
      ];
      $id=$_SESSION['user_id']; 
      $user=$this->customerModel->get_customer($id);
      $data['name']=$_SESSION['user_name'];
      $data['userid']=$_SESSION['user_id'];
      $data['email']=$_SESSION['user_email'];
      $data['contactno']=$user->mobile_number;
      $data['address']=$user->address;
      $data['city']=$user->city;
      $this->view('customers/index', $data);
     
    }

    public function request_main(){

      $current_request=$this->Request_Model->get_request_current($_SESSION['user_id']);

      $data = [
        'request' => $current_request,
        'cancel'=>''
      ];
     
      $this->view('customers/request_main', $data);
    }

    public function cancel_request_confirm($req_id){

      $current_request=$this->Request_Model->get_request_current($_SESSION['user_id']);

      $data = [
        'request' => $current_request,
        'cancel'=>'True',
        'request_id'=>$req_id
      ];
     
      $this->view('customers/request_main', $data);
    }

    public function cancel_request($req_id){

      $data=[
        'request_id'=>$req_id,
        'reason' =>'',
        'cancelled_by'=>'Customer',
        'assinged'=>'No',
        'collector_id'=>''
      ];
      if($this->Request_Model->get_assigned_request($req_id)){
        $data['assinged']='Yes';
      }
      else{
        $data['assinged']='No';
      }

      $this->Request_Model->cancel_request($data);
      $this->request_cancelled();
    }

    public function request_completed(){
      $completed_request=$this->Collect_Garbage_Model->get_complete_request_relevent_customer($_SESSION['user_id']);
     
      $data = [
        'completed_request' => $completed_request
        
      ];
      $this->view('customers/request_completed', $data);
    }

    public function request_cancelled(){
      $cancelled_request=$this->Request_Model->get_cancelled_request($_SESSION['user_id']);
      $data = [
        'cancelled_request' => $cancelled_request
      ];
      $this->view('customers/request_cancelled', $data);
    }

    public function history(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('customers/history', $data);
    }

    public function history_complains(){
      $id=$_SESSION['user_id']; 
      $complains = $this->customer_complain_Model->get_complains($id);

      $data = [
        'complains' => $complains
      ];
     
      $this->view('customers/history_complains', $data);
    }

    public function transfer_history(){
      $transaction_history = $this->Customer_Credit_Model->get_transaction_history($_SESSION['user_id']); 
      $data = [
        'transaction_history' =>$transaction_history
      ];
     
      $this->view('customers/transfer_history', $data);
    }

    public function editprofile(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id=$_SESSION['user_id']; 
        $user=$this->customerModel->get_customer($id);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'=>trim($_POST['name']),
        'userid'=>'',
        'profile_image_name' => $_SESSION['user_email'].'_'.$_FILES['profile_image']['name'],
        'contactno'=>trim($_POST['contactno']),
        'address'=>trim($_POST['address']),
        'city'=>trim($_POST['city']),
        'current'=>'',       
        'email'=>trim($_POST['email']),

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
        $data['name_err'] = 'Please enter a name';
      } elseif (strlen($data['name']) > 200) {
        $data['name_err'] = 'Name should be at most 200 characters';
      }

      if (empty($data['contactno'])) {
        $data['contactno_err'] = 'Please enter a contact no';
      } elseif (!preg_match('/^\d{10}$/', $data['contactno'])) {
        $data['contactno_err'] = 'Contact no should be 10 digits ';
      }

      if (empty($data['city'])) {
       $data['city_err'] = 'Please enter a city';
      } elseif (strlen($data['city']) > 200) {
        $data['city_err'] = 'City should be at most 200 characters';
       }

     if (empty($data['address'])) {
        $data['address_err'] = 'Please enter an address';
     } elseif (strlen($data['address']) > 200) {
        $data['address_err'] = 'Address should be at most 200 characters';
      }

      if(empty($data['name_err']) && empty($data['contactno_err']) && empty($data['city_err']) && empty($data['address_err'])){
       
        if ($_FILES['profile_image']['error'] == 4) {
           $this->customerModel->editprofile($data);
           $data['profile_image_name']='';
           $data['success_message']="Profile Details Updated Successfully";
           $data['change_pw_success']='True';
          
        } else {
          $old_image_path = 'C:/xampp/htdocs/ecoplus/public/img/img_upload/customer/' . $user->image;
         
          if (updateImage($old_image_path, $_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/customer/')) {
            $this->customerModel->editprofile_withimg($data); 
            $data['success_message']="Profile Details Updated Successfully";
            $data['change_pw_success']='True';
            $data['profile_err'] = '';
           
          } else {
              $data['profile_err'] = 'Error uploading the profile image';
          }
          
        }
      } 
    
      $this->view('customers/edit_profile', $data);
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
      $id=$_SESSION['user_id']; 
      $user=$this->customerModel->get_customer($id);
      $data['name']=$_SESSION['user_name'];
      $data['userid']=$_SESSION['user_id'];
      $data['email']=$_SESSION['user_email'];
      $data['contactno']=$user->mobile_number;
      $data['address']=$user->address;
      $data['city']=$user->city;
     
      $this->view('customers/edit_profile', $data);
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
          'email'=>'',
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
  
  
        $id=$_SESSION['user_id']; 
        $user=$this->customerModel->get_customer($id);
        $data['name']=$_SESSION['user_name'];
        $data['contactno']=$user->mobile_number;
        $data['address']=$user->address;
        $data['city']=$user->city;
        $data['email']=$_SESSION['user_email'];

        if (empty($data['current'])) {
          $data['current_err'] = 'Please enter current password';
      }
      
      if (empty($data['new_pw'])) {
          $data['new_pw_err'] = 'Please Enter New Password';
      } elseif (strlen($data['new_pw']) < 6) {
          $data['new_pw_err'] = 'New password must be at least 6 characters';
      }
      
      if (empty($data['re_enter_pw'])) {
          $data['re_enter_pw_err'] = 'Please confirm new password';
      } elseif (strlen($data['re_enter_pw']) < 6) {
          $data['re_enter_pw_err'] = 'Confirmed password must be at least 6 characters';
      }
  
      if(empty($data['new_pw_err']) && empty($data['current_err']) && empty($data['re_enter_pw_err'])) {
           
              if($this->userModel->pw_check($_SESSION['user_id'],$data['current'])){
                if($data['new_pw']!=$data['re_enter_pw']){
                  $data['new_pw_err'] = 'Passwords does not match';
                }
                else{
                  if($this->userModel->change_pw($_SESSION['user_id'],$data['re_enter_pw'])){
                    $data['success_message']="Password changed successfully";
                    $data['change_pw_success']='True';
                    $this->view('customers/edit_profile', $data);
                  }
                }
              }
              else{
                $data['current_err'] = 'Invalid password';
              }
                   
        }
  
        $this->view('customers/edit_profile', $data);
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
   
    public function complains(){
    
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
          'name' => trim($_POST['name']),
          'contact_no' => trim($_POST['contact_no']),
          'region' => trim($_POST['region']),
          'subject' => trim($_POST['subject']),
          'complain' => trim($_POST['complain']),
          'name_err' => '',
          'contact_no_err' => '',
          'region_err' => '',
          'subject_err' => '' ,
          'complain_err' => '' ,
          'completed'=>''    
        ];
        
        if($data['completed']=='True'){
          $data['completed']=='';
          $this->view('customers/complains', $data);
        }

        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }
       
        // Validate Password
        if(empty($data['contact_no'])){
          $data['contact_no_err'] = 'Please enter contact no';
        }

        if(empty($data['region'])){
          $data['region_err'] = 'Please enter region';
        } 
        
        if(empty($data['subject'])){
          $data['subject_err'] = 'Please enter subject';
        }
        
        if(empty($data['complain'])){
          $data['complain_err'] = 'Please enter the complain';
        }

        if(empty($data['name_err']) && empty($data['contact_no_err']) && empty($data['region_err']) && empty($data['subject_err']) && empty($data['complain_err']) ){
          if($this->customer_complain_Model->complains($data)){
            $data['completed']="True";
            $this->view('customers/complains', $data);
           
          } else {
            die('Something went wrong');
          }
        }
        else{     
              $this->view('customers/complains', $data);         
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
        $this->view('customers/complains', $data);
      }
     
    }

    private function getCommonData() {
      $centers = $this->center_model->getallCenters();
      return [
          'centers' => $centers,
          'name' => '',
          'contact_no' => '',
          'date' => '',
          'time' => '',
          'region' => '',
          'instructions' => '',
          'name_err' => '',
          'contact_no_err' => '',
          'date_err' => '',
          'time_err' => '',
          'region_err' => '',
          'instructions_err' => '',
          'lattitude'=>'',
          'longitude'=>'',
          'location_err'=>'',
          'location_success'=>'',
          'confirm_collect_pop'=>'',
          'success'=>'' ,
          'customer_id'=>'',
          'region_success'=>''];
    }

    public function request_collect(){
      $id=$_SESSION['user_id']; 
      $user=$this->customerModel->get_customer($id);

      $data['contact_no']=$user->mobile_number;
      $data['name'] =$_SESSION['user_name'];
      
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $centers = $this->center_model->getallCenters();
        $data = $this->getCommonData();
        $data['name'] = trim($_POST['name']);
        $data['contact_no'] = trim($_POST['contact_no']);
        $data['date'] = trim($_POST['date']);
        $data['time'] = trim($_POST['time']);
        $data['instructions'] = trim($_POST['instructions']);
        $data['lattitude'] =trim($_POST['latitude']);
        $data['longitude'] =trim($_POST['longitude']);
        $data['region'] =trim($_POST['center']);
        $data['region_success'] =trim($_POST['region_success']);
        $data['location_success'] =trim($_POST['location_success']);

        if (empty($data['name'])) {
           $data['name_err'] = 'Name is required';
        }elseif (strlen($data['name']) > 30) {
          $data['name_err'] = 'Name cannot exceed 30 characters';
        }
      
        if (empty($data['contact_no'])) {
           $data['contact_no_err'] = 'Contact No is required';
        } elseif (!preg_match('/^\d{10}$/', $data['contact_no'])) {
          $data['contact_no_err'] = 'Invalid Contact No';
        }


        if (empty($data['date'])) {
          $data['date_err'] = 'Date is required';
        } else {
          $selectedTimestamp = strtotime($data['date']);
          $currentTimestamp = strtotime('tomorrow');
          if ($selectedTimestamp < $currentTimestamp) {
            $data['date_err'] = 'Select a date from tomorrow onwards';
          }
        }
    
        if ($data['region_success']='True') {
           if ($data['location_success'] == 'Success') {
               
            }
           else{ 
            $data['location_err'] = 'Location Error';     
          }
        }

        if (empty($data['instructions'])) {
          $data['instructions_err'] = 'Instructions is required';
          } elseif (strlen($data['instructions']) > 100) {
           $data['instructions_err'] = 'Instructions cannot exceed 100 characters';
        }
    

       

        if(empty($data['name_err']) && empty($data['contact_no_err']) && empty($data['date_err']) && empty($data['time_err']) && empty($data['instructions_err'])&& empty($data['location_err']) ){     
            $data['confirm_collect_pop']="True";        
            $this->view('customers/request_collect', $data);   
        }
        else{
          $this->view('customers/request_collect', $data);
        }        
      }
     else {
         $data = $this->getCommonData();
         $id=$_SESSION['user_id']; 
         $user=$this->customerModel->get_customer($id);
         $data['contact_no']=$user->mobile_number;
         $data['name'] =$_SESSION['user_name'];
         $this->view('customers/request_collect', $data);
      }
    }

    public function request_confirm(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = $this->getCommonData();
      $data['name'] = trim($_POST['name']);
      $data['contact_no'] = trim($_POST['contact_no']);
      $data['date'] = trim($_POST['date']);
      $data['time'] = trim($_POST['time']);
      $data['instructions'] = trim($_POST['instructions']);
      $data['lattitude'] =trim($_POST['latitude']);
      $data['longitude'] =trim($_POST['longitude']);
      $data['region'] =trim($_POST['center']);
      $data['success']='True';
      $data['customer_id']=$_SESSION['user_id'];

      $this->Request_Model->request_insert($data);

      $this->view('customers/request_collect', $data);
      }
      else{
        $data=$this->getCommonData();
        $this->view('customers/request_collect', $data);
      }
    }

    public function request_mark_map(){
       
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $centers = $this->center_model->getallCenters();
      $data = $this->getCommonData();
      $data['name'] = trim($_POST['name']);
      $data['contact_no'] = trim($_POST['contact_no']);
      $data['date'] = trim($_POST['date']);
      $data['time'] = trim($_POST['time']);
      $data['instructions'] = trim($_POST['instructions']);
      $data['lattitude'] =trim($_POST['latitude']);
      $data['longitude'] =trim($_POST['longitude']);
      $data['region'] =trim($_POST['center']);
      $data['location_success']='Success';
     
      $data['region_success']='True';

      $this->view('customers/request_collect', $data);
         
     }
     else {
       $data = $this->getCommonData();
       $this->view('customers/request_collect', $data);
     }
    }
    
    public function get_region(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  $centers = $this->center_model->getallCenters();
        $data = $this->getCommonData();
        $data['name'] = trim($_POST['name']);
        $data['contact_no'] = trim($_POST['contact_no']);
        $data['date'] = trim($_POST['date']);
        $data['time'] = trim($_POST['time']);
        $data['instructions'] = trim($_POST['instructions']);
        $data['lattitude'] =trim($_POST['latitude']);
        $data['longitude'] =trim($_POST['longitude']);
        $data['region'] =trim($_POST['center']); 
        $data['region_success']='True';
       
        $center=$this->center_model->findCenterbyRegion( $data['region']);
        $data['lattitude']=$center->lat;
        $data['longitude']=$center->longi; 
        
        $this->view('customers/request_collect', $data);

      }
    }
    
    public function credit_per_waste(){
       $credit= $this->creditModel->get();
      $data = [
        'eco_credit_per'=>$credit
      ];
      $this->view('customers/credits_per_waste', $data);
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }

    public function transfer() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
              'customer_id' => trim($_POST['customer_id']),
              'credit_amount' => trim($_POST['credit_amount']),
  
              'customer_id_err' => '',
              'credit_amount_err' => '',
              'completed' => ''
          ];
  
  
           // Extract numeric part from the user input
           $numeric_part = preg_replace('/[^0-9]/', '', $data['customer_id']);
           // Convert extracted numeric part to an integer
           $customer_id = (int)$numeric_part;
  
          /* if (empty($data['customer_id'])) {
            $data['customer_id_err'] = 'Please enter customer id';
        } else {
            if ($customer_id === $_SESSION['user_id']) {
                $data['customer_id_err'] = 'You cannot transfer credits to yourself';
            } else {
                // Check if the user input matches the required format
                if (!preg_match('/^C\s*\d+(\s+\d+)*$/i', $data['customer_id'])) {
                    $data['customer_id_err'] = "Customer ID should be in the format 'C xxx' or 'Cxxx'";
                } elseif (!$this->customerModel->get_customer($customer_id)) {
                    $data['customer_id_err'] = 'Customer ID does not exist';
                }
            }
        }*/
  
          if (empty($data['customer_id'])) {
              $data['customer_id_err'] = 'Please enter customer id';
          } else {
                if(!preg_match('/^C\s*\d+(\s+\d+)*$/i', $data['customer_id'])) {
                    $data['customer_id_err'] = "Customer ID should be in the format 'C xxx' or 'Cxxx'";
                } elseif($customer_id === $_SESSION['user_id']) {
                    $data['customer_id_err'] = 'You cannot transfer credits to yourself';
                } else {
              // Check if the user input matches the required format
                    if (!$this->customerModel->get_customer($customer_id)) {
                          $data['customer_id_err'] = 'Customer ID does not exist';
                    }
                }
          }
      
        
  
  
          if (empty($data['credit_amount']) || $data['credit_amount'] <= 0) {
            $data['credit_amount_err'] = 'Please enter a credit amount greater than 0';
        } elseif (!filter_var($data['credit_amount'], FILTER_VALIDATE_FLOAT)) {
            $data['credit_amount_err'] = 'Credit amount should be a valid number';
        } else {
            $user_balance = $this->Customer_Credit_Model->get_customer_credit_balance($_SESSION['user_id']);
            if ($data['credit_amount'] > $user_balance) {
                $data['credit_amount_err'] = 'Transfer amount cannot exceed your available credit balance';
            }
        }
  
  
        
          if (empty($data['customer_id_err']) && empty($data['credit_amount_err'])) {
            $sender_id = $_SESSION['user_id'];
            $receiver_id = $customer_id;
            $transfer_amount = $data['credit_amount'];
  
            $sender_balance = $this->Customer_Credit_Model->get_customer_credit_balance($sender_id);
            $receiver_balance = $this->Customer_Credit_Model->get_customer_credit_balance($receiver_id);

        
            if ($transfer_amount <= $sender_balance) {
               
                $new_sender_balance = $sender_balance - $transfer_amount;
                $new_receiver_balance = $receiver_balance + $transfer_amount;
                $sender_update = $this->Customer_Credit_Model->update_credit_balance($sender_id, $new_sender_balance);
                $receiver_update = $this->Customer_Credit_Model->update_credit_balance($receiver_id, $new_receiver_balance);
                $receiver =$this->customerModel->get_customer($receiver_id);
                $receiver_image= $receiver->image;
                $sender=$this->customerModel->get_customer($sender_id);
                $sender_image= $sender->image;
                $date = date('Y-m-d'); // Current date
                $time = date('H:i:s'); // Current time
                $result = $this->Customer_Credit_Model->record_credit_transfer($sender_id,$sender_image, $receiver_id, $receiver_image, $date, $time, $transfer_amount);
        
                if ($sender_update && $receiver_update && $result) {
                    $data['completed'] = 'True';
                    $this->view('customers/transfer', $data);
                } else {
                  die('Something went wrong');
                }
            } else {
                $data['credit_amount_err'] = 'Transfer amount exceeds available credit balance';
            }
          } else {
              $this->view('customers/transfer', $data);
          }
  
          }else {
            $data = [
              'customer_id' => '',
              'credit_amount' => '',
              'customer_id_err' => '',
              'credit_amount_err' => '',
              'completed' => ''
          ];
  
          $this->view('customers/transfer', $data);
      }
       }

       
}
  ?>