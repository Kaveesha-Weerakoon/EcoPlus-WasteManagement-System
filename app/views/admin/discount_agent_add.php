<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Discount_Agent">
        <div class="Admin_Discount_Agent_Add">
            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">

                            <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>

                        </div>
                        <div class="main-right-top-two">
                            <h1>Credit Discount Agent</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/admin/discount_agents">
                                <div class="main-right-top-three-content">
                                    <p>View</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/admin/discount_agent_add">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">Register</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="main-bottom-down">
                        <form class="main-bottom-down-content" action="<?php echo URLROOT;?>/admin/discount_agent_add"
                            method="post" enctype="multipart/form-data">
                            <div class="main-bottom-down-content-top">
                                <div class="main-bottom-down-content-top-content">
                                    <h3>Registration Form</h3>
                                    <div class="registration-line"></div>
                                </div>
                            </div>
                            <div class="main-bottom-down-content-bottom">
                                <div class="main-bottom-down-content-bottom-one">

                                    <div class="main-bottom-down-content-bottom-one-right name">
                                        <div class="form-fields">
                                            <h2>Name</h2>
                                            <input type="text" placeholder="Enter Name" name="name"
                                                value="<?php echo $data['name']; ?>">
                                            <div class="err"><?php echo $data['name_err']?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-bottom-down-content-bottom-content">
                                    <div class="main-bottom-down-content-bottom-one-right">
                                        <div class="form-fields">
                                            <h2>Contact No</h2>
                                            <input type="text" name="contact_no" placeholder="Contact No"
                                                value="<?php echo $data['contact_no']; ?>">
                                            <div class="err"><?php echo $data['contact_no_err']?></div>
                                        </div>
                                    </div>
                                    <div class="main-bottom-down-content-bottom-one-right">
                                        <div class="form-fields">
                                            <h2>Address</h2>
                                            <input type="text" name="address" placeholder="Address"
                                                value="<?php echo $data['address']; ?>">
                                            <div class="err"><?php echo $data['address_err']?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="main-bottom-down-content-bottom-content-three">
                                    <div class="main-bottom-down-content-bottom-one-right">
                                        <div class="form-fields">
                                            <h2>Email</h2>
                                            <input type="text" name="email" value="<?php echo $data['email']; ?>">
                                            <div class="err"><?php echo $data['email_err']?></div>
                                        </div>
                                    </div>
                                    <div class="main-bottom-down-content-bottom-one-right">
                                        <div class="form-fields">
                                            <h2>Password</h2>
                                            <input type="password" name="password"
                                                value="<?php echo $data['password']; ?>">
                                            <div class="err"><?php echo $data['password_err']?></div>
                                        </div>
                                    </div>
                                    <div class="main-bottom-down-content-bottom-one-right">
                                        <div class="form-fields">
                                            <h2>Re-enter Password</h2>
                                            <input type="password" name="confirm_password"
                                                value="<?php echo $data['confirm_password']; ?>">
                                            <div class="err"><?php echo $data['confirm_password_err']?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-bottom-down-content-bottom-button">
                                    <button type="submit">REGISTER</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <script src="<?php echo JSROOT?>/Admin_Center_Manager.js"> </script>
            </div>
        </div>

        <?php if($data['registered']=='True') : ?>
        <div class="center_manager_success">
            <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>Discount Agent has been registered successfully</p>
                <a href="<?php echo URLROOT?>/admin/discount_agents"><button type="button">OK</button></a>

            </div>
        </div>
        <?php endif; ?>

    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>