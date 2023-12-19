<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="Customer_Main">
    <div class="Customer_History_Top">
        <div class="Customer_Main_History">
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
                                <div class="dot"></div>
                            </div>
                            <div id="notification_popup" class="notification_popup">
                                <h1>Notifications</h1>
                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    Request 1232 Has been Cancelled
                                </div>
                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    Request 1232 Has been Assigned
                                </div>
                                <div class="notification">
                                    <div class="notification-green-dot">

                                    </div>
                                    Request 1232 Has been Cancelled
                                </div>


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
                            <h1>History</h1>
                        </div>
                        <div class="main-right-top-three">
                            <a href="<?php echo URLROOT?>/customers/history">
                                <div class="main-right-top-three-content">
                                    <p><b style="color: #1ca557;">Discounts</b></p>
                                    <div class="line"></div>
                                </div>
                            </a>

                            <a href="<?php echo URLROOT?>/customers/history_complains">
                                <div class="main-right-top-three-content">
                                    <p>Complaints</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT?>/customers/transfer_history">
                                <div class="main-right-top-three-content">
                                    <p>Transfer</p>
                                    <div class="line1"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="main-right-bottom">
                        <div class="main-right-bottom-two">
                            <div class="main-right-bottom-two-content">
                                <img src="<?php echo IMGROOT?>/DataNotFound.jpg" alt="">
                                <h1>You Have No Discounts On Supermarkets</h1>
                                <p></p>

                            </div>
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
        if (notification_pop.style.height === "0px") {
            notification_pop.style.height = "28%";
            notification_pop.style.visibility = "visible";
            notification_pop.style.opacity = "1";
            notification_pop.style.padding = "7px";
        } else {
            notification_pop.style.height = "0px";
            notification_pop.style.visibility = "hidden";
            notification_pop.style.opacity = "0";
        }
    });
    </script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>