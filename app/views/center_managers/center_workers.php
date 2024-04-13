<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="CenterManager_Main">
    <div class="CenterManger_CenterWorker">
        <div class="main">
            <?php require APPROOT . '/views/center_managers/centermanager_sidebar/side_bar.php'; ?>
            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" id="searchInput" placeholder="Search">
                        </div>
                        <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>
                        <!-- <div class="main-right-top-notification" id="notification">
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
                        </div> -->
                    </div>
                    <div class="main-right-top-two">
                        <h1>Center Workers</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers">
                            <div class="main-right-top-three-content">
                                <p><b style="color:#1ca557;">View</b></p>
                                <div class="line" style="background-color: #1ca557;"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers_add">
                            <div class="main-right-top-three-content">
                                <p>Register</p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>

                
                <?php if(!empty($data['center_workers'])) : ?>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-top">
                        <table class="table">
                            <tr class="table-header">
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>DOB</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                    <div class="main-right-bottom-down">
                        <table class="table">
                            <?php foreach($data['center_workers'] as $center_worker) : ?>
                            <tr class="table-row">
                                <td> <?php echo $center_worker->name?></td>
                                <td><?php echo $center_worker->nic?></td>
                                <td><?php echo $center_worker->address?></td>
                                <td> <?php echo $center_worker->contact_no?></td>
                                <td> <?php echo $center_worker->dob?></td>
                                <td class="cancel-open"><a
                                        href="<?php echo URLROOT?>/centermanagers/center_workers_update/<?php echo $center_worker->id ?>">
                                        <i class='bx bx-refresh' style="font-size: 30px; font-weight:1000px;"></i></a></td>
                                <td class="cancel-open"><a
                                        href="<?php echo URLROOT?>/centermanagers/center_workers_delete_confirm/<?php echo $center_worker->id ?>">
                                        <i class='bx bxs-trash' style="font-size: 29px;"></i></a></td>
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="main-right-bottom-two">
                    <div class="main-right-bottom-two-content">
                        <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                        <h1>There are no center workers available</h1>
                        <p>Register a center worker now!</p>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers_add"><button>Register</button></a>

                    </div>
                </div>
                <?php endif; ?>

                <?php if($data['click_update']=='True') : ?>
                <div class="update_click">
                    <div class="popup-form" id="popup">
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers"><img
                                src="<?php echo IMGROOT?>/close_popup.png" class="update-popup-img" alt=""></a>
                        <h2>Update Details</h2>
                        <center>
                            <div class="update-topic-line"></div>
                        </center>
                        <form class="updatePopupform" method="post"
                            action="<?php echo URLROOT;?>/centermanagers/center_workers_update/<?php echo $data['id'];?>">
                            <div class="updateData A">
                                <label>Name</label><br>
                                <input type="text" name="name" placeholder="Enter name"
                                    value="<?php echo $data['name']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['name_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>NIC</label><br>
                                <input type="text" name="nic" placeholder="Enter NIC"
                                    value="<?php echo $data['nic']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['nic_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Address</label><br>
                                <input type="text" name="address" placeholder="Enter Address"
                                    value="<?php echo $data['address']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['address_err']?>
                                </div>
                            </div>
                            <div class="updateData">
                                <label>Contact No</label><br>
                                <input type="text" name="contact_no" placeholder="Enter Contact No"
                                    value="<?php echo $data['contact_no']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['contact_no_err']?>
                                </div>
                            </div>
                            <div class="updateData B">
                                <label>DOB</label><br>
                                <input type="date" name="dob" placeholder="Enter DOB"
                                    value="<?php echo $data['dob']; ?>"><br>
                                <div class="error-div" style="color:red">
                                    <?php echo $data['dob_err']?>
                                </div>
                            </div>

                            <div class="btns1">
                                <button type="submit" class="updatebtn">Update</button>
                                <a href="<?php echo URLROOT?>/centermanagers/center_workers"><button type="button"
                                        class="cancelbtn1">Cancel</button></a>
                            </div>

                        </form>

                    </div>
                </div>

                <?php endif; ?>

                <?php if($data['confirm_delete']=='True') : ?>
                <div class="delete_confirm">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/trash.png" alt="">
                        <h2>Delete this center worker?</h2>
                        <p>This action will permanently delete this center worker</p>
                        <div class="btns">
                            <a
                                href="<?php echo URLROOT?>/centermanagers/center_workers_delete/<?php echo $data['center_worker_id'] ?>"><button
                                    type="button" class="deletebtn">Delete</button></a>
                            <a href="<?php echo URLROOT?>/centermanagers/center_workers ?>"><button type="button"
                                    class="cancelbtn">Cancel</button></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($data['update_success']=='True') : ?>
                <div class="center_worker_update_success">
                    <div class="popup1" id="popup1">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Center Worker details has updated successfully</p>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers"><button type="button">OK</button></a>

                    </div>
                </div>
                <?php endif; ?>

                <?php if($data['delete_success']=='True') : ?>
                <div class="center_worker_update_success">
                    <div class="popup1" id="popup1">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Center Worker has deleted successfully</p>
                        <a href="<?php echo URLROOT?>/centermanagers/center_workers"><button type="button">OK</button></a>

                    </div>
                </div>
                <?php endif; ?>
        
            </div>
        </div>

    </div>
</div>
<script>
    /* Notification View */
    document.getElementById('submit-notification').onclick = function() {
        var form = document.getElementById('mark_as_read');
        var dynamicUrl = "<?php echo URLROOT;?>/centermanagers/view_notification/center_workers";
        form.action = dynamicUrl; // Set the action URL
        form.submit(); // Submit the form

    };
    /* ----------------- */
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>