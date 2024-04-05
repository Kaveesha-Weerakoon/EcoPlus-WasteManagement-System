<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Google_API?>&libraries=places&callback=initMap"
    async defer>
</script>
<div class="main-right-top">
    <div class="main-right-top-one">
        <div class="main-right-top-search">
            <i class='bx bx-search-alt-2'></i>
            <input type="text" id="searchInput" placeholder="Search">
        </div>
        <?php require APPROOT . '/views/customers/customer_notification/customer_notification.php'; ?>

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
    <div class="location_pop">
        <div class="location_pop_content">
            <div class="location_pop_map">

            </div>
            <div class="location_close">
                <button onclick="closemap()">Close</button>
            </div>
        </div>

    </div>
    <script src="<?php echo JSROOT?>/Customer.js"> </script>
</div>