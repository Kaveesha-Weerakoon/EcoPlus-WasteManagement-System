<div class="main-right-top-profile">
    <img src="<?php echo IMGROOT?>/Admin.png" alt="">
    <div class="main-right-top-profile-cont">
        <h3><?php
$user_name = $_SESSION['admin_name'];
$name_parts = explode(' ', $user_name);
$first_name = $name_parts[0];
echo $first_name;
?></h3>
        <p>ID:
            <?php if(isset($_SESSION['superadmin_id'])) echo $_SESSION['superadmin_id']; elseif(isset($_SESSION['admin_id'])) echo $_SESSION['admin_id']; ?>
        </p>

    </div>
</div>