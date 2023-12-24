<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Main">
     <div class="Collector_Editprofile">
     <div class="main" >
        <?php require APPROOT . '/views/collectors/collector_sidebar/side_bar.php'; ?>
            <div class="main-right">
            <div class="main-right-top">
                    <p><?php echo $_SESSION['collector_name']?></p>
                    <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>" alt="">
                </div>
                <div class="main-right-bottom">
                    <div class="main-right-bottom-content" >

                        <div class="main-right-bottom-content-top">
                            <h1>Edit Profile</h1>
                            <div class="Edit-Profile-line"></div>
                        </div>
                        <div class="main-right-bottom-content-bottom" >
                            <form class="main-right-bottom-content-bottom-left" action="<?php echo URLROOT;?>/collectors/editprofile" method="post" enctype="multipart/form-data">
                                <div class="edit-profile-content-profile">
                                    <div class="edit-profile-content-profile-container">
                                        <img class="edit-profile-main-image" id="profile_image_placeholder" src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>" alt="">
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

                            <form class="main-right-bottom-content-bottom-right" action="<?php echo URLROOT;?>/collectors/change_password" method="post">
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
            </div>
            <?php if($data['change_pw_success']=='True') : ?>
               <div class="center_worker_success">
                  <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p><?php echo $data['success_message']?></p>
                    <a href="<?php echo URLROOT?>/collectors/editprofile"><button type="button" >OK</button></a>

                  </div>
               </div>
             <?php endif; ?>
     </div>   
      <script src="<?php echo JSROOT?>/Collector_Edit_Profile.js"> </script>        

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
