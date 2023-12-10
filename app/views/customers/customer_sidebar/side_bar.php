<div class="main-left">
    <div class="main-left-top">
        <img src="<?php echo IMGROOT?>/Logo_No_Background.png" alt="">
        <h1>Eco Plus</h1>
    </div>
    <div class="main-left-middle">
        <div class="main-left-middle-content" id="dashboard" onclick="redirect_dashboard()">
            <div class="main-left-middle-content-line"></div>
            <img src="<?php echo IMGROOT?>/Customer_DashBoard_Icon.png" alt="">
            <h2>Dashboard</h2>
        </div>
        <div class="main-left-middle-content" id="request" onclick="redirect_request()">
            <div class=" main-left-middle-content-line"></div>
            <img src="<?php echo IMGROOT?>/Customer_Request.png" alt="">
            <h2>Requests</h2>
        </div>
        <div class="main-left-middle-content" id="history" onclick="redirect_history()">
            <div class=" main-left-middle-content-line"></div>
            <img src="<?php echo IMGROOT?>/Customer_tracking _Icon.png" alt="">
            <h2>History</h2>
        </div>
        <div class="main-left-middle-content" id="edit_profile" onclick="redirect_edit_profile()">
            <div class=" main-left-middle-content-line"></div>
            <img src="<?php echo IMGROOT?>/Customer_Edit_Pro_Icon.png" alt="">
            <h2>Edit Profile</h2>
        </div>
    </div>
    <div class="main-left-bottom">

        <a href="<?php echo URLROOT?>/customers/logout">
            <div class="main-left-bottom-content">
                <img src="<?php echo IMGROOT?>/Logout.png" alt="">
                <p>Log out</p>
            </div>
        </a>
    </div>
</div>
<script>
function redirect_dashboard() {
    var linkUrl = "<?php echo URLROOT?>/customers"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_request() {
    var linkUrl = "<?php echo URLROOT?>/customers/request_main"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_history() {
    var linkUrl = "<?php echo URLROOT?>/customers/history"; // Replace with your desired URL
    window.location.href = linkUrl;
}

function redirect_edit_profile() {
    var linkUrl = "<?php echo URLROOT?>/customers/editprofile"; // Replace with your desired URL
    window.location.href = linkUrl;
}
</script>