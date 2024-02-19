<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Center_Main_Workers">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
            <div class="main-right-top">
                    <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                    <div class="main-right-top-back-button">
                        <i class='bx bxs-chevrons-left'></i>
                    </div>
                    </a>
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" style="visibility: hidden;" id="notification">
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
                        <img src="<?php echo IMGROOT?>/profile-pic.jpeg" alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>Admin</h3>
                        </div>
                    </div>

                    
                </div>

                <!-- <div class="main-top">
                    <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>/<?php echo $data['center']->region?>">
                        <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                    </a>

                    <div class="main-top-component">
                        <p>Admin</p>
                        <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                    </div>
                </div>
                
                <div class="main-bottom-top">
                    <div class="main-right-top-two">
                        <h1>Center Workers</h1>
                    </div>
                </div> -->

                <?php if(!empty($data['workers_in_center'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Center Workers</h1>
                    </div>
                    <div class="main-right-bottom-top ">
                        <table class="table">
                            <tr class="table-header">
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Address</th>
                                <th>DOB</th>
                                <th>Contact No</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                        <?php foreach($data['workers_in_center'] as $worker) : ?>
                            <tr class="table-row">
                                <td><?php echo $worker->name?></td>
                                <td><?php echo $worker->nic?></td>
                                <td><?php echo $worker->address?></td>
                                <td><?php echo $worker->dob?></td>
                                <td><?php echo $worker->contact_no?></td>
                            </tr>   
                            <?php endforeach; ?>  
                        </table>            
                    </div>

                </div>
                <?php else: ?>
                    <div class="main-right-bottom-two">
                        <div class="main-right-bottom-two-content">
                            <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                            <h1>There are no center workers in the center</h1>
                            <p>All the center workers will appear here</p>
                        </div>
                    </div>
                <?php endif; ?>
               

            </div>

        </div>
    </div>


</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>