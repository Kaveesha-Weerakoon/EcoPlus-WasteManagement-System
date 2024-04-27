<?php
  // Load Config
  require_once 'config/config.php';
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';
  require_once 'helpers/ImageUpload_Helper.php';

  //Require PHP Mailer
  // require_once 'PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
  // require_once 'PHPMailer/vendor/phpmailer/phpmailer/src/Exception.php';
  // require_once 'PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php';

  require_once 'PHPMailer/PHPMailer/src/PHPMailer.php';
  require_once 'PHPMailer/PHPMailer/src/Exception.php';
  require_once 'PHPMailer/PHPMailer/src/SMTP.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
