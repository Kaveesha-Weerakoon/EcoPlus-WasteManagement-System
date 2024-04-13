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
                <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/collectors/">
                      <i class="fa-solid fa-check"> </i>
                       <button type="submit">Mark all as read</button>
                 </form>

    </div>


    <div class="main-right-top-profile">
        <img src="<?php echo IMGROOT?>/img_upload/collector/<?php echo $_SESSION['collector_profile']?>"
        alt="">
              <div class="main-right-top-profile-cont">
                  <h3><?php echo $_SESSION['collector_name']?></h3>
                      <p>ID : C <?php echo $_SESSION['collector_id']?></p>
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
</script>





                