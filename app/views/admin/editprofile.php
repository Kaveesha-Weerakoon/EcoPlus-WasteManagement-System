<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Main">
    <div class="Admin_EditProfile">

        <div class="main">
            <?php require APPROOT . '/views/admin/admin_sidebar/side_bar.php'; ?>

            <div class="main-right">
                <?php if(isset($_SESSION['admin_id'])): ?>
                <div class="main-right-top">
                    <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>



                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-content">
                        <div class="main-right-bottom-content-top">
                            <h1>Edit Profile</h1>
                            <div class="Edit-Profile-line"></div>
                        </div>
                        <div class="main-right-bottom-content-bottom">
                            <form class="main-right-bottom-content-bottom-left"
                                action="<?php echo URLROOT;?>/admin/edit_profile" method="post"
                                enctype="multipart/form-data">
                                <div class="edit-profile-content-profile">
                                    <div class="edit-profile-content-profile-container">
                                        <img class="edit-profile-main-image" id="profile_image_placeholder"
                                            src="<?php echo IMGROOT?>/img_upload/Admin/<?php echo  $_SESSION['admin_profile'] ?>"
                                            alt="">
                                        <img class="edit-profile-second-image" src="<?php echo IMGROOT?>/edit-icon.png"
                                            alt="">
                                        <input name='profile_image' type="file" id="profile_image">
                                    </div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Name :</h3>
                                    <input name="name" type="text" value="<?php echo $data['name']?>">
                                    <div class="err"><?php echo $data['name_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Email </h3>
                                    <input name="email" type="text" value="<?php echo $data['email']?>" readonly>
                                    <div class="err"></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3>Address :</h3>
                                    <input name="address" type="text" value="<?php echo $data['address']?>">
                                    <div class="err"><?php echo $data['address_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Contact Number :</h3>
                                    <input name="contactno" type="text" value="<?php echo $data['contactno']?>">
                                    <div class="err"><?php echo $data['contactno_err']?></div>
                                </div>

                                <button type="submit">Save</button>
                            </form>

                            <form class="main-right-bottom-content-bottom-right"
                                action="<?php echo URLROOT;?>/admin/change_password" method="post">
                                <div class="edit-profile-content">
                                    <h3>Current Password :</h3>

                                    <input type="password" name="current" value="<?php echo $data['current']?>">
                                    <div class="err"><?php echo $data['current_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>New Password :</h3>

                                    <input type="password" name="new_pw" value="<?php echo $data['new_pw']?>">
                                    <div class="err"><?php echo $data['new_pw_err']?></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3> Re-enter Password :</h3>

                                    <input type="password" name="re_enter_pw" value="<?php echo $data['re_enter_pw']?>">
                                    <div class="err"><?php echo $data['re_enter_pw_err']?></div>

                                </div> <button type=submit>Change Password</button>
                            </form>
                        </div>

                    </div>
                </div>




                <?php elseif(isset($_SESSION['superadmin_id'])): ?>
                <div class="main-right-top">
                    <?php require APPROOT . '/views/admin/admin_profile/adminprofile.php'; ?>



                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-content-sup">
                        <div class="main-right-bottom-content-top B">
                            <h1>Edit Profile</h1>
                            <div class="Edit-Profile-line D"></div>
                        </div>
                        <div class="main-right-bottom-content-bottom E">
                            <!-- <form class="main-right-bottom-content-bottom-left" action="<?php echo URLROOT;?>/admin/edit_profile" method="post" enctype="multipart/form-data">
                                    <div class="edit-profile-content-profile">
                                        <div class="edit-profile-content-profile-container">
                                            <img class="edit-profile-main-image" id="profile_image_placeholder" src="<?php echo IMGROOT?>/img_upload/Admin/<?php echo  $_SESSION['admin_profile'] ?>" alt="">
                                            <img class="edit-profile-second-image" src="<?php echo IMGROOT?>/edit-icon.png" alt="">
                                            <input name='profile_image' type="file" id="profile_image">
                                        </div>
                                    </div>
                                    <div class="edit-profile-content">
                                        <h3>Name :</h3>
                                        <input name="name" type="text" value="<?php echo $data['name']?>">
                                        <div class="err"><?php echo $data['name_err']?></div>
                                    </div>
                                    <div class="edit-profile-content">
                                        <h3>Email </h3>                                  
                                        <input name="email" type="text" value="<?php echo $data['email']?>" readonly>
                                        <div class="err"></div>

                                    </div>
                                    <div class="edit-profile-content">
                                        <h3>Address :</h3>
                                        <input name="address"  type="text" value="<?php echo $data['address']?>">
                                        <div class="err"><?php echo $data['address_err']?></div>
                                    </div>
                                    <div class="edit-profile-content">
                                        <h3>Contact Number :</h3>
                                        <input name="contactno" type="text" value="<?php echo $data['contactno']?>">
                                        <div class="err"><?php echo $data['contactno_err']?></div>
                                    </div>
                                                            
                                    <button type="submit">Save</button>                                                     
                                </form> -->

                            <form class="main-right-bottom-content-bottom-right A"
                                action="<?php echo URLROOT;?>/admin/change_password" method="post">
                                <div class="edit-profile-content sup">
                                    <h3>Current Password :</h3>

                                    <input type="password" name="current" value="<?php echo $data['current']?>">
                                    <div class="err"><?php echo $data['current_err']?></div>
                                </div>
                                <div class="edit-profile-content sup">
                                    <h3>New Password :</h3>

                                    <input type="password" name="new_pw" value="<?php echo $data['new_pw']?>">
                                    <div class="err"><?php echo $data['new_pw_err']?></div>

                                </div>
                                <div class="edit-profile-content sup">
                                    <h3> Re-enter Password :</h3>

                                    <input type="password" name="re_enter_pw" value="<?php echo $data['re_enter_pw']?>">
                                    <div class="err"><?php echo $data['re_enter_pw_err']?></div>

                                </div> <button class="change-pw-button" type=submit>Change Password</button>
                            </form>
                        </div>

                    </div>
                </div>



                <?php endif ?>
            </div>
            <!-- <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                    <div class="main-right-top-notification" id="notification" style ="visibility: hidden;">
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
                        <img src="<?php echo IMGROOT?>/img_upload/Admin/<?php echo $_SESSION['admin_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3>
                                <?php echo $_SESSION['admin_name']?>
                            </h3>
                            <p>ID : A
                                <?php 
                                    if(isset($_SESSION['admin_id'])){
                                        echo $_SESSION['admin_id']; 
                                    } else if(isset($_SESSION['superadmin_id'])){
                                        echo $_SESSION['superadmin_id']; 
                                    }
                                ?>    
                            </p>
                        </div>
                    </div>
                   

                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-content" >
                        <div class="main-right-bottom-content-top">
                            <h1>Edit Profile</h1>
                            <div class="Edit-Profile-line"></div>
                        </div>
                        <div class="main-right-bottom-content-bottom" >
                            <form class="main-right-bottom-content-bottom-left" action="<?php echo URLROOT;?>/admin/edit_profile" method="post" enctype="multipart/form-data">
                                <div class="edit-profile-content-profile">
                                    <div class="edit-profile-content-profile-container">
                                        <img class="edit-profile-main-image" id="profile_image_placeholder" src="<?php echo IMGROOT?>/img_upload/Admin/<?php echo  $_SESSION['admin_profile'] ?>" alt="">
                                        <img class="edit-profile-second-image" src="<?php echo IMGROOT?>/edit-icon.png" alt="">
                                        <input name='profile_image' type="file" id="profile_image">
                                    </div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Name :</h3>
                                    <input name="name" type="text" value="<?php echo $data['name']?>">
                                    <div class="err"><?php echo $data['name_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Email </h3>                                  
                                    <input name="email" type="text" value="<?php echo $data['email']?>" readonly>
                                    <div class="err"></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3>Address :</h3>
                                    <input name="address"  type="text" value="<?php echo $data['address']?>">
                                    <div class="err"><?php echo $data['address_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>Contact Number :</h3>
                                    <input name="contactno" type="text" value="<?php echo $data['contactno']?>">
                                    <div class="err"><?php echo $data['contactno_err']?></div>
                                </div>
                                                          
                                   <button type="submit">Save</button>                                                     
                            </form>

                            <form class="main-right-bottom-content-bottom-right" action="<?php echo URLROOT;?>/admin/change_password" method="post">
                                <div class="edit-profile-content">
                                    <h3>Current Password :</h3>
                             
                                    <input type="password" name="current" value="<?php echo $data['current']?>">
                                    <div class="err"><?php echo $data['current_err']?></div>
                                </div>
                                <div class="edit-profile-content">
                                    <h3>New Password :</h3>
                            
                                    <input type="password" name="new_pw" value="<?php echo $data['new_pw']?>"> 
                                    <div class="err"><?php echo $data['new_pw_err']?></div>

                                </div>
                                <div class="edit-profile-content">
                                    <h3> Re-enter Password :</h3>
                                   
                                    <input type="password" name="re_enter_pw" value="<?php echo $data['re_enter_pw']?>">
                                    <div class="err"><?php echo $data['re_enter_pw_err']?></div>

                                </div> <button type=submit>Change Password</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div> -->
            <?php if($data['change_pw_success']=='True') : ?>
            <div class="center_worker_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p><?php echo $data['success_message']?></p>
                    <a href="<?php echo URLROOT?>/admin/edit_profile"><button type="button">OK</button></a>

                </div>
            </div>
            <?php endif; ?>

        </div>
        <script src="<?php echo JSROOT?>/Admin_Edit_Profile.js"> </script>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>