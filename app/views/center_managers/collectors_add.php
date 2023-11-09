<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Collector_Add">
<div class="main">
            <div class="main-top">
            <a href="<?php echo URLROOT?>/centermanagers">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>

                <div class="main-top-component">
                    <p><?php echo $_SESSION['center_manager_name']?></p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-bottom">

                <div class="main-bottom-top">
                    <div class="main-right-top-two">
                        <h1>Collectors</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/collectors">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Add</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p>Complains</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <form class="main-bottom-down" method="post" action="<?php echo URLROOT;?>/centermanagers/collectors_add">
                    <hr>
                    <div class="main-bottom-down-h1">
                        <h1>Add Collectors</h1>
                    </div>
                    <div class="main-bottom-main">
                        <div class="main-bottom-down-left">
                            <h1>Personal Details</h1>
                            <div class="main-right-bottom-content">
                                <div class="main-right-bottom-content-content">
                                    <h2>Name</h2>
                                    <input type="text" name="name" value="<?php echo $data['name']?>">
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <h2>NIC</h2>
                                    <input type="text" name="nic" value="<?php echo $data['nic']?>">
                                </div>                          
                                <div class="main-right-bottom-content-content">
                                    <h2>Email</h2>
                                    <input type="text" name="email" value="<?php echo $data['email']?>">
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <h2>Address</h2>
                                    <input type="text" name="address" value="<?php echo $data['address']?>">
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <h2>Contact No</h2>
                                    <input type="text" name="contact_no" value="<?php echo $data['contact_no']?>">
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <h2>DOB</h2>
                                    <input type="date" name="dob" value="<?php echo $data['dob']?>">
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <h2>Password</h2>
                                    <input type="password" name="password" value="<?php echo $data['password']?>">
                                </div>
                                <div class="main-right-bottom-content-content">
                                    <h2>Confirm_Password</h2>
                                    <input type="password" name="confirm_password" value="<?php echo $data['confirm_password']?>">
                                </div>
                            </div>
                        </div>
                        <div class="main-bottom-down-right">
                            <h1>Vehicle Details</h1>
                            <div class="main-right-bottom-content">
                                <div class="main-right-bottom-content-content">
                                    <h2>Vehicle No</h2>
                                    <input type="text" name="vehicle_no">
                                </div>                      
                                <div class="main-right-bottom-content-content">
                                    <h2>Vehicle Type</h2>
                                    <input type="text"  name="vehicle_type">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="main-bottom-down-button">
                        <button type="submit">Add Collector</button>
                    </div>


                </form>

            </div>
        </div>


</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>