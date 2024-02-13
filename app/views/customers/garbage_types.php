<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_GarbageTypes">
        <div class="main">
            <?php require APPROOT . '/views/customers/Customer_SideBar/side_bar.php'; ?>

            <div class="main-right">
                <div class="main-right-top">
                    <div class="main-right-top-one">
                        <div class="main-right-top-search">
                            <i class='bx bx-search-alt-2'></i>
                            <input type="text" placeholder="Search">
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
                                action="<?php echo URLROOT;?>/customers/view_notification/garbage_types">
                                <i class="fa-solid fa-check"> </i>
                                <button type="submit">Mark all as read</button>
                            </form>

                        </div>
                        <div class="main-right-top-profile">
                            <img src="<?php echo IMGROOT?>/img_upload/customer/<?php echo $_SESSION['customer_profile']?>"
                                alt="">
                            <div class="main-right-top-profile-cont">
                                <h3>Kaveesha</h3>
                                <p>ID : C <?php echo $_SESSION['user_id']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="main-right-top-two">
                        <h1>Garbage Types</h1>
                    </div>
                    <div class="main-right-top-three">
                        <h4>Meet minimum amounts(Per Kg) in a request to avoid fines</h4>
                    </div>
                </div>

                <div class="main-right-bottom">
                    <div class="main-right-bottom-container-container">
                        <div class="main-right-bottom-top">
                            <table class="table">
                                <tr class="table-header">
                                    <th>Type</th>
                                    <th>Minimum Quantity (in kg) We Are Collecting</th>
                                    <th>Credits per 1 Kilogram</th>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right-bottom-down">
                            <table class="table">
                                <?php foreach($data['garbage_types'] as $garbage_type) : ?>
                                <tr class="table-row">
                                    <td style="text-align: left;"><?php echo $garbage_type->name?></td>
                                    <td><?php echo $garbage_type->approximate_amount?></td>
                                    <td><?php echo $garbage_type->credits_per_waste_quantity?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
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
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>