<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Center_Top">
    <div class="Admin_Center_Add">
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
                        <h1>Centers</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/Admin/Center">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line1"></div>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT?>/admin/center_add">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Add</b></p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="main-bottom-down">
                      <div class="main-bottom-down-top">
                            <div class="main-bottom-down-top-content">
                                <img src="<?php echo IMGROOT?>/Admin_Center.png" alt="">
                                <p>Add Centers</p>
                            </div>
                            
                      </div>
                      <form  class="main-bottom-down-down" type="post">
                           
                                      
                                      <div class="main-bottom-down-down-content">
                                              <p>Region</p>
                                              <input type="text">
                                      </div>
                                      

                                      <div class="main-bottom-down-down-content">
                                              <p>District</p>
                                              <input type="text">
                                      </div>

                                      <div class="main-bottom-down-down-content">
                                              <p>Address</p>
                                              <input type="text">
                                      </div>
                                      <div class="main-bottom-down-down-content">
                                              <p>Center Manager</p>
                                              <input type="text">
                                      </div>
                                      <button class="Create_Center_Button" type="submit">
                                          Create Center
                                      </button>

                           
                          
                      </form>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>