<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Center_Manager">
  <div class="Admin_Center_Manager_Add">
     <div class="main">
            <div class="main-top">
                <a href="<?php echo URLROOT?>/admin">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>
                <div class="main-top-component">
                    <p>Admin</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-bottom">
                <div class="main-bottom-top">
                    <div class="main-right-top-two">
                        <h1>Center Managers</h1>
                    </div>
                    <div class="main-right-top-three">
                    <a href="<?php echo URLROOT?>/admin/center_managers">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="./add.html">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Add</b></p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="main-bottom-down">
                    <hr width="100%">
                    <h1>Add Center Managers</h1>
                    
                     <form class="main-right-bottom-content" action="<?php echo URLROOT;?>/admin/center_managers_add" method="post" enctype="multipart/form-data">
                        <div class="main-right-bottom-content-top">
                         
                            <div class="main-right-bottom-content-content">
                                <h2>Name</h2>
                                <input type="text" name="name" value="<?php echo $data['name']; ?>">
                                <div class="err"><?php echo $data['name_err']?></div>
                            </div>
                            <div class="form-drag-area">
                                <div class="icon">
                                    <img src="<?php echo IMGROOT;?>/img_upload/placeholder.png" alt="PLACEHOLDER" width="90px" heigh="90px" id="profile_image_placeholder">
                                </div>
                                <div class="right-content">
                                    <div class="description">
                                        Drap & Drop to Upload File
                                    </div>
                                    <div class="form-upload">
                                        <input type="file" name="profile_image" id="profile_image">
                                        Browse File
                                    </div>
                                    <div class="form-validation">
                                        <div class="profile-image-validation">
                                            <img src="<?php echo IMGROOT?>/checked.png" alt="green_tik" width="20px" height="20px">
                                            Select a Profile picture
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="main-right-bottom-content-content">
                                <h2>NIC</h2>
                                <input type="text" name="nic" value="<?php echo $data['nic']; ?>">
                                <div class="err"><?php echo $data['nic_err']?></div>
                            </div>
                            <div class="main-right-bottom-content-content"  >
                                <h2>Address</h2>
                                <input type="text" name="address"  value="<?php echo $data['address']; ?>">
                                <div class="err"><?php echo $data['address_err']?></div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <h2>Contact No</h2>
                                <input type="text" name="contact_no"  value="<?php echo $data['contact_no']; ?>">
                                <div class="err"><?php echo $data['contact_no_err']?></div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <h2>DOB</h2>
                                <input type="date" name="dob" value="<?php echo $data['dob']; ?>">
                                <div class="err"><?php echo $data['dob_err']?></div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <h2>Email</h2>
                                <input type="text" name="email" value="<?php echo $data['email']; ?>">
                                <div class="err"><?php echo $data['email_err']?></div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <h2>Password</h2>
                                <input type="password" name="password" value="<?php echo $data['password']; ?>">
                                <div class="err"><?php echo $data['password_err']?></div>
                            </div>
                            <div class="main-right-bottom-content-content">
                                <h2>Re enter Password</h2>
                                <input type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>">
                                <div class="err"><?php echo $data['confirm_password_err']?></div>
                            </div>
                        </div>
                        <div class="main-right-bottom-content-down">
                            <div class="main-right-bottom-content-content a">
                                <button>ADD</button>
                            </div>
                        </div>
                     </form>
                    
                </div>
            </div>    
            <script src="<?php echo JSROOT?>/Admin_Center_Manager.js"> </script>        
    </div>


    <?php if($data['registered']=='True') : ?>
    <div class="center_manager_success">
      <div class="popup" id="popup">
          <img src="<?php echo IMGROOT?>/check.png" alt="">
          <h2>Success!!</h2>
          <p>Center Manager has been registered successfully</p>
          <a href="<?php echo URLROOT?>/admin/center_managers_add"><button type="button" >OK</button></a>

      </div>
    </div>
    <?php endif; ?>
   
</div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>
