<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="CenterManager_Main">
    <div class="CenterManager_Dashboard">
        <div class="main">
            <div class="main-left">
                <div class="main-left-top">
                    <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
                    <h1>Eco Plus</h1>
                </div>
                <div class="main-left-middle">
                    <a href="./CenterManager_DashBoard.html">
                        <div class="main-left-middle-content current">
                            <div class="main-left-middle-content-line"></div>
                            <img src="<?php echo IMGROOT?>/Home.png" alt="">
                            <h2>Dashboard</h2>
                        </div>
                    </a>
                    <a href="./CenterManager_Requests/CenterManager_Requests.html">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Request.png" alt="">
                            <h2>Requests</h2>
                        </div>
                    </a>
                    <a href="./Center_Management/Center Management.html">
                        <div class="main-left-middle-content Collector">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/Center.png" alt="">
                            <h2>Center Waste Management</h2>
                        </div>
                    </a>
                    <a href="<?php echo URLROOT?>/centermanagers/editprofile">
                        <div class="main-left-middle-content">
                            <div class="main-left-middle-content-line1"></div>
                            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
                            <h2>Edit Profile</h2>
                        </div>
                    </a>
                </div>
                <div class="main-left-bottom">
                     <a href="<?php echo URLROOT?>/centermanagers/logout" class="logout-ancor">
                        <div class="main-left-bottom-content">                      
                            <img src="<?php echo IMGROOT?>/logout.png" alt="">
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
                            <input type="text" placeholder="Search Anything">
                            <img src="<?php echo IMGROOT?>/notifications.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-left-two">
                        <a href="<?php echo URLROOT?>/centermanagers/collectors" class="main-right-left-two-a">
                            <div class="main-right-left-two-component" style="background-image: url('<?php echo IMGROOT?>/Dashboard1.png');">
                                <h1>Collectors</h1>
                                <img src="<?php echo IMGROOT?>/Collector.png" alt="">
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers" class="main-right-left-two-a">
                            <div class="main-right-left-two-component" style="background-image: url('<?php echo IMGROOT?>/Dashboard2.png');">
                                <h1>Center Workers</h1>
                                <img src="<?php echo IMGROOT?>/Center_Workers.png" alt="">
                            </div>
                        </a>
                    </div> 
                    <div class="main-right-left-three">
                        <div class="main-right-left-three-content">
                            <div class="main-right-left-three-content-left">
                                <img src="<?php echo IMGROOT?>/Center_Img.png" alt="">
                                <h1><?php echo $data['center_name']?></h1>
                                <h4>Center ID: CEN <?php echo $data['center_id']?></h3>
                            </div>
                            <div class="main-right-left-three-content-right">
                                <button>Incoming Requests</button>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="main-right-right">
                    <div class="main-right-right-top">
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                        <h2><?php echo $_SESSION['center_manager_name']?></h2>
                        <p>Center Manager ID: CM <?php echo $_SESSION['center_manager_id']?></p>
                        <button>Profile</button>
                    </div>
                    <div class="main-right-right-bottom">
                        <img src="<?php echo IMGROOT?>/Dashboard-Man.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
