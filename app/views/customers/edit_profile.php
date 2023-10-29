<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer-main-main">
    <div class="Customer-editprofile">
    <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="<?php echo URLROOT?>/customers">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line2"></div>
                            <img src="<?php echo IMGROOT?>/Customer_DashBoard_Icon.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
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
                 
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>//Customer_Edit_Pro_Icon.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    
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
                <div class="main-right-top">
                    <p>Ananda Perera</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-content">

                        <div class="main-right-bottom-content-top">
                            <h1>Edit Profile</h1>
                            <div class="Edit-Profile-line"></div>
                        </div>
                        <div class="main-right-bottom-content-bottom">
                            <div class="main-right-bottom-content-bottom-left">
                                <div class="edit-profile-content">
                                    <h3>Name :</h3>
                                    <input type="text" placeholder="Ananda Perera">
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Address :</h3>
                                    <input type="text" placeholder="Colombo Srilanka">
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Contact Number :</h3>
                                    <input type="text" placeholder="0771231232">
                                </div>
                                <div class="edit-profile-content">
                                    <h3>City :</h3>
                                    <input type="text" placeholder="Homagama">
                                </div>
                                <button>Save</button>
                            </div>

                            <div class="main-right-bottom-content-bottom-right">
                                <div class="edit-profile-content">
                                    <h3>Current Password :</h3>
                                    <input type="password">
                                </div>
                                <div class="edit-profile-content">
                                    <h3>New Password :</h3>
                                    <input type="password">
                                </div>
                                <div class="edit-profile-content">
                                    <h3> Re-enter Password :</h3>
                                    <input type="password">
                                </div> <button>Change Password</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
