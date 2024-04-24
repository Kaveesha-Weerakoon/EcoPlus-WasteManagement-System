<div class="main-right-top">
    <div class="main-right-top-one">
        <div class="main-right-top-search">
            <i class='bx bx-search-alt-2'></i>
            <input type="text" id="searchInput" placeholder="Search">
        </div>
        <?php require APPROOT . '/views/center_managers/centermanager_notifications/centermanager_notifications.php'; ?>
        
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

            <div class="main-right-top-four-component" style="background-color: var(--request-top-color);" id="tables">
                <!-- <img src="<?php echo IMGROOT?>/cells.png" alt=""> -->
                <i class='bx bx-table'  style="color:var(--main-text-color); font-size: 23px;"></i>
                <p>Tables</p>
            </div>


            <div class="main-right-top-four-component" id="maps">
                <!-- <img src="<?php echo IMGROOT?>/map.png" alt=""> -->
                <i class='bx bx-map' style="color:var(--main-text-color); font-size: 23px;"></i>
                <p>Maps</p>
            </div>


        </div>
    </div>
</div>