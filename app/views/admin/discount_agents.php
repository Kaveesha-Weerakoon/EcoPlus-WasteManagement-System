<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Discount_Agent">
        <div class="Admin_Discount_Agent_View">
        <div class="main">
                <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

                <div class="main-right">
                    <div class="main-right-top">
                        <div class="main-right-top-one">
                            <div class="main-right-top-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" id="searchInput" placeholder="Search">
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

                        <div class="main-right-top-two">
                            <h1>Center Managers</h1>
                        </div>

                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/admin/discount_agents">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">View</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/admin/discount_agent_add">
                                <div class="main-right-top-three-content">
                                    <p>Register</p>
                                    <div class="line"></div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>


                    <div class="main-right-bottom">
                        <div class="main-right-bottom-top ">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Center Manager ID</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    
                                </tr>
                            </table>
                        </div>

                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['discount_agent'] as $discount_agent) : ?>
                                        <tr class="table-row">
                                            <td>CM <?php echo $discount_agent->user_id?></td>
                                            <td><img src="<?php echo IMGROOT?>/img_upload/discount_agent/<?php echo $discount_agent->image?>" alt="" class="manager_img"></td>
                                            <td><?php echo $discount_agent->name?></td>
                                            <td><?php echo $discount_agent->email?></td>
                                            <!--<td> <?php echo $discount_agent->assinged?></td>
                                            <td> <?php echo $discount_agent->assigned_center_id?></td>
                                            <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/cm_personal_details_view/<?php echo $center_manager->user_id ?>"><img src="<?php echo IMGROOT?>/personal_details_icon.png" alt=""></a></td>
                                            <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/center_managers_update/<?php echo $center_manager->user_id ?>"><img src="<?php echo IMGROOT?>/update.png" alt=""></a></td>
                                            <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/center_managers_delete_confirm/<?php echo $center_manager->user_id?>"><img src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>-->
                                        </tr>
                                <?php endforeach; ?>
                            </table>
                    
                        </div>
                    </div>

                   
                </div>
            </div>
        </div> 

 
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>