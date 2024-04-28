<?php 
    if(empty($data['selector']) || empty($data['validator'])){
        redirect('');
    }else{
        $selector = $data['selector'];
        $validator = $data['validator'];
        
        if(ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>

<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="ConfirmPassword-main">

    <div class="container">
        <img src="<?php echo IMGROOT;?>/undraw_secure_files_re_6vdh.svg" class="image" alt="">

        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo URLROOT; ?>/ResetPassword/resetPassword" class="sign-in-form" method="POST">

                    <input type="hidden" name="selector" value="<?php echo $data['selector'] ?>" />
                    <input type="hidden" name="validator" value="<?php echo $data['validator'] ?>" />
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
                            <input id="pwd" name="pwd" placeholder="Enter a new password..." class="form-control"
                                type="password" value="<?php $data['pwd']?>">
                        </div>
                        <div class="errlog" style="color:red">
                            <?php echo $data['pwd_err']?>
                        </div>
                    </div>
                    <div class="input-field-container">
                        <p>Confirm New Password : </p>
                        <div class="input-fieldlog">
                            <i class="fas fa-envelope icon"></i>
                            <input id="pwd_repeat" name="pwd_repeat" placeholder="Repeat new password..."
                                class="form-control" type="password" value="<?php $data['pwd_repeat']?>">
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
<?php if($data['success']=='True') : ?>
<div class="complain_success">
    <div class="popup" id="popup">
        <img src="<?php echo IMGROOT?>/check.png" alt="">
        <h2>Success!!</h2>
        <p>Password Changed Successfully</p>
        <p>Login to your account</p>

        <a href="<?php echo URLROOT?>/users/login"><button type="button">Login</button></a>


    </div>
</div>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>

<?php 
    }else{
        echo 'Could not validate your request!';
    }
}
?>