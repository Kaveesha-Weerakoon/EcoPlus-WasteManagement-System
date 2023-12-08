<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="CenterManager_CenterWorker_Add">
    <div class="main">
        <div class="main-top">
            <a href="<?php echo URLROOT?>/centermanagers">
                <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
            </a>

            <div class="main-top-component">
                <p><?php echo $_SESSION['center_manager_name']?></p>
                <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
            </div>
        </div>
        <div class="main-bottom">
            <div class="main-bottom-top">
                <div class="main-right-top-two">
                    <h1>Center Workers</h1>
                </div>
                <div class="main-right-top-three">
                    <a href="<?php echo URLROOT?>/centermanagers/center_workers">
                        <div class="main-right-top-three-content">
                            <p>View</p>
                            <div class="line1"></div>
                        </div>
                    </a>
                    <a href="">
                        <div class="main-right-top-three-content">
                            <p><b style="color: #1B6652;">Register</b></p>
                            <div class="line"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-bottom-down">
                <div class="form-container">
                    <div class="form-title">Registration form</div>
                    <form action="<?php echo URLROOT;?>/centermanagers/center_workers_add"
                        class="main-right-bottom-content" method="post">
                        <div class="user-details">
                            <div class="main-right-bottom-content-content">
                                <span class="details">Name</span>
                                <input name="name" type="text" placeholder="Enter Name"
                                    value="<?php echo $data['name'];?>">
                                <div class="error-div" style="color:red">
                                    <?php echo $data['name_err']?>
                                </div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <span class="details">NIC</span>
                                <input name="nic" type="text" placeholder="Enter NIC" value=<?php echo $data['nic'];?>>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['nic_err']?>
                                </div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <span class="details">DOB</span>
                                <input name="dob" type="date" placeholder="Enter DOB" value="<?php echo $data['dob']?>">
                                <div class="error-div" style="color:red">
                                    <?php echo $data['dob_err']?>
                                </div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <span class="details">Contact No</span>
                                <input name="contact_no" type="text" placeholder="Enter Contact No"
                                    value="<?php echo $data['contact_no']?>">
                                <div class="error-div" style="color:red">
                                    <?php echo $data['contact_no_err']?>
                                </div>
                            </div>
                            <div class="main-right-bottom-content-content A">
                                <span class="details">Address</span>
                                <input name="address" type="text" placeholder="Enter Address"
                                    value="<?php echo $data['address']?>">
                                <div class="error-div" style="color:red">
                                    <?php echo $data['address_err']?>
                                </div>
                            </div>

                        </div>

                        <div class="form-button">
                            <button type="submit">REGISTER</button>
                        </div>
                    </form>

                </div>

            </div>
            <?php if($data['registered']=='True') : ?>
            <div class="center_worker_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Center Worker has been registered successfully</p>
                    <a href="<?php echo URLROOT?>/centermanagers/center_workers"><button type="button">OK</button></a>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>