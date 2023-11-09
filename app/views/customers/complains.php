<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Complains">
    <div class="main">
      <div class="main-top">
        <a href="<?php echo URLROOT?>/customers">
          <img class="back_button" src="<?php echo IMGROOT?>/Back.png" alt="" />
        </a>

        <div class="main-top-component">
          <p><?php echo $_SESSION['user_name']?></p>
          <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="" />
        </div>
      </div>
      <div class="main-bottom">
        <div class="main-bottom-left">
          <form class="main-bottom-left-component" action="<?php echo URLROOT;?>/customers/complains" method="post">
            <h2>Make Complaints</h2>
            <div class="line"></div>
          
            <div class="main-bottom-left-component-input">
              <p>Name :</p>
              <input type="text" name="name" value="<?php echo $data['name']; ?>"/>
              <p class="error"><?php echo $data['name_err']; ?></p>
            </div>

            <div class="main-bottom-left-component-input">
              <p>Contact Number :</p>
              <input type="text" name="contact_no" value="<?php echo $data['contact_no']; ?>"/>
              <p class="error"><?php echo $data['contact_no_err']; ?></p>
            </div>

            <div class="main-bottom-left-component-input">
              <p>Region :</p>
              <input type="text" name="region" value="<?php echo $data['region']; ?>"/>
              <p class="error"><?php echo $data['region_err']; ?></p>
            </div>

            <div class="main-bottom-left-component-input">
              <p>Subject :</p>
              <input type="text" name="subject" value="<?php echo $data['subject']; ?>"/>
              <p class="error"><?php echo $data['subject_err']; ?></p>
            </div>

            <div class="main-bottom-left-component-input A">
              <p>Complaint :</p>
              <input class="complaint-box" name="complain" type="text" value="<?php echo $data['complain']; ?>" />
              <p class="error"><?php echo $data['complain_err']; ?></p>
            </div>

            <button type="submit">Submit</button>

          </form>
        </div>
        <div class="main-bottom-right">
          <img src="<?php echo IMGROOT?>/makeComplaints.png" alt="" />
        </div>
      </div>
    </div>
    <?php if($data['completed']=='True') : ?>
    <div class="complain-success">
          <div class="complain-success-box">
                  <h1>Complaint Successful</h1>
                  <a href="<?php echo URLROOT?>/customers/complains"><button>Okay</button></a>
          </div>
    </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
