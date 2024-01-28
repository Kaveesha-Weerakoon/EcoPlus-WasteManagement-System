<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Discount_Agent">
        <div class="Customer_Discount_Agent_View">
            <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

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
                                <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                                    alt="">
                                <div class="main-right-top-profile-cont">
                                    <h3><?php echo $_SESSION['user_name']?></h3>
                                    <p>ID : C <?php echo $_SESSION['user_id']?></p>
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
                                    <th>Contact_No</th>
                                    <th>Address</th>

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
                                    <td><?php echo $discount_agent->contact_no?></td>
                                    <td><?php echo $discount_agent->address?></td>
                                    
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
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>