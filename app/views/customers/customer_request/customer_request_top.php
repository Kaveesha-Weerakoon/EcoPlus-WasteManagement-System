<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
    async defer>
</script>
<div class="main-right-top">
    <div class="main-right-top-one">
        <div class="main-right-top-search">
            <i class='bx bx-search-alt-2'></i>
            <input type="text" id="searchInput" placeholder="Search">
        </div>
        <div class="main-right-top-notification" id="notification">
            <i class='bx bx-bell'></i>
            <?php if (!empty($data['notification'])) : ?>
            <div class="dot"></div>
            <?php endif; ?>
        </div>
        <div id="notification_popup" class="notification_popup">
            <h1>Notifications</h1>
            <div class="notification_cont">
                <?php foreach($data['notification'] as $notification) : ?>

                <div class="notification">
                    <div class="notification-green-dot">

                    </div>
                    <?php echo $notification->notification?>
                </div>
                <?php endforeach; ?>

            </div>
            <form class="mark_as_read" method="post" action="<?php echo URLROOT;?>/customers/">
                <i class='bx bx-signal-4'></i>
                <button type="submit">Mark all as read</button>
            </form>

        </div>
        <div class="main-right-top-profile">
            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>" alt="">
            <div class="main-right-top-profile-cont">
                <h3>Kaveesha</h3>
                <p>ID : C <?php echo $_SESSION['user_id']?></p>
            </div>
        </div>
    </div>
    <div class="main-right-top-two">
        <h1>Requests</h1>
    </div>
    <div class="main-right-top-three">
        <a href="<?php echo URLROOT?>/customers/request_main" id="current">

            <div class="main-right-top-three-content" id="current">
                <p>Current</p>
                <div class="line"></div>
            </div>
        </a>

        <a href="<?php echo URLROOT?>/customers/request_completed" id="completed">
            <div class="main-right-top-three-content">
                <p>Completed</p>
                <div class="line"></div>
            </div>
        </a>
        <a href="<?php echo URLROOT?>/customers/request_cancelled" id="cancelled">
            <div class="main-right-top-three-content">
                <p>Cancelled</p>
                <div class="line"></div>
            </div>
        </a>
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
                    notification_pop.style.height = "200px";
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
</div>