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
            <img src="<?php echo IMGROOT?>/img_upload/center_manager/<?php echo $_SESSION['cm_profile']?>" alt="">
            <div class="main-right-top-profile-cont">
                <h3><?php echo $_SESSION['center_manager_name']?></h3>
                <p>ID : C <?php echo $_SESSION['center_manager_id']?></p>
            </div>
        </div>
    </div>
    <div class="main-right-top-two">
        <h1>Requests</h1>
    </div>
    <div class="main-right-top-three">
        <a href="<?php echo URLROOT?>/centermanagers/request_incomming" id="incoming">

            <div class="main-right-top-three-content" id="current">
                <p>Incoming</p>
                <div class="line"></div>
            </div>
        </a>
        <a href="<?php echo URLROOT?>/centermanagers/request_assigned" id="assigned">
            <div class="main-right-top-three-content">
                <p>Assigned</p>
                <div class="line"></div>
            </div>
        </a>

        <a href="<?php echo URLROOT?>/centermanagers/request_completed" id="completed">
            <div class="main-right-top-three-content">
                <p>Completed</p>
                <div class="line"></div>
            </div>
        </a>
        <a href="<?php echo URLROOT?>/centermanagers/request_cancelled" id="cancelled">
            <div class="main-right-top-three-content">
                <p>Cancelled</p>
                <div class="line"></div>
            </div>
        </a>
    </div>
    <div class="main-right-top-four">
        <div class="main-right-top-four-left">
            <p>Date</p>
            <input type="date" id="selected-date">
            <button onclick="loadLocations()">Filter</button>
        </div>
        <div class="main-right-top-four-right">

            <div class="main-right-top-four-component" style="background-color: #ecf0f1" id="tables">
                <img src="<?php echo IMGROOT?>/cells.png" alt="">
                <p>Tables</p>
            </div>


            <div class="main-right-top-four-component" id="maps">
                <img src="<?php echo IMGROOT?>/map.png" alt="">
                <p>Maps</p>
            </div>


        </div>
    </div>
</div>