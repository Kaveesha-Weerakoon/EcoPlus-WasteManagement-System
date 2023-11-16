<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="Collector_assistant_add">
  <div class="main">
    <div class="main-left" style="background: #8CF889;">
      <div class="main-left-top">
        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
        <h1>Eco Plus</h1>
      </div>
      <!-- Aligning properly -->
      <div class="main-left-middle">
        <a href="<?php echo IMGROOT?>/Collector_DashBoard.html">
          <div class="main-left-middle-content">
            <div class="main-left-middle-content-line1"></div>
            <img src="<?php echo IMGROOT?>/Home.png" alt="">
            <h2>Dashboard</h2>
          </div>
        </a>
        <a href="">
          <div class="main-left-middle-content">
            <div class="main-left-middle-content-line1"></div>
            <img src="<?php echo IMGROOT?>/Request.png" alt="">
            <h2>Requests</h2>
          </div>
        </a>
        <a href="<?php echo URLROOT?>/collectors/collector_assistants">
          <div class="main-left-middle-content current">
            <div class="main-left-middle-content-line"></div>
            <img src="<?php echo IMGROOT?>/CollectorAssis.png" alt="">
            <h2>Collector Assistants</h2>
          </div>
        </a>
        <a href="">
          <div class="main-left-middle-content">
            <div class="main-left-middle-content-line1"></div>
            <img src="<?php echo IMGROOT?>/EditProfile.png" alt="">
            <h2>Edit Profile</h2>
          </div>
        </a>
      </div>
      <div class="main-left-bottom">
        <a href="<?php echo URLROOT?>/collectors/logout">
          <div class="main-left-bottom-content">
            <img src="<?php echo IMGROOT?>/logout.png" alt="">
            <p>Log out</p>
          </div>
        </a>
      </div>
    </div>
    <div class="main-right">
         <div class="main-right-top">
                    <div class="main-right-top-one">
                      
                        <div class="main-right-top-one-content">
                           <p><?php echo $_SESSION['collector_name']?></p>
                           <img src="<?php echo IMGROOT?>/Profile2.png" alt="">
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Collector Assistants</h1>
                    </div>
                    <div class="main-right-top-three">
                        <a href="<?php echo URLROOT?>/collectors/collector_assistants">
                            <div class="main-right-top-three-content">
                                <p>View</p>
                                <div class="line1"></div>
                            </div>
                       </a>
                        <a href="">
                            <div class="main-right-top-three-content">
                                <p><b style="color: #1B6652;">Register</b></p>
                                <div class="line"></div>
                            </div>
                        </a>

                    </div>
         </div>
      <div class="main-bottom">
       
        <div class="main-bottom-down">
          <div class="form-container">
            <div class="form-title">Registration form</div>
            <form action="<?php echo URLROOT;?>/collectors/collector_assistants_add" class="main-right-bottom-content" method="post">
              <div class="user-details">
              <div class="main-right-bottom-content-content">
                            <span class="details">Name</span>
                            <input name="name" type="text" placeholder="Enter Name" value="<?php echo $data['name'];?>">
                            <div class="error-div" style="color:red">
                                    <?php echo $data['name_err']?>
                            </div>
                        </div>
                        <div class="main-right-bottom-content-content">
                            <span class="details">NIC</span>
                            <input name="nic" type="text" placeholder="Enter NIC" value=<?php echo $data['nic'];?>>
                            <div class="error-div" style="color:red">
                                    <?php echo $data['nic_err']?>
                            </div>
                        </div>
                        <div class="main-right-bottom-content-content">
                            <span class="details">DOB</span>
                            <input name="dob" type="date" placeholder="Enter DOB" value="<?php echo $data['dob']?>">
                            <div class="error-div" style="color:red">
                                    <?php echo $data['dob_err']?>
                            </div>
                        </div>
                        <div class="main-right-bottom-content-content">
                            <span class="details">Contact No</span>
                            <input name="contact_no" type="text" placeholder="Enter Contact No" value="<?php echo $data['contact_no']?>">
                            <div class="error-div" style="color:red">
                                    <?php echo $data['contact_no_err']?>
                            </div>
                        </div>
                        <div class="main-right-bottom-content-content A">
                            <span class="details">Address</span>
                            <input name="address" type="text" placeholder="Enter Address" value="<?php echo $data['address']?>">
                            <div class="error-div" style="color:red">
                                    <?php echo $data['address_err']?>
                            </div>
                        </div>
              </div>
              <div class="form-button">
                <button type="submit">REGISTER</button>
              </div>
            </form>
          </div>
          <?php if($data['registered']=='True') : ?>
            <div class="center_worker_success">
              <div class="popup" id="popup">
                <img src="<?php echo IMGROOT?>/check.png" alt="">
                <h2>Success!!</h2>
                <p>collector Assistant has been registered successfully</p>
                <a href="<?php echo URLROOT?>/collectors/collector_assistants"><button type="button" >OK</button></a>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>