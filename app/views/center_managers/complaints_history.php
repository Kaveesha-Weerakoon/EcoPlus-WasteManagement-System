<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManager_Complaints_History">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
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
               
                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Complaints History</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Complaint Id</th>
                                <th>Subject</th>
                                <th>Complaint</th>
                                <th>Date & Time</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                    <table class="table">
                                <?php foreach($data['complaints_history'] as $complaint) : ?>
                                        <tr class="table-row">
                                            <td>Com<?php echo $complaint->complaint_id?></td>
                                            <td><?php echo $complaint->subject?></td>
                                            <td><?php echo $complaint->complaint?></td>
                                            <td><?php echo $complaint->date_time?></td>
                                           
                                <?php endforeach; ?>
                    </table>
                    
                    
                    </div>
                </div>
        
            </div>
        </div>
        
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>