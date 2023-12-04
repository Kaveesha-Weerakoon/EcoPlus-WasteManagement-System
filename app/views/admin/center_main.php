<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Admin_Center_Main">
   <div class="main">
        <div class="main-top">
            <div class="main-top-top">
                <a href="<?php echo URLROOT?>/admin/center">
                    <img class="back-button" src="<?php echo IMGROOT?>/Back.png" alt="">
                </a>

                <div class="main-top-top-component">
                    <p>Admin</p>
                    <img src="<?php echo IMGROOT?>/Requests Profile.png" alt="">
                </div>
            </div>
            <div class="main-top-bottom">
                <div class="main-bottom-left">
                    <img src="<?php echo IMGROOT?>/Admin_Center.png" alt="">
                    <div class="main-bottom-left-component">
                        <p>CEN<?php echo $data['center']->id?></p>
                        <h4><?php echo $data['center']->region?></h4>
                    </div>            
                </div>
                <div class="main-bottom-right">
                    <img src="<?php echo IMGROOT?>/center_manager.png" alt="">
                    <div class="main-bottom-right-component">
                        <p>CM <?php echo $data['center']->center_manager_id?></p>
                        <h4><?php echo $data['center']->center_manager_name?></h4>
                    </div>
                    <a href="<?php echo URLROOT?>/admin/center_main_change_cm/<?php echo $data['center']->id?> ">
                    <button class="main-bottom-right_button">
                        Change
                    </button>
                    </a>    
                </div>
            </div>
      </div>
      <div class="main-bottom">
          
      </div>
   </div>
   <?php if($data['change_cm']=='True') : ?>
   <div class="change_center_manager_pop">
    <div class="change_center_manager">
        <form action="<?php echo URLROOT;?>/admin/center_main_change_cm/<?php echo $data['center']->id?>" method="post">
            <label for="centerManager">Selelct Center Manager</label>
            <select name="centerManager" id="centerManager">
                <?php
                $centerManagers = $data['not_assigned_cm'];
                if (!empty($centerManagers)) {
                    foreach ($centerManagers as $manager) {
                        echo "<option value=\"$manager->id\">CM $manager->id</option>";
                    }
                } else {
                    echo "<option value=\"default\">No Center Managers Available</option>";
                }
                ?>
            </select>
            <button type="submit">Change Center Manager</button>
            <a href="<?php echo URLROOT?>/admin/center_main/<?php echo $data['center']->id?>"><button type="button" class="cancel">Cancel</button></a>
        </form>
    </div>
   </div>
   <?php endif; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
