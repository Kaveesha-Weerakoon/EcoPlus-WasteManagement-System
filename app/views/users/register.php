<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Register-main">
<div class="main">
            <div class="main-left">
                <div class="top">
                    <div class="slogan">Join with Us</div>
                    <img src="<?php echo IMGROOT ?>/Logo_No_Background.png" class="logo" alt="">
                </div>
                <form action="<?php echo URLROOT;?>/users/register" method="post">
                
                <div class="fields">
                  <input type="text" name="name" placeholder="Enter Your Name" value="<?php echo $data['name']; ?>">
                  <span class="error_span"><?php echo $data['name_err']?></span>
                 
                  <input type="text" name="email" placeholder="Enter Your Email" value="<?php echo $data['email']; ?>">
                  <span class="error_span"><?php echo $data['email_err']?></span>

                  <input type="text" name="contact_no" placeholder="Enter Your Contact Number" value="<?php echo $data['contact_no']; ?>">
                  <span class="error_span"><?php echo $data['contact_no_err']?></span>
                 
                  <input type="text" name="address" placeholder="Enter Your Address" value="<?php echo $data['address']; ?>">
                  <span class="error_span"><?php echo $data['address_err']?></span>

                  <input type="text" name="city" placeholder="Enter Your City" value="<?php echo $data['city']; ?>">
                  <span class="error_span"><?php echo $data['city_err']?></span>
                  
                  <input type="password" name="password" placeholder="Password" value="<?php echo $data['password']; ?>" >
                  <span class="error_span"><?php echo $data['password_err']?></span>

                  <input type="password" name="confirm_password"placeholder="Re Enter Password" value="<?php echo $data['confirm_password']; ?>">
                  <span class="error_span"><?php echo $data['confirm_password_err']?></span>

                </div>
                
                <div class="buttton">
                    <button type="submit">Sign Up</button>
                </div>
                <div class="have">
                   <a href="<?php echo URLROOT?>/users/login">Have an account? <b>Login</b></a>
                </div>
                </form>

            </div>
            <div class="main-right">
                <img src="<?php echo IMGROOT ?>/Register.png" class="image" alt="">
            </div>
</div>
</div></div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

