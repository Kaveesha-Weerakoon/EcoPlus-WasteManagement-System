<div class="main-right-top-notification" id="notification">
    <i class='bx bx-bell'></i>
    <?php if (!empty($data['notification'])) : ?>
    <div class="dot"><?php echo count($data['notification'])?></div>
    <?php endif; ?>
</div>
<div id="notification_popup" class="notification_popup">
    <h1>Notifications</h1>
    <div class="notification_cont">
        <?php foreach($data['notification'] as $notification) : ?>

        <div class="notification">
            <div class="notification-green-dot">

            </div>
            <div class="notification_right">
                <p><?php echo date('Y-m-d', strtotime($notification->datetime)); ?></p>
                <?php echo $notification->notification ?>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <form class="mark_as_read" id="mark_as_read" method="post">
        <i class="fa-solid fa-check"> </i>
        <button id="submit-notification">Mark all as read</button>
    </form>

</div>
<div class="main-right-top-profile" onclick="navigateToLocation()">
    <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
    <div class="main-right-top-profile-cont">
        <h3><?php
$user_name = $_SESSION['user_name'];
$name_parts = explode(' ', $user_name);
$first_name = $name_parts[0];
echo $first_name;
?>
        </h3>
        <p>ID : <?php echo $_SESSION['user_id']?></p>

    </div>
</div>

<script>
var notification = document.getElementById("notification");
var notification_pop = document.getElementById("notification_popup");
notification_pop.style.height = "0px";

notification.addEventListener("click", function() {
    var isNotificationEmpty = <?php echo json_encode(empty($data['notification'])); ?>;

    if (!isNotificationEmpty) {
        var notificationArraySize = <?php echo json_encode(count($data['notification'])); ?>;
        if (notification_pop.style.height === "0px") {
            if (notificationArraySize >= 3) {
                notification_pop.style.height = "210px";
            }
            if (notificationArraySize == 2) {
                notification_pop.style.height = "150px";
            }
            if (notificationArraySize == 1) {
                notification_pop.style.height = "105px";
            }
            notification_pop.style.visibility = "visible";
            notification_pop.style.opacity = "1";
            notification_pop.style.padding = "7px";
        } else {
            notification_pop.style.height = "0px";
            notification_pop.style.visibility = "hidden";
            notification_pop.style.opacity = "0";
        }
    }
});

function navigateToLocation() {
    window.location.href = '<?php echo URLROOT?>/customers/editprofile';
}
</script>