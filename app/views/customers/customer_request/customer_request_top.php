<div class="main-right-top">
    <div class="main-right-top-one">
        <div class="main-right-top-search">
            <i class='bx bx-search-alt-2'></i>
            <input type="text" id="searchInput" placeholder="Search">
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
</div>