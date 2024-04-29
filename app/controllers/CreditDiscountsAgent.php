<?php
  class CreditDiscountsAgent extends Controller {
    public function __construct(){
      $this->User_Model=$this->model('User');
      $this->discount_agentModel=$this->model('Discount_Agent');
      $this->customerModel=$this->model('Customer'); 
      $this->Customer_Credit_Model=$this->model('Customer_Credit'); 
      if(!isLoggedIn('agent_id')){
        redirect('users/login');
      }
    }


    public function index(){
      $discounts=$this->discount_agentModel->getDiscountByAgent($_SESSION['agent_id']);
      $id=$_SESSION['agent_id']; 
      $agent_by_id = $this->discount_agentModel->getDiscountAgentByID($id);
      
      $data = [
        'discounts'=>$discounts,
        'balance'=>$agent_by_id->credits
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
              $this->discount_agentModel->editprofile_withimg($data);
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
        $data['email']=$_SESSION['agent_email']; 

  
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


    public function validateUser($success="") {   

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
              'customer_id' => trim($_POST['customer_id']),
              'customer_id_err' => '',
              'success'=>$success
          ];
  
  
          $numeric_part = preg_replace('/[^0-9]/', '', $data['customer_id']);
          $customer_id = (int) $numeric_part;
          
          
          if (empty($numeric_part)) {
              $data['customer_id_err'] = 'Please enter customer id';
          } else {
            if(!preg_match('/^\d{1,10}$/', $data['customer_id'])) {
              $data['customer_id_err'] = "Use only Maximum 10 digits";
            }  else {
                  // Check if the user input matches the required format
                  if (!$this->customerModel->get_customer($customer_id)) {
                      $data['customer_id_err'] = 'Customer ID does not exist';
                  }
                  else{
                    header("Location: " . URLROOT . "/CreditDiscountsAgent/validateUser/True");        

                  }
              }
          }
          
    
  
  
   

          $this->view('credit_discount_agents/discount_agent_validateUser', $data);
  
          }else {
            $data = [
              'customer_id' => '',
              'customer_id_err' => '',  
              'success'=>$success
 
          ];
  
          $this->view('credit_discount_agents/discount_agent_validateUser', $data);
      }
    }

    public function balance_validation($success="") {     
      $agent=$this->discount_agentModel->getDiscountAgentByID2($_SESSION['agent_id']);

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
              'customer_id' => trim($_POST['customer_id']),
              'discount_amount' => trim($_POST['discount_amount']),
              'center' => trim($_POST['center']),
              'customer_id_err' => '',
              'center_err' => '',
              'discount_amount_err' => '',
              'success'=>$success
          ];
          

          if (empty($data['center'])) {
            $data['center_err'] = 'Please enter branch name';
          }
  
          $numeric_part = preg_replace('/[^0-9]/', '', $data['customer_id']);
          $customer_id = (int) $numeric_part;
          
          
          if (empty($numeric_part)) {
              $data['customer_id_err'] = 'Please enter customer id';
          } else {
            if(!preg_match('/^\d{1,10}$/', $data['customer_id'])) {
              $data['customer_id_err'] = "Use only Maximum 10 digits";
            }  else {
                  // Check if the user input matches the required format
                  if (!$this->customerModel->get_customer($customer_id)) {
                      $data['customer_id_err'] = 'Customer ID does not exist';
                  }
              }
          }
              
          if (empty($data['discount_amount']) || $data['discount_amount'] <= 0) {
            $data['discount_amount_err'] = 'Please enter a discount amount greater than 0';
        } elseif (!filter_var($data['discount_amount'], FILTER_VALIDATE_FLOAT)) {
            $data['discount_amount_err'] = 'discount amount should be a valid number';
          } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $data['discount_amount'])) {
            $data['discount_amount_err'] = 'please enter up to 2 decimal places';
        }        
         else {
            $user_balance = $this->Customer_Credit_Model->get_customer_credit_balance( $customer_id);
           
            if ($data['discount_amount'] > $user_balance) {
                $data['discount_amount_err'] = 'discount can not exceed your credit balance';
            }
            if($data['discount_amount']> $agent->credits){
              $data['discount_amount_err'] = 'Insuffients Credit balance to give discounts';

            }
        }
  
  
        if (empty($data['customer_id_err']) && empty($data['discount_amount_err']) && empty($data['center_err'])) {
          $discount_amount = floatval($data['discount_amount']);
          $user_balance = floatval($this->Customer_Credit_Model->get_customer_credit_balance($customer_id));

          if ($discount_amount <= $user_balance) {
              $new_balance = $user_balance - $discount_amount;
              $balance_update = $this->Customer_Credit_Model->update_credit_balance($customer_id, $new_balance);
              $customer = $this->customerModel->get_Cus_all_details($customer_id);
              $customer_name = $customer->name;
              $dicount_agent_balance=$agent->credits-$data['discount_amount'];

              if ($balance_update) {
                  $insert_discount = $this->discount_agentModel->addDiscount(
                      $customer_id,
                      $customer_name,
                      $discount_amount,
                      $data['center'],
                      $_SESSION['agent_id'],
                      $dicount_agent_balance
                  );
                  
                  if ($insert_discount) {
                      header("Location: " . URLROOT . "/CreditDiscountsAgent/balance_validation/True");        

                  } else {
                    
                    $this->view('credit_discount_agents/agent_discount', $data);
                  }
              } else {
                  $this->view('credit_discount_agents/agent_discount', $data);
                }
          } else {
              $data['credit_amount_err'] = 'Transfer amount exceeds available credit balance';
              $this->view('credit_discount_agents/agent_discount', $data);
          }
        } else {
            $this->view('credit_discount_agents/agent_discount', $data);
        }
  
          }else {
            $data = [
              'customer_id' => '',
              'discount_amount' => '',
              'center' => '',
              'customer_id_err' => '',
              'discount_amount_err' => '',
              'center_err' => '',
              'success'=>$success
          ];
          

          $this->view('credit_discount_agents/agent_discount', $data);
      }
    }

    public function history(){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data=[];

        $this->view('credit_discount_agents/history', $data);

      }
      else{
      $discounts=$this->discount_agentModel->getDiscountByAgent($_SESSION['agent_id']);

      $data = [
        'discounts'=>$discounts
      ];
        $this->view('credit_discount_agents/history', $data);
      }
    }
    

}