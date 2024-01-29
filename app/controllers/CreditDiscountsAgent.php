<?php
  class CreditDiscountsAgent extends Controller {
    public function __construct(){
      $this->User_Model=$this->model('User');
      $this->discount_agentModel=$this->model('Discount_Agent');

   
        
    }


    public function index(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('credit_discount_agents/index', $data);
    }



    public function logout(){
      unset($_SESSION['agent_id']);
      unset($_SESSION['agent_email']);
      unset($_SESSION['agent_name']);
      session_destroy();
      redirect('users/login');
    }




    public function editprofile(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id=$_SESSION['agent_id']; 
        $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($id);

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data=[
          'name'=>trim($_POST['name']),
         'email'=>trim($_POST['email']),
         'profile_image_name' => $_SESSION['agent_email'].'_'.$_FILES['profile_image']['name'],
         'contactno'=>trim($_POST['contactno']),
         'address'=>trim($_POST['address']),
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
                $this->discount_agentModel->editprofile($data);
                $data['success_message']="Profile Details Updated Successfully";
                $data['change_pw_success']='True';
                $data['profile_err'] = '';
           } else {
             $old_image_path = 'C:/xampp/htdocs/ecoplus/public/img/img_upload/credit_discount_agent/' .$agent_by_id->image;    
            if (updateImage($old_image_path, $_FILES['profile_image']['tmp_name'], $data['profile_image_name'], '/img/img_upload/credit_discount_agent/')) {
              $this->collectorModel->editprofile_withimg($data);
              $data['success_message']="Profile Details Updated Successfully";
              $data['change_pw_success']='True';
              $data['profile_err'] = '';
            
            } else {
                $data['profile_err'] = 'Error uploading the profile image';
                $this->view('credit_discount_agents/editprofile', $data); 
            }
            
          }
        }

        $this->view('credit_discount_agents/editprofile', $data);
       }
       else{ 

        $data=['name'=>'',
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
        'success_message'=>''];

        $id=$_SESSION['agent_id']; 
        $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($id);
        $data['name']=$_SESSION['agent_name'];
        $data['contactno']=$agent_by_id->contact_no;
        $data['address']=$agent_by_id->address;      
        $data['email']=$_SESSION['agent_email'];

        $this->view('credit_discount_agents/editprofile', $data);
       }
  
   
    }




    public function change_password(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); $data=[
          'name'=>'',
          'email'=>'',
          'contactno'=>'',
          'address'=>'',
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
          'success_message'=>''
        ];
  
  
        $id=$_SESSION['agent_id']; 
        $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($id);
        $data['name']=$_SESSION['agent_name'];
        $data['contactno']=$agent_by_id->contact_no;
        $data['address']=$agent_by_id->address; 
     
  
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
           
              if($this->User_Model->pw_check($_SESSION['agent_id'],$data['current'])){
                if($data['new_pw']!=$data['re_enter_pw']){
                  $data['new_pw_err'] = 'Passwords Does not match';
                }
                else{
                  if($this->User_Model->change_pw($_SESSION['agent_id'],$data['re_enter_pw'])){
                    $data['success_message']="Password Changed Successfully";
                    $data['change_pw_success']='True';
                    $this->view('credit_discount_agents/editprofile', $data);
                  }
                }
              }
              else{
                $data['current_err'] = 'Invalid Password';
              }
                   
        }
  
        $this->view('credit_discount_agents/editprofile', $data);
        }
        else{
          $data = [
            'name'=>'',
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
            'success_message'=>''
  
  
          ];
          $this->view('credit_discount_agents/editprofile', $data);
  
        }
  
     }


   public function validateUser(){
      $data = [
        'title' => 'TraversyMVC',
      ];
     
      $this->view('credit_discount_agents/discount_agent_validateUser', $data);
    }



}