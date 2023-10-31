<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer-main">
<div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <div class="main-left-middle-content current">
                        <div class="main-left-middle-content-line"></div>
                        <img src="<?php echo IMGROOT?>/Customer_DashBoard_Icon.png" alt="">
                        <h2>Dashboard</h2>
                    </div>
                    <a href="<?php echo URLROOT?>/customers/request_main">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/customers/history">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_tracking _Icon.png" alt="">
                            <h2>History</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/customers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">

                    <a href="<?php echo URLROOT?>/customers/logout">
                        <div class="main-left-bottom-content">
                            <img src="<?php echo IMGROOT?>/Logout.png" alt="">
                            <p>Log out</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-right">

                <div class="main-right-left">
                    <div class="main-right-left-one">
                        <div class="main-right-left-one-text">
                            <div class="change">Welcome back</div> Eco plus
                        </div>
                        <div class="main-right-left-one-right">
                            <img src="<?php echo IMGROOT?>/Search.png" alt="">
                            <input type="text" placeholder="Search Any thing">
                            <img src="<?php echo IMGROOT?>/notifications.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-left-two">
                        <div class="main-right-left-two-component A" style="background-image: url('<?php echo IMGROOT?>/Group 7.1.png');">
                            <div class="main-right-left-two-component-component">
                                <p>1 Eco Credit = Rs 00.57</p>
                                <img src="<?php echo IMGROOT?>/Save_Monet.png" alt="">
                            </div>

                        </div>
                        <div class="main-right-left-two-component B" style="background-image: url('<?php echo IMGROOT?>/Group.png');">
                            <a href="<?php echo URLROOT?>/customers/credit_per_waste">
                                <div class="main-right-left-two-component-component">
                                    <p>Credits per waste quantity</p>
                                    <img src="<?php echo IMGROOT?>/Tree.png" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="main-right-left-three">

                        <div class="main-right-left-three-right">
                            <p>Request a collect now & Gain Eco Credits for your Non biodegradable waste</p>
                            <a href="<?php echo URLROOT?>/customers/request_collect"><button>Request Garbage Collection</button></a>
                        </div>
                    </div>
                    <div class="main-right-left-four">
                        <h1>We are Collecting</h1>
                        <div class="main-right-left-four-bottom">
                            <div class="main-right-left-four-bottom-component">
                                <img src="<?php echo IMGROOT?>/Polythene.png" alt="">
                                <p>Polythene</p>
                            </div>
                            <div class="main-right-left-four-bottom-component">
                                <img src="<?php echo IMGROOT?>/Plastic.png" alt="">
                                <p>Plastic</p>
                            </div>
                            <div class="main-right-left-four-bottom-component">
                                <img src="<?php echo IMGROOT?>/Glass.png" alt="">
                                <p>Glass</p>
                            </div>
                            <div class="main-right-left-four-bottom-component">
                                <img src="<?php echo IMGROOT?>/Paper.png" alt="">
                                <p>Paper Waste</p>
                            </div>
                            <div class="main-right-left-four-bottom-component">
                                <img src="<?php echo IMGROOT?>/Electronic_Waste.png" alt="">
                                <p>Electonic Waste</p>
                            </div>
                            <div class="main-right-left-four-bottom-component">
                                <img src="<?php echo IMGROOT?>/Metal.png" alt="">
                                <p>Metals</p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="main-right-right">
                    <div class="main-right-right-one">
                        <img src="<?php echo IMGROOT?>/CustomerDashboard_image.png" alt="">
                        <h2><?php echo $_SESSION['user_name']?></h2>
                        <p>User ID: C <?php echo $_SESSION['user_id']?></p>
                    </div>
                    <div class="main-right-right-two">

                        <a href="<?php echo URLROOT?>/customers/transfer" class="main-right-right-two-component">
                            <img src="<?php echo IMGROOT?>/Transfer.png" alt="">
                            <p>Tranfer Credit</p>
                        </a>

                        <a href="<?php echo URLROOT?>/customers/viewprofile" class="main-right-right-two-component">
                        <div id="Profile" class="main-right-right-two-component">
                            <img src="<?php echo IMGROOT?>/Profile.png" alt="">
                            <p>Profile</p>
                        </div> 
                        </a>

                        <a href="<?php echo URLROOT?>/customers/complains" class="main-right-right-two-component">
                            <img src="<?php echo IMGROOT?>/Complaints.png" alt="">
                            <p>Complaints</p>
                        </a>
                    </div>
                    <div class="main-right-right-three">
                        <h1>Eco Credit Balance</h1>
                        <div class="main-right-right-three-compnent">632.897</div>
                        <p>Redeem your Eco credits on supermarket bills</p>
                    </div>
                    <div class="main-right-right-four">
                        <div class="main-right-left-three-left">
                            <img src="<?php echo IMGROOT?>/CustomerDashboard_image_one.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <script src="CustomerDashboard.js"></script>
            <?php if($data['pop']=='True') : ?>
            <div class="Pop" id="Popup">
                <div id="Profile_Pop" class="Profile">
                    <div class="profile-top">
                        <div class="profile-top-left"></div>
                        <a href="<?php echo URLROOT?>/customers" >
                                <img src="<?php echo IMGROOT?>/Close.png" id="Profile_close">
                        </a>
                    </div>
                    <div class="profile-down">
                        <div class="profile-down-top-content">
                            <img src="<?php echo IMGROOT?>/Profile2.png" alt="">
                            <h1 style="font-size: 29px;"><?php echo $_SESSION['user_name']?></h1>
                        </div>

                        <div class="profile-down-content">
                            <p>Name</p>
                            <input type="text" value="<?php echo $data['name']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>User ID</p>
                            <input type="text" value="C<?php echo $data['userid']?>" readonly>
                        </div>

                        <div class="profile-down-content">
                            <p>Email</p>
                            <input type="text" value="<?php echo $data['email']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>Contact No</p>
                            <input type="text" value="<?php echo $data['contactno']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>Address</p>
                            <input type="text" value="<?php echo $data['address']?>" readonly>
                        </div>
                        <div class="profile-down-content">
                            <p>City</p>
                            <input type="text" value="<?php echo $data['city']?>" readonly>
                        </div>


                    </div>
                </div>
            </div>
            <?php endif; ?>
</div>
</div>




<?php require APPROOT . '/views/inc/footer.php'; ?>
