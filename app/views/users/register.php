<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="Register-main">
<div class="main">
            <div class="main-container">
                <form class="main-container-right" action="<?php echo URLROOT;?>/users/register" method="post" enctype="multipart/form-data"> 
                    <div class="main-container-right-top">
                        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                        <h1>Join With Us</h1>
                    </div>
                    <div class="main-container-right-profile">
                        <div class="main-container-right-profile-left">
                            <div class="form-drag-area">
                                <div class="icon">
                                    <img src="<?php echo IMGROOT?>/placeholder.png" alt="PLACEHOLDER" width="90px" heigh="90px"
                                        id="profile_image_placeholder">
                                </div>
                                <div class="right-content">
                                    <div class="description">
                                        Drap & Drop to Upload File
                                    </div>
                                    <div class="form-upload">
                                    <input type="file" name="profile_image" id="profile_image" placeholder="select a profile image">

                                    </div>
                                    <div class="form-validation">
                                        <div class="profile-image-validation">
                                            <img src="" alt="green_tik" width="20px" height="20px">
                                            <p style="color: #e74c3c;"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>Name</h2>
                                <input type="text" placeholder="Enter Name" name="name" value="<?php echo $data['name']; ?>">
                                <div class="err"><?php echo $data['name_err']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-container-right-profile">
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>Email</h2>
                                <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['email']; ?>">
                                <div class="err"><?php echo $data['email_err']?></div>
                            </div>
                        </div>
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>Address</h2>
                                <input type="text" placeholder="Enter Address" name="address" value="<?php echo $data['address']; ?>">
                                <div class="err"><?php echo $data['address_err']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-container-right-profile">
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>Contact No</h2>
                                <input type="text" placeholder="Enter Contact No" name="contact_no" value="<?php echo $data['contact_no']; ?>">
                                <div class="err"><?php echo $data['contact_no_err']?></div>
                            </div>
                        </div>
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>City</h2>
                                <input type="text" placeholder="Enter City" name="city" value="<?php echo $data['city']; ?>">
                                <div class="err"><?php echo $data['city_err']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-container-right-profile">
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>Password</h2>
                                <input type="text" placeholder="Enter Name" name="password" value="<?php echo $data['password']; ?>">
                                <div class="err"><?php echo $data['password_err']?></div>
                            </div>
                        </div>
                        <div class="main-container-right-profile-right">
                            <div class="form-fields">
                                <h2>Re-enter Password</h2>
                                <input type="text" placeholder="Enter Password Again" name="confirm_password" value="<?php echo $data['confirm_password']; ?>">
                                <div class="err"><?php echo $data['confirm_password_err']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="register-button">
                        <button type="submit">Register</button>
                    </div>
                </form >
            </div>
        </div>
        <script src="<?php echo JSROOT?>/Users_Register.js"> </script>        

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

