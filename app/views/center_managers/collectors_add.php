<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Collector_Add">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">

                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search" style="visibility: hidden;">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>

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
                                <p><b style="color:var(--green-color-one);">Register</b></p>
                                <div class="line" style="background-color: var(--green-color-one);"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collector_assistants">
                            <div class="main-right-top-three-content">
                                <p>Assistants</p>
                                <div class="line"></div>
                            </div>
                        </a>


                    </div>
                </div>

                <div class="main-right-bottom-down">
                    <form class="main-bottom-down" method="post"
                        action="<?php echo URLROOT;?>/centermanagers/collectors_add" enctype="multipart/form-data">
                        <div class="main-bottom-down-content">
                            <div class="main-bottom-down-content-header">
                                <h1>Registration Form</h1>
                                <div class="lineHeader"></div>
                            </div>
                            <div class="main-bottom-down-content-one">
                                <h2>Personal Details</h2>
                                <div class="line3"></div>
                            </div>
                            <div class="main-bottom-down-content-img-container">
                                <div class="main-bottom-down-content-two-left">

                                </div>

                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $data['name']?>"
                                        placeholder="Name">
                                    <div class="err"><?php echo $data['name_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo $data['email']?>"
                                        placeholder="Email">
                                    <div class="err"><?php echo $data['email_err']?></div>
                                </div>

                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo $data['address']?>"
                                        placeholder="Address">
                                    <div class="err"> <?php echo $data['address_err']?></div>
                                </div>
                                <div class="main-bottom-down-content-two-right">
                                    <label>Contact No</label>
                                    <input type="text" name="contact_no" placeholder="Contact No"
                                        value="<?php echo $data['contact_no']?>">
                                    <div class="err"><?php echo $data['contactNo_err']?></div>
                                </div>

                            </div>
                            <div class="main-bottom-down-content-two">
                                <div class="main-bottom-down-content-two-right">
                                    <label>DOB</label>
                                    <input type="date" name="dob" value="<?php echo $data['dob']?>">
                                    <div class="err"> <?php echo $data['dob_err']?></div>
                                </div>
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
<script>
/* Notification View */
document.getElementById('submit-notification').onclick = function() {
    var form = document.getElementById('mark_as_read');
    var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/collectors_add";
    form.action = dynamicUrl;
    form.submit();

};
/* ----------------- */
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>