<?php
  class Pages extends Controller {
    public function __construct(){
      $this->announcementModel = $this->model('Announcement');
      $this->mailSubscriptionsModel = $this->model('Mail_Subscriptions');
    }
    
    public function index(){
      $announcements = $this->announcementModel->getAllAnnouncements();


      $data = [
        'announcements' => $announcements,
        'title' => 'TraversyMVC',
        'name' => '',
        'email' => '',
        'name_err' => '',
        'email_err' => '',
        'success' => ''
      ];
     
      $this->view('pages/index', $data);
    }

    public function announcement_view(){
      $announcements = $this->announcementModel->getAllAnnouncements();

      $data = [
        'announcements' => $announcements
       
      ];
     
      $this->view('pages/announcements_view', $data);

    }

    public function mail_subscriptions(){
      $announcements = $this->announcementModel->getAllAnnouncements();

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'announcements' => $announcements,
          'name_err' => '',
          'email_err' => '',
          'success' => ''

        ];

        if(empty($data['name'])){
          $data['name_err'] = "Please enter your name";
        }elseif(strlen($data['name']) > 255){
          $data['name_err'] = "Name is too long";
        }

        if(empty($data['email'])){
          $data['email_err'] = 'Please enter an email';
        } else {
           
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = 'Invalid email format';
            } else {
                
                if(strlen($data['email']) > 255) { 
                    $data['email_err'] = 'Email is too long';
                } 
            }
        }

        if(empty($data['name_err']) && empty($data['email_err'])){
          if($this->mailSubscriptionsModel->save_subscription($data)){
            $data['success'] = 'True';
            header("Location: " . URLROOT . "/pages/index#contact");
          

          }else{
            die('something went wrong');
          }

        }

        $this->view('pages/index', $data);



      }else{

        $data = [
          'name' => '',
          'email' => '',
          'name_err' => '',
          'email_err' => '',
          'success' => '',
          'announcements' => $announcements,

        ];

      }

      $this->view('pages/index', $data);
    }

   
  }