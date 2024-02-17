<?php require APPROOT . '/views/inc/header.php'; ?>
 <div class="Admin_Main">
    <div class="Admin_Customer_Complains">
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
                        <h1>Complaints</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">Customers</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/Admin/complain_collectors">
                            <div class="main-right-top-three-content">
                                <p>Collectors</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/Admin/complaint_centers">
                            <div class="main-right-top-three-content">
                                <p>Centers</p>
                                <div class="line"></div>
                            </div>
                        </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p>Credit Discount Agents</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Complaint ID</th>
                                <th>Customer ID</th>
                                <th>Date</th>
                                <!--<th>Contact No</th>
                                <th>Customer Name</th>
                                <th>Subject</th>
                                <th>Complaint</th>-->
                                <th>Subject</th>
                                <th>details</th>
                               
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                        <?php foreach($data['complains'] as $complaint) : ?>
                                       <tr class="table-row">
                                           <td>Com <?php echo $complaint->id?></td>
                                           <td>C<?php echo $complaint->customer_id?></td>
                                           <td><?php echo $complaint->date?></td>
                                          <!--    <td><?php echo $complaint->contact_no?></td>
                                           <td><?php echo $complaint->name?></td>
                                           <td><?php echo $complaint->subject?></td>
                                           <td><?php echo $complaint->complaint?></td>  -->
                                           <td><?php echo $complaint->subject?></td>
                                           <td><i onclick="openpersonaldetails((<?php echo htmlspecialchars(json_encode( $complaint), ENT_QUOTES, 'UTF-8') ?>))"
                                                 class='bx bxs-file' style="font-size: 29px;"></i></td>


                                        </tr>
                                  <?php endforeach; ?>
                        </table>

                    </div>
                </div>
             </div>
        </div>




                
                <div class="overlay" id="overlay"></div>


        <div class="personal-details-popup-box" id="personal-details-popup-box">
            <div class="personal-details-popup-form">
                <img src="<?php echo IMGROOT?>/close_popup.png" alt="" class="personal-details-popup-form-close"
                id="personal-details-popup-form-close">
                <center>
                    <div class="personal-details-topic">Personal Details</div>
                </center>

                <div class="personal-details-popup">
                    <div class="personal-details-left">
                        <!-- <img src="<?php echo IMGROOT?>/img_upload/Admin/<?php echo $data['image']?>" class="profile-pic"
                            alt=""> -->
                            <img src="" id="admin_profile_pic" alt="">
                        <p>Admin ID: <span id="admin_id">C</span></p>
                    </div>
                    <div class="personal-details-right">
                        <div class="personal-details-right-labels">
                            <span>Name</span><br>
                            <span>Email</span><br>
                            <span>NIC</span><br>
                            <span>Address</span><br>
                            <span>Contact No</span><br>
                            <span>DOB</span><br>
                        </div>
                        <div class="personal-details-right-values">
                            <span id="admin_name"></span><br>
                            <span id="admin_email"></span><br>
                            <span id="admin_nic"></span><br>
                            <span id="admin_address"></span><br>
                            <span id="admin_contact_no"></span><br>
                            <span id="admin_dob"></span><br>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div> 
 </div>
    


<?php require APPROOT . '/views/inc/footer.php'; ?>
