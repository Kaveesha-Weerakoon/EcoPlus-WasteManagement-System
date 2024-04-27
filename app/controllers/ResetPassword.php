<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require APPROOT. '/PHPMailer/vendor/autoload.php';

class ResetPassword extends Controller {
  
    private $mail;
    
    public function __construct(){
        $this->userModel=$this->model('User');
        $this->resetPasswordModel=$this->model('Reset_Password');
      
        //Setup PHPMailer
        // $this->mail = new PHPMailer();
        // $this->mail->isSMTP();
        // $this->mail->Host = 'sandbox.smtp.mailtrap.io';
        // $this->mail->SMTPAuth = true;
        // $this->mail->Port = 2525;
        // $this->mail->Username = 'f4ab65cd067d1f';
        // $this->mail->Password = '111c78b575960b';
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587;
        $this->mail->Username = 'ecoplusgroupproject@gmail.com';
        $this->mail->Password = 'zzruvawrzshhafbk';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth = true;

    }

    public function goto_resetpassword(){

        $data = [
            'email' => '',
            'email_err' => ''       
        ];
        $this->view('users/resetpassword', $data);
        // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        //     // Init data
        //     $data = [
        //         'email' => trim($_POST['email']),
        //         'email_err' => ''    
        //     ];
    
        //     // Validate Email
        //     if(empty($data['email'])){
        //         $data['email_err'] = 'Please enter email';
        //     } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        //         $data['email_err'] = 'Invalid email format';
        //     } elseif(!$this->userModel->findUserByEmail($data['email'])){
        //         // User not found
        //         $data['email_err'] = 'User not found';
        //     }
    
        //     $this->view('users/resetpassword', $data);
        // } else {
        //     // Init data
        //     $data = [
        //         'email' => '',
        //         'email_err' => ''       
        //     ];
        //     $this->view('users/resetpassword', $data);
        // }
    }
  

    public function sendEmail(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => ''    
            ];
    
            // Validate Email
            // if(empty($data['email'])){
            //     $data['email_err'] = 'Please enter email';
            // } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            //     $data['email_err'] = 'Invalid email format';
            // } elseif(!$this->userModel->findUserByEmail($data['email'])){
            //     // User not found
            //     $data['email_err'] = 'User not found';
            // }

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
                        if(!($this->userModel->findUserByEmail($data['email']))){
                            $data['email_err'] = 'User not found';
                        }
                    }
                }
            }


            if(empty($data['email_err'])){

                $usersEmail = $data['email'];

                //Will be used to query the user from the database
                $selector = bin2hex(random_bytes(8));
                //Will be used for confirmation once the database entry has been matched
                $token = random_bytes(32);
                //URL will vary depending on where the website is being hosted from
                $url = 'http://localhost/ecoplus/ResetPassword/resetPassword?selector='.$selector.'&validator='.bin2hex($token);
                
                //Expiration date will last for half an hour
                $expires = date("U") + 1800;
                if(!$this->resetPasswordModel->deleteEmail($usersEmail)){
                    die("There was an error");
                }
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                if(!$this->resetPasswordModel->insertToken($usersEmail, $selector, $hashedToken, $expires)){
                    die("There was an error");
                }
                //Can Send Email Now
                $subject = "Reset your password";
                $message = "<p>We recieved a password reset request.</p>";
                $message .= "<p>Here is your password reset link: </p>";
                $message .= "<a href='".$url."'>".$url."</a>";
    
                $this->mail->setFrom('ecoplusgroupproject@gmail.com');
                $this->mail->isHTML(true);
                $this->mail->Subject = $subject;
                $this->mail->Body = $message;
                $this->mail->addAddress($usersEmail);
    
                
                if (!$this->mail->send()) {
                    echo 'Error sending email: ' . $this->mail->ErrorInfo;
                } else {
                    echo "Please check your emails for the password reset link.";
                }


            }else{
                $this->view('users/resetpassword', $data);

            }

            //$this->view('users/resetpassword', $data);
        } else {
            // Init data
            $data = [
                'email' => '',
                'email_err' => ''       
            ];
            $this->view('users/resetpassword', $data);
        }


       
    }

    public function resetPassword(){
        //Sanitize POST data

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'selector' => trim($_POST['selector']),
                'validator' => trim($_POST['validator']),
                'pwd' => trim($_POST['pwd']),
                'pwd_repeat' => trim($_POST['pwd_repeat']),
                'pwd_err' => '',
                'pwd_repeat_err' => '',
                'otp_err'=> ''
            ];

            // if(empty($_POST['pwd'] || $_POST['pwd_repeat'])){
            //     $data['pwd_err'] ='Please enter password';
            //     $data['pwd_repeat_err'] ='Please enter password';
            // }else if($data['pwd'] != $data['pwd_repeat']){
            //     $data['pwd_repeat_err'] = 'Passwords do not match';
            // }else if(strlen($data['pwd']) < 6 || strlen($data['pwd_repeat']) < 6){
            //     $data['pwd_err'] ='Invalid password';
            //     $data['pwd_repeat_err'] ='Invalid password';
            // }

            if (empty($data['pwd'])) {
                $data['pwd_err'] = 'Please Enter New Password';
            } elseif (strlen($data['pwd']) < 8 || strlen($data['pwd']) > 30) {
                $data['pwd_err'] = 'New password must be 8-30 characters long';

            } elseif (!preg_match('/[^\w\s]/', $data['pwd'])) {
                $data['pwd_err'] = 'New password must include at least one symbol';

            } elseif (!preg_match('/[A-Z]/', $data['pwd'])) {
                $data['pwd_err'] = 'New password must include at least one uppercase letter';

            } elseif (!preg_match('/[a-z]/', $data['pwd'])) {
                $data['pwd_err'] = 'New password must include at least one lowercase letter';

            }elseif (!preg_match('/[0-9]/', $data['pwd'])) {
            $data['pwd_err'] = 'New password must include at least one number';
            }

            if (empty($data['pwd_repeat'])) {
                $data['pwd_repeat_err'] = 'Please Enter New Password';
            } elseif (strlen($data['pwd_repeat']) < 8 || strlen($data['pwd_repeat']) > 30) {
                $data['pwd_repeat_err'] = 'New password must be 8-30 characters long';

            } elseif (!preg_match('/[^\w\s]/', $data['pwd_repeat'])) {
                $data['pwd_repeat_err'] = 'New password must include at least one symbol';

            } elseif (!preg_match('/[A-Z]/', $data['pwd_repeat'])) {
                $data['pwd_repeat_err'] = 'New password must include at least one uppercase letter';

            } elseif (!preg_match('/[a-z]/', $data['pwd_repeat'])) {
                $data['pwd_repeat_err'] = 'New password must include at least one lowercase letter';

            }elseif (!preg_match('/[0-9]/', $data['pwd_repeat'])) {
                $data['pwd_repeat_err'] = 'New password must include at least one number';
            }

            if($data['pwd'] != $data['pwd_repeat']){
                $data['pwd_repeat_err'] = 'Passwords do not match';

            }

            if(empty($data['pwd_err']) && empty($data['pwd_repeat_err']) && empty($data['selector']) && empty($data['validator']) ){


            }else{

                $url = 'app/views/users/confirm_new_password.php?selector='.$data['selector'].'&validator='.$data['validator'];

                $currentDate = date("U");
                if(!$row = $this->resetPasswordModel->resetPassword($data['selector'], $currentDate)){
                    // flash("newReset", "Sorry. The link is no longer valid");
                    // redirect($url);
                    $data['otp_err'] = "Sorry. The link is no longer valid";
                    $this->view('users/confirm_new_password/.$url.', $data);
                  


                }
    
                $tokenBin = hex2bin($data['validator']);
                $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);
                if(!$tokenCheck){
                    //flash("newReset", "You need to re-Submit your reset request");
                    $data['otp_err'] = "You need to re-Submit your reset request";
                    redirect($url);
                }
    
                $tokenEmail = $row->pwdResetEmail;
                if(!$this->userModel->findUserByEmailOrUsername($tokenEmail, $tokenEmail)){
                    //flash("newReset", "There was an error");
                    $data['otp_err'] = "There was an error";
                    redirect($url);
                }
    
                $newPwdHash = password_hash($data['pwd'], PASSWORD_DEFAULT);
                if(!$this->userModel->resetPassword($newPwdHash, $tokenEmail)){
                    //flash("newReset", "There was an error");
                    $data['otp_err'] = "There was an error";
                    redirect($url);
                }
    
                if(!$this->resetPasswordModel->deleteEmail($tokenEmail)){
                    //flash("newReset", "There was an error");
                    $data['otp_err'] = "There was an error";
                    redirect($url);
                }
    
                //flash("newReset", "Password Updated", 'form-message form-message-green');
                $data['otp_err'] = "Password Updated";
                redirect($url);
                $this->view('users/confirm_new_password', $data);
            }


        }else{

            $data = [
                'pwd' => '',
                'pwd_repeat' => '',
                'pwd_err' => '',
                'pwd_repeat_err' => '',
                'otp_err'=> ''

            ];

            $this->view('users/confirm_new_password', $data);
        }
       
       

        

        

        
    }
}

