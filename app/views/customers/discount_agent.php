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
                            <h1>Credit Discount Agent</h1>
                        </div>

                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/admin/discount_agents">
                                <div class="main-right-top-three-content">
                                    <p><b style="color:#1ca557;">View</b></p>
                                    <div class="line" style="background-color: #1ca557;"></div>
                                </div>
                            </a>
                            
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
                                    <th>Delete</th>
                                </tr>
                            </table>
                        </div>

                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['discount_agents'] as $discount_agent) : ?>
                                <tr class="table-row">
                                    <td>CM <?php echo $discount_agent->user_id?></td>
                                    <td><img src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $discount_agent->image?>"
                                            alt="" class="manager_img"></td>
                                    <td><?php echo $discount_agent->name?></td>
                                    <td><?php echo $discount_agent->email?></td>
                                    <td class="cancel-open"><a href="<?php echo URLROOT?>/admin/discount_agent_delete_confirm/<?php echo $discount_agent->user_id?>"><img src="<?php echo IMGROOT?>/delete.png" alt=""></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                </div>
             </div>
        </div>


        <?php if($data['confirm_delete']=='True') : ?>
                <div class="delete_confirm">
                        <div class="popup" id="popup">
                            <img src="<?php echo IMGROOT?>/trash.png" alt="">
                            <?php
                                echo "<h2>Delete this Credit Discount Agent?</h2>";
                                echo "<p>This action will permanently delete this Discount Agent</p>";
                               
                            ?>
                            <div class="btns">
                                <?php
                                        echo '<a href="' . URLROOT . '/Admin/discount_agent_delete/' . $data['discount_agent_id'] . '"><button type="button" class="deletebtn">Delete</button></a>';
                                   
                                ?>                     
                                <a href="<?php echo URLROOT?>/Admin/discount_agents"><button type="button" class="cancelbtn" >Cancel</button></a>
                            </div>
                        </div>
                </div>
                <?php endif; ?>
                <?php if($data['success']=='True') : ?>
                    <div class="center_manager_success">
                            <div class="popup" id="popup">
                                <img src="<?php echo IMGROOT?>/check.png" alt="">
                                <h2>Success!!</h2>
                                <p>Discount Agents has been deleted successfully</p>
                                <a href="<?php echo URLROOT?>/admin/discount_agents"><button type="button" >OK</button></a>
                            </div>
                    </div>
                    d<?php endif; ?>


    </div>




         


</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>