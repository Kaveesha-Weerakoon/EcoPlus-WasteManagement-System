<?php
  class Pages extends Controller {
    public function __construct(){
      $this->announcementModel = $this->model('Announcement');
     
    }
    
    public function index(){
      $announcements = $this->announcementModel->getAllAnnouncements();


      $data = [
        'announcements' => $announcements,
        'title' => 'TraversyMVC',
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

   
  }