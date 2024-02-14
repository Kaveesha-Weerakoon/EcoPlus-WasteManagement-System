<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Admin">
        <div class="Admin_Admin_Add">


            <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>
                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
                            </div>
                            <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
                                <i class='bx bx-bell'></i>
                                <div class="dot"></div>
                            </div>

                            <div class="main-right-top-profile">
                                <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3>Admin</h3>
                                </div>
                            </div>
                        </div>
                        <div class="main-right-top-two">
                            <h1>Admins</h1>
                        </div>

                        <a href="<?php echo URLROOT?>/admin/addadmins">
                            <div class="main-right-top-three">
                                <div class="main-right-top-three-content">
                                    <p>View</p>
                                    <div class="line"></div>
                                </div>
                        </a>
                        <div class="main-right-top-three-content">
                            <p><b style="color:#1ca557;">Register</b></p>
                            <div class="line1"></div>
                        </div>


                    </div>
                </div>

                <div class="main-right-bottom">
                    <form class="main-bottom-down-content" action="<?php echo URLROOT;?>/admin/addadmins2" method="post"
                        enctype="multipart/form-data">
                        <div class="main-bottom-down-content-top">
                            <div class="main-bottom-down-content-top-content">
                                <h3>Registration Form</h3>
                                <div class="registration-line"></div>
                            </div>
                        </div>
                        <div class="main-bottom-down-content-bottom">
                            <div class="main-bottom-down-content-bottom-one">
                                <div class="main-bottom-down-content-bottom-one-left">
                                    <div class="form-drag-area">
                                        <div class="icon">
                                            <img src="<?php echo IMGROOT;?>/img_upload/placeholder.png"
                                                alt="PLACEHOLDER" width="90px" heigh="90px"
                                                id="profile_image_placeholder">
                                        </div>
                                        <div class="right-content">
                                            <div class="description">
                                                Drap & Drop to Upload File
                                            </div>
                                            <div class="form-upload">
                                                <input type="file" name="profile_image" id="profile_image"
                                                    placeholder="select a profile image">
                                            </div>
                                            <div class="form-validation">
                                                <div class="profile-image-validation">
                                                    <img src="<?php echo IMGROOT?>/checked.png" alt="green_tik"
                                                        width="20px" height="20px">
                                                    <p style="color: #e74c3c;"><?php 
                                                                echo $data['profile_err'];                                                                                          
                                                        ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-bottom-down-content-bottom-one-right">
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
                                        <h2>NIC</h2>
                                        <input type="text" name="nic" placeholder="NIC"
                                            value="<?php echo $data['nic']; ?>">
                                        <div class="err"><?php echo $data['nic_err']?></div>
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
                                        <h2>DOB</h2>
                                        <input type="date" name="dob" value="<?php echo $data['dob']; ?>">
                                        <div class="err"><?php echo $data['dob_err']?></div>
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
                                        <input type="password" name="password" value="<?php echo $data['password']; ?>">
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
        </div>
    </div>
</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>