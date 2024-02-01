<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_Customer">
        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
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

                <div class="main-right-bottom">
                    <div class="main-right-top-two">
                        <h1>Customers</h1>
                    </div>
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Pro Pic</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Total Credits</th>
                                <th>Discount Details</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                    
                        <table class="table">
                                <?php foreach($data['customers'] as $customer) : ?>
                                        <tr class="table-row">
                                            <td>C <?php echo $customer->user_id?></td>
                                            <td><?php echo $customer->name?></td>
                                            <td><img class="customer_img" src="<?php echo IMGROOT ?>/img_upload/customer/<?php echo ($customer->image == '') ? 'Profile.png' : $customer->image; ?>" alt=""></td>
                                            <td><?php echo $customer->email?></td>
                                            <td> <?php echo $customer->mobile_number?></td>
                                            <td> <?php echo $customer->address?></td>
                                            <td> <?php echo $customer->city?></td>
                                            <td> 0</td>
                                            <td><i class='bx bx-info-circle' style="font-size: 29px"></i></td>
                                            <td><a href="<?php echo URLROOT?>/Admin/customerdelete_confirm/<?php echo $customer->user_id?>"><i class='bx bxs-trash' style="font-size: 29px;"></i></a></td>
                                            <!-- <td><a href="<?php echo URLROOT?>/Admin/customerdelete_confirm/<?php echo $customer->user_id?>"><img class="location" src="<?php echo IMGROOT?>/delete.png" alt=""></a></td> -->
                                <?php endforeach; ?>
                        </table>
                    
                    </div>
                </div>
                
            </div>
        </div>
        <?php if($data['delete_confirm']=='True') : ?>
        <div class="delete_confirm">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/trash.png" alt="">
                    <?php
                        echo "<h2>Delete this Collector?</h2>";
                        echo "<p>This action will permanently delete this center manager</p>";          
                    ?>
                    <div class="btns">
                        
                        <a href="<?php echo URLROOT?>/Admin/customerdelete/<?php echo $data['id']?>"><button type="button" class="deletebtn">Delete</button></a>
                                        
                        <a href="<?php echo URLROOT?>/Admin/customers"><button type="button" class="cancelbtn" >Cancel</button></a>
                    </div>
                </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
