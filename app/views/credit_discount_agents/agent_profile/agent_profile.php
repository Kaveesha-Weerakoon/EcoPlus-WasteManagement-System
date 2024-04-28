<div class="main-right-top-profile">
    <img src="<?php echo IMGROOT?>/img_upload/credit_discount_agent/<?php echo $_SESSION['agent_profile']?>" alt="">
    <div class="main-right-top-profile-cont">
        <h3><?php
$user_name = $_SESSION['agent_name'];
$name_parts = explode(' ', $user_name);
$first_name = $name_parts[0];
echo $first_name;
?></h3>
        <p>ID: 
            <?php echo $_SESSION['agent_id'] ?>
        </p>

    </div>
</div>