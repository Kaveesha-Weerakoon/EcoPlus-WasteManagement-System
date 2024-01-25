<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_Complains">

        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-top">
                    <div class="main-right-top-search">
                        <i class='bx bx-search-alt-2'></i>
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
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
                        <form class="mark_as_read" method="post"
                            action="<?php echo URLROOT;?>/customers/view_notification/complains">
                            <i class="fa-solid fa-check"> </i>
                            <button type="submit">Mark all as Read</button>
                        </form>

                    </div>
                    <div class="main-right-top-profile">
                        <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                            alt="">
                        <div class="main-right-top-profile-cont">
                            <h3><?php echo $_SESSION['user_name']?></h3>
                            <p>ID : C <?php echo $_SESSION['user_id']?></p>
                        </div>
                    </div>
                </div>
                <div class="main-bottom">
                    <div class="main-bottom-component">
                        <form class="main-bottom-component-left" action="<?php echo URLROOT;?>/customers/complains"
                            method="post">
                            <div class="main-bottom-component-left-topic">
                                <h2>Make a Complaint</h2>
                                <div class="line"></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Name</h2>
                                <input value="<?php echo $data['name']; ?>" type="text" name="name" placeholder="Name">
                                <div class="err"><?php echo $data['name_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Contact Number</h2>
                                <input value="<?php echo $data['contact_no']; ?>" name="contact_no" type="text"
                                    placeholder="Contact Number">
                                <div class="err"><?php echo $data['contact_no_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Region</h2>
                                <input type="text" value="<?php echo $data['region']; ?>" name="region"
                                    placeholder="Region">
                                <div class="err"><?php echo $data['region_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Subject</h2>
                                <input value="<?php echo $data['subject']; ?>" name="subject" type="text"
                                    placeholder="Subject">
                                <div class="err"><?php echo $data['subject_err']; ?></div>
                            </div>

                            <div class="main-bottom-component-left-component">
                                <h2>Complaint</h2>
                                <input value="<?php echo $data['complain']; ?>" name="complain" type="text"
                                    placeholder="Complain">
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
                <?php if($data['completed']=='True') : ?>
                <div class="complain_success" style="">
                    <div class="popup" id="popup">
                        <img src="<?php echo IMGROOT?>/check.png" alt="">
                        <h2>Success!!</h2>
                        <p>Complaint has been reported successfully</p>
                        <a href="<?php echo URLROOT?>/customers/history_complains"><button type="button">OK</button></a>


                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>

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
                notification_pop.style.height = "198px";
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
<script src="<?php echo JSROOT?>/Customer.js"> </script>

<?php require APPROOT . '/views/inc/footer.php'; ?>