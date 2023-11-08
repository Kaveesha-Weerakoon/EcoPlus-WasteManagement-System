<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Login-main">
   <main class="main">
            <div class="main-left">
            </div>
            <img class="login-image" src="<?php echo IMGROOT;?>/Login.png" alt="">
            <div class="main-right">
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="login-component">
                    <div class="image" style="background-image: url('<?php echo IMGROOT;?>/Logo.png');"></div>
                    <div class="login">Login</div>
                    <div class="slogan"> Sign into your account</div>
                    <div class="line"></div>
                    <div class="field">
                        <input type="text" name="email" placeholder="Email" id="" class="<?php echo (!empty($data['email_err'])) ? 'alert_empty' : ''; ?>" value="<?php echo $data['email']; ?>">          
                    </div> 
                    <div class="field-two">
                        <p><?php echo $data['email_err']?></p>
                    </div>
                                   
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" id="" class="<?php echo (!empty($data['password_err'])) ? 'alert_empty' : ''; ?>" value="<?php echo $data['password']; ?>">
                    </div> 
                    <div class="field-two">
                        <p><?php echo $data['password_err']?></p>
                    </div>
                                
                    <div class="forgot"><a href="">Forgot your password?</a></div>
                    <button class="login-button">Login</button>
                    <p>Don't have an account? <a href="<?php echo URLROOT?>/users/register"><b>Register</b></a></a></p>
                </div>
                </form>
            </div>

        </main>
</div>
S


<?php require APPROOT . '/views/inc/footer.php'; ?>