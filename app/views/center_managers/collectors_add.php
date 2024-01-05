<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Collector_Add">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">

                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <div class="main-right-top-notification" id="notification">
                            <i class='bx bx-bell'></i>
                            <div class="dot"></div>
                        </div>
                        <div id="notification_popup" class="notification_popup">
                            <h1>Notifications</h1>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Cancelled
                            </div>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Assigned
                            </div>
                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                Request 1232 Has been Cancelled
                            </div>
                        </div>
                        <div class="main-right-top-profile">
                            <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>"
                                alt="">
                            <div class="main-right-top-profile-cont">
                                <h3><?php echo $_SESSION['center_manager_name']?></h3>
                                <p>ID : Col <?php echo $_SESSION['center_manager_id']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/collectors">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_add">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">Register</b></p>
                                <div class="line"  style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_complains">
                            <div class="main-right-top-three-content">
                                <p>Complaints</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>
               
                <div class="main-right-bottom-down">
                    <form class="main-bottom-down" method="post" action="<?php echo URLROOT;?>/centermanagers/collectors_add"
                        enctype="multipart/form-data">
                        <div class="main-bottom-down-content">
                            <div class="main-bottom-down-content-one">
                                <h2>Personal Details</h2>
                                <div class="line3"></div>
                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-left">
                                    <div class="form-drag-area">
                                        <div class="icon">
                                            <img src="<?php echo IMGROOT;?>/img_upload/placeholder.png" alt="PLACEHOLDER"
                                                width="90px" height="90px" id="profile_image_placeholder">
                                        </div>
                                        <div class="right-content">
                                            <div class="description">
                                                Drag & Drop to Upload File
                                            </div>
                                            <div class="form-upload">
                                                <input type="file" name="profile_image" id="profile_image"
                                                    placeholder="select a profile image">
                                            </div>
                                            <div class="form-validation">
                                                <div class="profile-image-validation">
                                                    <img src="<?php echo IMGROOT?>/checked.png" alt="green_tik" width="20px"
                                                        height="20px">
                                                    <p style="color: #e74c3c;"><?php echo $data['profile_err'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $data['name']?>" placeholder="Name">
                                    <div class="err"><?php echo $data['name_err']?></div>
                                </div>
                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo $data['email']?>" placeholder="Email">
                                    <div class="err"><?php echo $data['email_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo $data['address']?>"
                                        placeholder="Address">
                                    <div class="err"> <?php echo $data['address_err']?></div>
                                </div>
                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>Contact No</label>
                                    <input type="text" name="contact_no" placeholder="Contact No"
                                        value="<?php echo $data['contact_no']?>">
                                    <div class="err"><?php echo $data['contactNo_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>DOB</label>
                                    <input type="date" name="dob" value="<?php echo $data['dob']?>">
                                    <div class="err"> <?php echo $data['dob_err']?></div>
                                </div>
                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>NIC</label>
                                    <input type="text" name="nic" value="<?php echo $data['nic']?>" placeholder="NIC">
                                    <div class="err"><?php echo $data['nic_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">

                                </div>
                            </div>
                            <div class="main-bottom-down-content-one">
                                <h2>Vehicle Details</h2>
                                <div class="line3"></div>
                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>Vehicle No</label>
                                    <input type="text" name="vehicle_no" placeholder="Vehicle No"
                                        value="<?php echo $data['vehicle_no']?>">
                                    <div class="err"> <?php echo $data['vehicleNo_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>Vehicle Type</label>
                                    <input type="text" name="vehicle_type" placeholder="Vehicle Type"
                                        value="<?php echo $data['vehicle_type']?>">
                                    <div class="err"> <?php echo $data['vehicleType_err']?></div>
                                </div>
                            </div>
                            <div class="main-bottom-down-content-one">
                                <h2>Password</h2>
                                <div class="line3"></div>
                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label> Password</label>
                                    <input type="password" placeholder="Password" name="password"
                                        value="<?php echo $data['password']?>">
                                    <div class="err"><?php echo $data['password_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password"
                                        value="<?php echo $data['confirm_password']?>">
                                    <div class="err"><?php echo $data['confirm_password_err']?></div>
                                </div>
                            </div>
                            <div class="main-bottom-down-content-button">
                                <button type="submit">Register</button>
                            </div>

                    </form>

                </div>
                     
            </div>

            
            <?php if($data['registered']=='True') : ?>
            <div class="collector_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Collector has been registered successfully</p>
                    <a href="<?php echo URLROOT?>/centermanagers/collectors"><button type="button">OK</button></a>

                </div>
            </div>
            <?php endif; ?>

        </div>
        <script src="<?php echo JSROOT?>/Center_Manager_Collector.js"> </script>



    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>