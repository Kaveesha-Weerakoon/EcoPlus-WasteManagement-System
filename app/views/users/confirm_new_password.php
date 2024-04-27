<?php 
    if(empty($_GET['selector']) || empty($_GET['validator'])){
        echo 'Could not validate your request!';
    }else{
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];
        
        if(ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>

<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="ConfirmPassword-main">

    <div class="container">
        <img src="<?php echo IMGROOT;?>/undraw_secure_files_re_6vdh.svg" class="image" alt="">

        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo URLROOT; ?>/ResetPassword/resetPassword" class="sign-in-form" method="POST">

                    <input type="hidden" name="selector" value="<?php echo $selector ?>" />
                    <input type="hidden" name="validator" value="<?php echo $validator ?>" />
                    <div class="otp_err" name="otp_err" style="color: red;"></div>

                    <div class="top"> <img src="<?php echo IMGROOT;?>/Logo.png" alt="">
                        <h2>Forgot Your Password ?</h2>
                    </div>
                    <div class="slogan">Reset Your Password</div>
                    <div class="line"></div>

                    <div class="input-field-container">
                    <p>New Password : </p>
                        <div class="input-fieldlog">
                        <i class="fas fa-envelope icon"></i>
                            <input id="pwd" name="pwd" placeholder="Enter a new password..." class="form-control" type="password" value="">
                        </div>
                        <div class="errlog" style="color:red">
                            <?php echo $data['pwd_err']?>
                        </div>
                    </div>
                    <div class="input-field-container">
                    <p>Confirm New Password : </p>
                        <div class="input-fieldlog">
                        <i class="fas fa-envelope icon"></i>
                            <input id="pwd_repeat" name="pwd_repeat" placeholder="Repeat new password..." class="form-control" type="password" value="">
                        </div>
                        <div class="errlog" style="color:red">
                            <?php echo $data['pwd_repeat_err']?>
                        </div>
                    </div>
                    <!-- <input name="recover-submit" class="btn solid" value="Reset Password" type="submit"> -->
                    <button type="submit" name="get_email_button" class="btn solid">Submit</button>

                </form>

                

            </div>
        </div>
    </div>
</div>
    <!-- <h1 class="header">Enter New Password</h1>

    

    <form method="post" action="<?php echo URLROOT; ?>/ResetPassword/resetPassword">
        
        <input type="hidden" name="selector" value="<?php echo $selector ?>" />
        <input type="hidden" name="validator" value="<?php echo $validator ?>" />
        <div class="otp_err" name="otp_err" style="color: red;"></div>
        <input type="password" name="pwd" 
        placeholder="Enter a new password...">
        <div class="err" value="<?php echo $data['pwd_err']; ?>"></div>
        <input type="password" name="pwd_repeat" 
        placeholder="Repeat new password...">
        <div class="err" value="<?php echo $data['pwd_repeat_err']; ?>"></div>
        <button type="submit" name="submit">Submit</button>
    </form> -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
            
<?php 
    }else{
        echo 'Could not validate your request!';
    }
}
?>
    