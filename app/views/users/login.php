<?php require APPROOT . '/views/inc/header.php'; ?>



<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="<?php echo URLROOT; ?>/users/login" class="sign-in-form" method="POST">

                <div class="top"> <img src="<?php echo IMGROOT;?>/Logo.png" alt="">
                    <h1>Sign In</h1>
                </div>
                <div class="slogan"> Sign into your account</div>

                <div class="input-fieldlog">
                    <i class="fas fa-user"></i>
                    <input type="text" class="text" placeholder="Email" name="email"
                        class="<?php echo (!empty($data['email_err'])) ? 'alert_empty' : ''; ?>"
                        value="<?php echo $data['email']; ?>">
                </div>
                <div class="field-two">
                    <p><?php echo $data['email_err']?></p>
                </div>


                <div class="input-fieldlog">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="text" placeholder="Password" name="password"
                        class="<?php echo (!empty($data['password_err'])) ? 'alert_empty' : ''; ?>"
                        value="<?php echo $data['password']; ?>">
                </div>
                <div class="field-two">
                    <p><?php echo $data['password_err']?></p>
                </div>
                <div class="forgot"><a href="<?php echo URLROOT?>/users/resetpassword">Forgot your password?</a></div>

                <input type="submit" value="Login" class="btn solid">


            </form>

            <form action="<?php echo URLROOT;?>/users/register" class="sign-up-form" method="POST"
                enctype="multipart/form-data">
                <div class="top"> <img src="<?php echo IMGROOT?>/Logo.png" alt="">
                    <h1>Sign Up</h1>
                </div>

                <div class="porfile-cont">
                    <input type="file" name="profile_image" class="profile_image" id="profile_image"
                        placeholder="select a profile image">
                    <img src="<?php echo IMGROOT?>./anonymous.png" alt="" class="profile_image_trigger"
                        id="profile_image_trigger">
                    <p>Add a Profile Picture</p>
                </div>

                <div class="cont-main">
                    <div class="cont">
                        <p>Name</p>
                        <div class="input-field">
                            <input type="text" class="text" placeholder="name" value="<?php echo $data['name']; ?>"
                                name="name" id="name">
                        </div>
                    </div>
                    <div class="cont">
                        <p>Email</p>
                        <div class="input-field2">
                            <input type="text" class="text" placeholder="Email"
                                value="<?php echo $data['email_reg']; ?>" name="email_regmail" id="email_regmail">
                        </div>
                    </div>

                </div>

                <div class="cont-main">
                    <div class="cont">
                        <p>Contact No</p>
                        <div class="input-field">
                            <input type="text" class="text" placeholder="contact no"
                                value="<?php echo $data['contact_no']; ?>" name="contact_no" id="contact_no">
                        </div>
                    </div>

                    <div class="cont">
                        <p>Address</p>
                        <div class="input-field2">
                            <input type="text" class="text" placeholder="address"
                                value="<?php echo $data['address']; ?>" name="address" id="address">
                        </div>
                    </div>
                </div>

                <div class="cont-region">
                    <div class="cont">
                        <p>Region</p>
                        <select id="city" name="city" class="city">
                            <?php
                       $centers = $data['centers2'];
                       $regionFound = false;

                       if (!empty($centers)) {
                        foreach ($centers as $center) {
                            echo "<option value=\"$center->region\" >$center->region</option>";
                 }} else {
                    echo "<option value=\"default\">No Centers Available</option>";
                }
                ?>
                        </select>
                    </div>
                </div>

                <div class="cont-main">
                    <div class="cont">
                        <p>Password</p>
                        <div class="input-field">
                            <input type="text" class="text" placeholder="Password" id="password_reg" name="password_reg"
                                value="<?php echo $data['password_reg']; ?>">
                        </div>
                    </div>

                    <div class="cont">
                        <p>Confirm Password</p>
                        <div class="input-field2">
                            <input type="text" class="text" placeholder="confirm Password" id="confirm_password"
                                name="confirm_password" value=" <?php echo $data['confirm_password']; ?>">
                        </div>
                    </div>

                </div>





                <input type="submit" value="sign Up" class="btn solid">



            </form>

        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here ?</h3>
                <p>Lorem ipsum dolor sit aemt consectruren adipisicing elit.Minus impedit quidem quibundam?</p>
                <button class="btn transparent" id="sign-up-btn">Sign Up</button>
            </div>
            <img src="<?php echo IMGROOT;?>/undraw_the_world_is_mine_re_j5cr.svg" class="image" alt="">
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>One of Us ?</h3>
                <p>Lorem ipsum dolor sit aemt consectruren adipisicing elit.Minus impedit quidem quibundam?</p>
                <button class="btn transparent" id="sign-in-btn">Sign In</button>
            </div>
            <img src="<?php echo IMGROOT;?>/undraw_dev_focus_re_6iwt.svg" class="image" alt="">
        </div>

    </div>
</div>



<script>
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
if (<?php echo json_encode($data['reg'] === "True"); ?>) {
    container.classList.add("sign-up-mode");
} else {
    container.classList.remove("sign-up-mode");
}

sign_up_btn.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent default anchor behavior
    container.classList.add("sign-up-mode");
    setTimeout(() => {}, 10000); // Adjust timing to match your animation duration
});

sign_in_btn.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent default anchor behavior
    container.classList.remove("sign-up-mode");
    setTimeout(() => {}, 3000); // Adjust timing to match your animation duration
});
</script>



<?php require APPROOT . '/views/inc/footer.php'; ?>