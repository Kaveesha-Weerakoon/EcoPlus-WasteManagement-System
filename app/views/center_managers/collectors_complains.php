<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Collector_Complains">
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
                                <p>Register</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_complains">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">Complaints</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>

                    </div>
                </div>


                <!-- <div class="main-top">
                    <a href="<?php echo URLROOT?>/centermanagers">
                        <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                    </a>

                    <div class="main-top-component">
                        <p><?php echo $_SESSION['center_manager_name']?></p>
                        <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
                    </div>
                </div>
               
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
                        <a href="<?php echo URLROOT?>/centermanagers/collectors_add">
                            <div class="main-right-top-three-content">
                                <p>Register</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Complaints</b></p>
                                <div class="line"></div>
                            </div>
                        </a>
                    </div>
                </div> -->
                <?php if(!empty($data['collectors_complains'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Complaint ID</th>
                                <th>Collector ID</th>
                                <th>Date & Time</th>
                                <th>Subject</th>
                                <th>Complaint</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">

                            <?php foreach($data['collectors_complains'] as $post) : ?>
                            <tr class="table-row">
                                <td>CoC <?php echo $post->id?></td>
                                <td>Co <?php echo $post->collector_id?></td>
                                <td><?php echo $post->date?></td>
                                <td><?php echo $post->subject?></td>
                                <td><?php echo $post->complaint?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                        
                    
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                        <h1>There are no complaints yet</h1>
                        <p>Hope you will continue customer satisfaction</p>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>