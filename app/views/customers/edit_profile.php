<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Editprofile">
        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <?php if (!empty($data['notification'])) : ?>
                        <div class="dot"></div>
                        <?php endif; ?>
                    </div>
                    <div class="main-right-top-notification" id="notification">
                        <i class='bx bx-bell'></i>
                        <?php if (!empty($data['notification'])) : ?>
                        <div class="dot"><?php echo count($data['notification'])?></div>
                        <?php endif; ?>
                    </div>
                    <div id="notification_popup" class="notification_popup">
                        <h1>Notifications</h1>
                        <div class="notification_cont">
                            <?php foreach($data['notification'] as $notification) : ?>

                            <div class="notification">
                                <div class="notification-green-dot">

                                </div>
                                <div class="notification_right">
                                    <p><?php echo date('Y-m-d', strtotime($notification->datetime)); ?></p>
                                    <?php echo $notification->notification ?>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                        <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/customers/">
                            <i class="fa-solid fa-check"> </i>
                            <button type="submit">Mark all as read</button>
                        </form>

                    </div>
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-content">

                        <div class="main-right-bottom-content-top">
                            <h1>Profile</h1>
                            <div class="Edit-Profile-line"></div>
                        </div>
                        <div class="main-right-bottom-content-bottom">
                            <form class="main-right-bottom-content-bottom-left"
                                action="<?php echo URLROOT;?>/customers/editprofile" method="post"
                                enctype="multipart/form-data">
                                <div class="edit-profile-content-profile">
                                    <div class="edit-profile-content-profile-container">
                                        <img class="edit-profile-main-image" id="profile_image_placeholder"
                                            src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                                            alt="">
                                        <img class="edit-profile-second-image" src="<?php echo IMGROOT?>/edit-icon.png"
                                            alt="">
                                        <input name='profile_image' type="file" id="profile_image">
                                    </div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Name </h3>
                                    <input name="name" type="text" value="<?php echo $data['name']?>">
                                    <div class="err"><?php echo $data['name_err']?></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3>Email </h3>
                                    <input name="email" type="text" value="<?php echo $data['email']?>" readonly>
                                    <div class="err"></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3>Region</h3>
                                    <select name="region" id="centerDropdown">
                                        <?php
                                              $centers = $data['centers'];
                                              $selectedRegion = $data['city'];
                                              $regionFound = false;

                                        if (!empty($centers)) {
                                           foreach ($centers as $center) {
                                               $selected = ($center->region == $selectedRegion) ? 'selected' : '';

                                               if ($selected) {
                                                  $regionFound = true;
                                               }
        
                                            echo "<option value=\"$center->region\" $selected>$center->region</option>";
                                        }

                                        if (!$regionFound) {
                                            echo "<option value=\"default\" selected>$selectedRegion</option>";
                                         }
                                        } else {
                                             echo "<option value=\"default\">No Centers Available</option>";
                                         }
                                          ?>
                                    </select>
                                    <div class="err1">Choose the closest center for your location! </div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3>Address </h3>
                                    <input name="address" type="text" value="<?php echo $data['address']?>">
                                    <div class="err"><?php echo $data['address_err']?></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3>Contact Number </h3>
                                    <input name="contactno" type="text" value="<?php echo $data['contactno']?>">
                                    <div class="err"><?php echo $data['contactno_err']?></div>

                                </div>


                                <button type="submit">Save</button>


                            </form>

                            <form class="main-right-bottom-content-bottom-right"
                                action="<?php echo URLROOT;?>/customers/change_password" method="post">
                                <div class="edit-profile-content">
                                    <h3>Current Password </h3>
                                    <input type="password" name="current" value="<?php echo $data['current']?>">
                                    <div class="err"><?php echo $data['current_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>New Password </h3>
                                    <input type="password" name="new_pw" value="<?php echo $data['new_pw']?>">
                                    <div class="err"><?php echo $data['new_pw_err']?></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3> Re-enter Password </h3>
                                    <input type="password" name="re_enter_pw" value="<?php echo $data['re_enter_pw']?>">
                                    <div class="err"><?php echo $data['re_enter_pw_err']?></div>

                                </div> <button type=submit>Change Password</button>
                            </form>
                        </div>
                        <div class="main-right-bottom-content-delete-account">
                            <div class="main-right-bottom-content-delete-account-cont" onClick="delete_confirm()">
                                <i class="fa-solid fa-trash-can"></i>
                                <p>Delete My Account</p>
                            </div>
                        </div>
                    </div>
                    <div class="overlay" id="overlay">

                    </div>
                </div>
            </div>
            <form class="delete_confirm" id="cancel_confirm" action="<?php echo URLROOT;?>/customers/deleteaccount"
                method="post">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/exclamation.png" alt="">
                    <h2>Delete Account?</h2>
                    <p>This action is permanent and irreversible. Confirm?</p>
                    <div class="btns">
                        <a id="cancelLink"><button type="submit" class="deletebtn">Confirm</button></a>
                        <a id="close_delete"><button type="button" class="cancelbtn">Cancel</button></a>
                    </div>
                </div>
            </form>
            <?php if($data['change_pw_success']=='True') : ?>
            <div class="center_worker_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p><?php echo $data['success_message']?></p>
                    <a href="<?php echo URLROOT?>/customers/editprofile"><button type="button">OK</button></a>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
    var notification = document.getElementById("notification");
    var notification_pop = document.getElementById("notification_popup");
    notification_pop.style.height = "0px";

    notification.addEventListener("click", function() {
        var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

        if (!isNotificationEmpty) {
            var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
            if (notification_pop.style.height === "0px") {
                if (notificationArraySize >= 3) {
                    notification_pop.style.height = "200px";
                }
                if (notificationArraySize == 2) {
                    notification_pop.style.height = "150px";
                }
                if (notificationArraySize == 1) {
                    notification_pop.style.height = "105px";
                }
                notification_pop.style.visibility = "visible";
                notification_pop.style.opacity = "1";
                notification_pop.style.padding = "7px";
            } else {
                notification_pop.style.height = "0px";
                notification_pop.style.visibility = "hidden";
                notification_pop.style.opacity = "0";
            }
        }
    });

    function delete_confirm() {
        document.getElementById('overlay').style.display = "flex";
        var locationPop = document.querySelector('.delete_confirm ');
        locationPop.classList.add('active');
    }

    document.getElementById('close_delete').onclick = function() {
        document.getElementById('overlay').style.display = "none"; // Fix the syntax error here
        var locationPop = document.querySelector('.delete_confirm');
        locationPop.classList.remove('active');
    };
    </script>

    <script src="<?php echo JSROOT?>/Customer_Edit_Profile.js"> </script>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>