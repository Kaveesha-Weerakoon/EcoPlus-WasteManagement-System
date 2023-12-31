<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Center_Garbage_Stock">
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
                        <h1>Center Waste Management</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/waste_management">
                            <div class="main-right-top-three-content">
                                <p>Confirmed Garbage</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_garbage_stock">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">Center Garbage Stock</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers_add">
                            <div class="main-right-top-three-content">
                                <p>Stock Relaese Details</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <div class="main-right-bottom-top-box">
                            <div class="box-content">
                                <i class="icon fas fa-trash"></i>
                                <p>Polythene</p>
                                <span>2 <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-box"></i>
                                <p>Plastics</p>
                                <span>3 <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-glass-whiskey"></i>
                                <p>Glass</p>
                                <span>4 <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-file-alt"></i>
                                <p>Paper Waste</p>
                                <span>6 <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-laptop"></i>
                                <p>Electronic Waste</p>
                                <span>9 <small> kg</small></span>
                            </div>
                            <div class="box-content">
                                <i class="icon fas fa-box"></i>
                                <p>Metals</p>
                                <span>7 <small> kg</small></span>
                            </div>

                        </div>


                    </div>
                    <div class="main-right-bottom-down">
                        <a href=""><button class="release-button">Release Stock</button></a>
                    </div>

                    
                </div>
                

                
        
            </div>
        </div>

    </div>
</div>
<script>

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>