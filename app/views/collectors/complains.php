<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Collector_Complains">
    <div class="main">
      <div class="main-top">
        <a href="<?php echo URLROOT?>/collectors">
          <img class="back_button" src="<?php echo IMGROOT?>/Back.png" alt="" />
        </a>

        <div class="main-top-component">
          <p><?php echo $_SESSION['collector_name']?></p>
          <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="" />
        </div>
      </div>
      <div class="main-bottom">
        <div class="main-bottom-component" >
          <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/collectors/complains" method="post">
            <div class="main-bottom-component-left-topic">
              <h2>Make a Complain</h2>
              <div class="line"></div>
            </div>

            <div class="main-bottom-component-left-component">
              <h2>Name</h2>
              <input value="<?php echo $data['name']; ?>" type="text" name="name"  placeholder="Name">
              <div class="err"><?php echo $data['name_err']; ?></div>
            </div>

            <div class="main-bottom-component-left-component">
              <h2>Contact Number</h2>
              <input value="<?php echo $data['contact_no']; ?>" name="contact_no" type="text" placeholder="Contact Number">
              <div class="err"><?php echo $data['contact_no_err']; ?></div>
            </div>
      
            <div class="main-bottom-component-left-component">
              <h2>Subject</h2>
              <input value="<?php echo $data['subject']; ?>" name="subject" type="text" placeholder="Subject">
              <div  class="err"><?php echo $data['subject_err']; ?></div>
            </div>

            <div class="main-bottom-component-left-component">
               <h2>Complain</h2>
              <input value="<?php echo $data['complain']; ?>" name="complain" type="text" placeholder="Complain" class="complain">
              <div class="err"><?php echo $data['complain_err']; ?></div>
            </div>
            <div class="main-bottom-component-left-button">
              <button type="submit">Submit</button>
            </div>
          </form>
          <div class="main-bottom-component-right">
          <img src="<?php echo IMGROOT?>/makeComplaints.png" alt="" />
          </div>

      </div>

      </div>
    </div>
    <?php if($data['completed']=='True') : ?>
            <div class="collector_assistant_success">
                <div class="popup" id="popup">
                    <img src="<?php echo IMGROOT?>/check.png" alt="">
                    <h2>Success!!</h2>
                    <p>Complain has reported</p>
                    <a href="<?php echo URLROOT?>/collectors/complains"><button type="button" >OK</button></a>

                </div>
            </div>
    <?php endif; ?>
    
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>